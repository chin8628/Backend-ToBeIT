<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

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

    public function index() {
        $data = array(
                "title" => "Index | Backend - ToBeIT"
            );

        $data['id_student'] = "";
        $data['prename'] = "";
        $data['name'] = "";
        $data['surname'] = "";
        $data['nickname'] = "";
        $data['school'] = "";
        $data['sheet_today'] = "";
        $data['food'] = "";
        $data['alert'] = "";

        $id = $this->input->get('id');
        if (isset($id)){
            $profile = $this->Attendees_model->get_profile($id);
            if (count($profile) != 0){
                foreach ($profile as $value) {
                    $data['id_student'] = $value['id_student'];
                    $data['prename'] = $value['prename'];
                    $data['name'] = $value['name'];
                    $data['surname'] = $value['surname'];
                    $data['nickname'] = $value['nickname'];
                    $data['school'] = $value['school'];
                }

                //Get result sheet today
                $temp = "";
                $sheet_today = $this->Sheet_model->get_sheet_of_attendee_today($id);
                if ($sheet_today != "ERR"){
                    foreach ($sheet_today as $key => $value) {
                        $temp .= $key." (จำนวน ".$value."), ";
                    }
                    $data['sheet_today'] = $temp;
                }
                else{
                    $data['sheet_today'] = "ไม่ได้สั่งซื้อ";
                }

                //Get food
                $data['food'] = $this->Food_model->get_food_of_attendee($id);
            }
            else{
                $data['alert'] = '<div class="alert alert-warning" role="alert">ไม่มีหมายเลขประจำตัวนี้ในระบบ</div>';
            }
        }

        $this->parser->parse('templates/header', $data);
        $this->parser->parse('order', $data);
        $this->load->view('templates/footer');
    }

}