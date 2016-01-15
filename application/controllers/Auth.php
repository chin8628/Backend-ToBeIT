<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index()
    {
        $data = array(
                "title" => "Auth | Backend - ToBeIT"
            );

        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        if (isset($user) && isset($pass)){
            $this->Auth_model->login($user, $pass);
        }

        $this->parser->parse('templates/header_nologged', $data);
        $this->parser->parse('auth', $data);
        $this->load->view('templates/footer');
    }

    public function logout() {

        $this->Auth_model->logout();

    }

}
