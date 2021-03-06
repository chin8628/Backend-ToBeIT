<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Checkin_model');
        $this->load->model('Attendees_model');
        $this->load->model('Class_model');
        $this->load->model('Food_model');
        $this->load->model('Sheet_model');
        $this->load->helper('form');
        $this->Auth_model->only_logged();
    }

    public function index()
    {
        $data = array(
                "title" => "Checkin | Backend - ToBeIT"
            );

        $search = $this->input->get('search');

        if ($search != ""){
            $result_search = $this->Checkin_model->search_attendees($search);
            $temp = "";
            foreach ($result_search as $value) {
                $temp .= "<tr>";
                $temp .= "<td>".$value['id_student']."</td>";
                $temp .= "<td>".$value['prename']." ".$value['name']." ".$value['surname']."</td>";
                $temp .= "<td>".$value['nickname']."</td>";
                $temp .= "<td>".$value['school']."</td>";
                $temp .= '<td><a rel="stylesheet" href="checkin/come?id='.$value['id_user'].'" class="btn btn-success">Check In</a> <a rel="stylesheet" href="checkin/back?id='.$value['id_user'].'" class="btn btn-danger">Check Out</a></td>';
                $temp .= "</tr>";
            }
            $data['attendees'] = $temp;
        }
        else {
            $data['attendees'] = "";
        }

        //Display ERR section
        $err = $this->input->get('err');
        $data['err'] = "";
        if (isset($err)) {
            if($err == 110){
                $data['err'] = '<div class="alert alert-danger" role="alert"><b>แจ้งเตือน!</b> น้องไม่ได้มาเช็คอินวันนี้</div>';
            }
            else if ($err == 111){
                $data['err'] = '<div class="alert alert-danger" role="alert"><b>แจ้งเตือน!</b> น้องมาเช็คอินไปแล้ววันนี้</div>';
            }
            else if ($err == 112){
                $data['err'] = '<div class="alert alert-danger" role="alert"><b>แจ้งเตือน!</b> น้องกลับบ้านไปแล้ว</div>';
            }
        }

        $this->parser->parse('templates/header', $data);
        $this->parser->parse('checkin', $data);
        $this->load->view('templates/footer');
    }

    public function come(){

        $data = array(
                "title" => "Checkin | Backend - ToBeIT"
            );

        /* ------------------------------ */
        /*      Section | Get input       */
        // ------------------------------ */
        $id = $this->input->get('id');
        $room = $this->input->post('classroom');
        $menu_food = $this->input->post('menu_food');
        $last_checkin = $this->Checkin_model->get_checkin($id);

        //Get post from sheet_menu
        $sheet = $this->Sheet_model->get_sheet();
        $sheet_today = array();
        foreach ($sheet as $key => $value) {
            $name_field = 'sheet'.$key;
            $order_sheet = $this->input->post($name_field);
            if ($order_sheet > 0 && $order_sheet != ""){
                $sheet_today[$value] = $order_sheet;
            }
        }

        /* ------------------------------ */
        /*    Action when Submited form   */
        // ------------------------------ */
        //When form was submit will enter into if
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Don't swap this sequence of code. I think this is the best!
            $this->Checkin_model->edit_room($id, $room);
            $status = $this->Checkin_model->checkin($id);

            //This if must be last statement of code
            //Check error's status of Checkin before do other
            if ($status != 0){
                redirect('checkin?err=' . $status);
            }
            else{
                //Save attendee's food menu
                $this->Food_model->save_food_attendee($id, $menu_food);

                //Save attendee's order sheet
                echo $this->Sheet_model->save_sheet_attendee($id, $sheet_today);

                redirect('checkin');
            }

        }

        /* ------------------------------ */
        /*         Generate display       */
        // ------------------------------ */
        //Get Profile's data to generate stuff
        $profile = $this->Attendees_model->get_profile($id);
        foreach ($profile as $value) {
            $data['prename'] = $value['prename'];
            $data['name'] = $value['name'];
            $data['surname'] = $value['surname'];
            $data['nickname'] = $value['nickname'];
            $data['id_student'] = $value['id_student'];
            $data['school'] = $value['school'];
            $data['shirt'] = $value['shirt'];
            $data['religion'] = $value['religion'];
        }

        //Generate checkin by day
        $temp1 = "";
        $temp2 = "";
        foreach ($last_checkin as $value) {
            for($i=0; $i < strlen($value['checkin']); $i++){
                $temp1 .= "<td>Day ";
                $temp1 .= $i + 1;
                $temp1 .= "</td>";

                if ($value['checkin'][$i] == 0){
                    $temp2 .= '<td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>';
                }
                else if ($value['checkin'][$i] == 1){
                    $temp2 .= '<td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';
                }
                else if ($value['checkin'][$i] == 2){
                    $temp2 .= '<td><span class="glyphicon glyphicon-home" aria-hidden="true"></span></td>';
                }
            }
        }

        $data['chk_thead'] = $temp1;
        $data['chk_tbody'] = $temp2;

        //Generate Class's dopdown
        $classroom = $this->Class_model->get_class();
        $options = array("" => "");
        for($i=0; $i < count($classroom); $i++){
            $options[$classroom[$i]] = $classroom[$i];
        }
        $student_class = $this->Class_model->get_student_class($id);
        $temp = form_dropdown('classroom', $options, $student_class, 'class="form-control"');
        $data['classroom'] = $temp;

        //Generate Food menu's dropdown
        $options = array("" => "");
        $food_menu = $this->Food_model->get_menu_food();
        for($i=0;$i < count($food_menu); $i++){
            $options[$food_menu[$i]] = $food_menu[$i];
        }
        $menu_of_atten = $this->Food_model->get_food_of_attendee($id);
        $data['menu_dropdown'] = form_dropdown('menu_food', $options, $menu_of_atten, 'class="form-control"');

        //Generate Sheet's display
        $sheet = $this->Sheet_model->get_sheet();
        $temp = '<div class="form-horizontal">';
        foreach ($sheet as $key => $value) {
            if ($key >= floor(count($sheet) / 2) + 1 || $key == 0) {
                $temp .= '<div class="col-sm-6">';
            }
            $temp .= '<div class="form-group inline">';
            $temp .= '<label for="sheet'.$key.'" class="col-sm-5 control-label">'.$value.'</label>';
            $temp .= '<div class="col-sm-5">';
            $temp .= '<input type="number" class="form-control" name="sheet'.$key.'" min=0>';
            $temp .= '</div>';
            $temp .= "</div>";
            if ($key >= floor(count($sheet) / 2) || $key == count($sheet) - 1) {
                $temp .= "</div>";
            }
        }
        $temp .= "</div>";
        $data['sheet_menu'] = $temp;

        $this->parser->parse('templates/header', $data);
        $this->parser->parse('come', $data);
        $this->load->view('templates/footer');
    }

    public function back(){

        $data = array(
                "title" => "Checkin | Backend - ToBeIT"
            );

        $id = $this->input->get('id');
        $status = $this->Checkin_model->checkout($id);

        if ($status != 0)
            redirect('checkin?err=' . $status);
        else
            redirect('checkin');

    }

}
