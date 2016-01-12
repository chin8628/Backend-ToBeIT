<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendees extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('attendees_model');
        $this->load->model('page_model');
        $this->load->helper('form');
        $this->load->model('Date_model');
        $this->load->model('Checkin_model');
        $this->load->model('Class_model');
    }

    public function index(){
        $data = array(
                "title" => "Attendees Search | Backend - ToBeIT"
            );

        //Get a page from get method for set limit to select sql
        $search = $this->input->get('search');
        $option = $this->input->get('option');
        if (!empty($this->input->get('page'))){
            $profile = $this->attendees_model->get_attendees(30, $search, $option, $this->input->get('page'));
            $page = $this->input->get('page');
        }
        else{
            $profile = $this->attendees_model->get_attendees(30, $search, $option, 1);
            $page = 1;
        }

        /*
            Generate table from result select `Profiles`
        */
        $temp = "";
        foreach ($profile as $value) {
            $temp .= "<tr>";
            $temp .= "<td>".$value['id_student']."</td>";
            $temp .= "<td>".$value['prename']." ".$value['name']." ".$value['surname']."</td>";
            $temp .= "<td>".$value['nickname']."</td>";
            if ($value['facebook'] != "") {
                $temp .= '<td><a href="http://www.facebook.com/'.$value['facebook'].'" class="btn btn-default">Facebook</a></td>';
            }
            else {
                $temp .= '<td><a href="http://www.facebook.com" class="btn btn-default" disabled="disabled">Facebook</a></td>';
            }
            $temp .= '<td><a href="attendees/edit?id='.$value['id_user'].'" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>';
            $temp .= ' <a href="attendees/delete?id='.$value['id_user'].'" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>';
            $temp .= "</tr>";
        }

        $data['table_attendees'] = $temp;
        if($search == "" && $option == "")
            $data['pagination'] = $this->page_model->paginate('profiles', 30, 'attendees', $page);
        else
            $data['pagination'] = "";
        $data['number_atten'] = $this->attendees_model->count_attendees();

        $this->parser->parse('templates/header', $data);
        $this->parser->parse('attendees', $data);
        $this->load->view('templates/footer');
    }

    public function edit(){
        $data = array(
                "title" => "Profile | Backend - ToBeIT"
            );

        $id = $this->input->get("id");
        $profile = $this->attendees_model->get_profile($id);
        foreach ($profile as $value) {
            $data['id_user'] = $value['id_user'];
            $data['id_student'] = $value['id_student'];
            $data['prename'] = $value['prename'];
            $data['name'] = $value['name'];
            $data['surname'] = $value['surname'];
            $data['nickname'] = $value['nickname'];
            $data['religion'] = $value['religion'];
            $data['school'] = $value['school'];
            $data['level'] = $value['level'];
            $data['expectation'] = $value['expectation'];
            $data['shirt'] = $value['shirt'];
            $data['checkin'] = $value['checkin'];
            $data['direct_ent'] = $value['direct_ent'];
            $data['health_problem'] = $value['health_problem'];
            $data['allergy'] = $value['allergy'];
            $data['phone'] = $value['phone'];
            $data['parent_phone'] = $value['parent_phone'];
            $data['trip'] = $value['trip'];
            $data['return_trip'] = $value['return_trip'];
            $data['facebook'] = $value['facebook'];
        }

        //Generate select's option of religion
        $options = array(
                    '' => '',
                    'พุทธ' => 'พุทธ',
                    'คริสต์' => 'คริสต์',
                    'อิสลาม' => 'อิสลาม',
                    'ไม่มีศาสนา' => 'ไม่มีศาสนา',
                    'อื่น ๆ' => 'อื่น ๆ'
                );
        $temp = form_dropdown('religion', $options, $data['religion'], 'class="form-control" id="religion"');
        $data['religion'] = $temp;

        //Generate select's option of shirt
        $options = array(
                    '' => '',
                    'S' => 'S',
                    'M' => 'M',
                    'L' => 'L',
                    'XL' => 'XL',
                    'อื่น ๆ' => 'อื่น ๆ'
                );
        $temp = form_dropdown('shirt', $options, $data['shirt'], 'class="form-control" id="shirt"');
        $data['shirt'] = $temp;

        //Generate select's option of trip
        $options = array(
                    '0' => 'ไม่ระบุ',
                    '1' => 'ผู้ปกครองมาส่ง',
                    '2' => 'รถไฟ',
                    '3' => 'Airport Rail Link (ARL)',
                    '4' => 'รถตู้',
                    '5' => 'รถประจำทาง',
                    '6' => 'รถสองแถว',
                    '7' => 'อื่นๆ'
                );
        $temp = form_dropdown('trip', $options, $data['trip'], 'class="form-control"');
        $data['trip'] = $temp;

        //Generate select's option of return trip
        $options = array(
                    '0' => 'ไม่ระบุ',
                    '1' => 'ผู้ปกครองมาส่ง',
                    '2' => 'รถไฟ',
                    '3' => 'Airport Rail Link (ARL)',
                    '4' => 'รถตู้',
                    '5' => 'รถประจำทาง',
                    '6' => 'รถสองแถว',
                    '7' => 'อื่นๆ'
                );
        $temp = form_dropdown('return_trip', $options, $data['return_trip'], 'class="form-control"');
        $data['return_trip'] = $temp;

        //Generate select's option of shirt
        $data['checkin_all_day'] = $data['checkin_some_day'] = "";
        if ($data['checkin'] == 1){
            $data['checkin_all_day'] = "checked";
        }
        else {
            $data['checkin_some_day'] = "checked";
        }

        //Generate select's option of direct entrance
        if ($data['direct_ent'] == 1){
            $data['direct_ent'] = "checked";
        }
        else {
            $data['direct_ent'] = "";
        }

        //Generate select's option of checkin event's day
        $data['select_checkin'] = "";
        $event_day = $this->Date_model->number_event_day();
        $checkin_data = $this->Checkin_model->get_checkin($id);
        foreach ($checkin_data as $value) {
            $last_checkin = $value['checkin'];
        }

        $data['select_checkin'] = "";
        for($i=0; $i < $event_day; $i++){
            $data['select_checkin'] .= '<tr>';
            $temp_i = $i + 1;
            $data['select_checkin'] .= '<td>Day '.$temp_i.'</td>';
            $data['select_checkin'] .= '<td>';

            $options = array(
                    '0' => 'ไม่มา',
                    '1' => 'เช็คอินแล้ว',
                    '2' => 'กลับบ้านแล้ว'
                );

            if (!isset($last_checkin[$i])){
                $temp_last_checkin = 0;
            }
            else{
                $temp_last_checkin = $last_checkin[$i];
            }

            $name_dropdown = 'day';
            $name_dropdown .= $i + 1;
            $temp = form_dropdown($name_dropdown, $options, $temp_last_checkin, 'class="form-control"');
            $data['select_checkin'] .= $temp;
            $data['select_checkin'] .= '</td>';
            $data['select_checkin'] .= '</tr>';
        }

        //Generate Class' dopdown
        $classroom = $this->Class_model->get_class();
        $options = array("" => "");
        for($i=0; $i < count($classroom); $i++){
            $options[$classroom[$i]] = $classroom[$i];
        }
        $student_class = $this->Class_model->get_student_class($id);
        $temp = form_dropdown('classroom', $options, $student_class, 'class="form-control"');
        $data['classroom'] = $temp;


        $this->parser->parse('templates/header', $data);
        $this->parser->parse('edit', $data);
        $this->load->view('templates/footer');
    }

    public function submit_edit(){

        $id = $this->input->post('id');
        $update_data['prename'] = $this->input->post('prename');
        $update_data['name'] = $this->input->post('name');
        $update_data['surname'] = $this->input->post('surname');
        $update_data['nickname'] = $this->input->post('nickname');
        $update_data['religion'] = $this->input->post('religion');
        $update_data['school'] = $this->input->post('school');
        $update_data['level'] = $this->input->post('level');
        $update_data['expectation'] = $this->input->post('expectation');
        $update_data['shirt'] = $this->input->post('shirt');
        $update_data['checkin'] = $this->input->post('checkin');
        $update_data['direct_ent'] = $this->input->post('direct_ent');
        $update_data['health_problem'] = $this->input->post('health_problem');
        $update_data['allergy'] = $this->input->post('allergy');
        $update_data['phone'] = $this->input->post('phone');
        $update_data['parent_phone'] = $this->input->post('parent_phone');
        $update_data['trip'] = $this->input->post('trip');
        $update_data['return_trip'] = $this->input->post('return_trip');
        $update_data['facebook'] = $this->input->post('facebook');

        $this->db->where('id_user', $id);
        $this->db->update('profiles', $update_data);
        $this->db->reset_query();

        //Loop for get post from checkin field.
        $event_day = $this->Date_model->number_event_day();
        $input_checkin = "";
        for($i=0; $i < $event_day; $i++){
            $field = "day";
            $field .= $i + 1;
            $input_checkin .= $this->input->post($field);
        }

        $this->db->where('id', $id);
        $this->db->update('checkin', array('checkin' => $input_checkin));
        $this->db->reset_query();

        $classroom_update = $this->input->post('classroom');
        $this->db->where('id', $id);
        $this->db->update('checkin', array('room' => $classroom_update));

        //$update_checkin['room'] = $this

        redirect('attendees');

    }

}
