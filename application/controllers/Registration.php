<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('attendees_model');
        $this->load->model('page_model');
        $this->load->helper('form');
        $this->load->model('Date_model');
        $this->load->model('Checkin_model');
        $this->load->model('Class_model');
        $this->load->model('Sheet_model');
    }

        public function index() {

        $data = array(
                "title" => "Registration | Backend - ToBeIT"
            );

        $email = $this->input->post('email');
        $insert_data['prename'] = $this->input->post('prename');
        $insert_data['name'] = $this->input->post('name');
        $insert_data['surname'] = $this->input->post('surname');
        $insert_data['nickname'] = $this->input->post('nickname');
        $insert_data['religion'] = $this->input->post('religion');
        $insert_data['school'] = $this->input->post('school');
        $insert_data['level'] = $this->input->post('level');
        $insert_data['expectation'] = $this->input->post('expectation');
        $insert_data['shirt'] = $this->input->post('shirt');
        $insert_data['checkin'] = $this->input->post('checkin');
        $insert_data['direct_ent'] = $this->input->post('direct_ent');
        $insert_data['health_problem'] = $this->input->post('health_problem');
        $insert_data['allergy'] = $this->input->post('allergy');
        $insert_data['phone'] = $this->input->post('phone');
        $insert_data['parent_phone'] = $this->input->post('parent_phone');
        $insert_data['trip'] = $this->input->post('trip');
        $insert_data['return_trip'] = $this->input->post('return_trip');
        $insert_data['facebook'] = $this->input->post('facebook');

        if (!isset($insert_data['direct_ent'])){
            $insert_data['direct_ent'] = 0;
        }
        if (!isset($insert_data['checkin'])){
            $insert_data['direct_ent'] = 1;
        }

        if ($insert_data['checkin'] == NULL) {
            $insert_data['checkin'] = 0;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_user = $this->attendees_model->registration($insert_data);
            redirect('registration/registration_success?id='.$id_user.'');
        }

        $this->parser->parse('templates/header_nologged', $data);
        $this->parser->parse('registration', $data);
        $this->load->view('templates/footer');

    }

    public function registration_success(){

        $data = array(
                "title" => "Registration | Backend - ToBeIT"
            );

        $id = $this->input->get('id');
        if (isset($id)) {
            $data['id_student'] = $this->attendees_model->get_id_student($id);
        }
        else {
            $data['id_student'] = "NOPE";
        }

        $this->parser->parse('templates/header_nologged', $data);
        $this->parser->parse('registration_success', $data);
        $this->load->view('templates/footer');

    }

}
