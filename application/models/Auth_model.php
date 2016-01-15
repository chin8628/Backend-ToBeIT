<?php

class Auth_model extends CI_Model {

    //Don't panic when u see this code, I will improve this code after TobeIT

    public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->library('session');
    }

    public function login($username, $password) {

        if ($username == "admin" && $password == "ToBeIT59P@ss"){
            $this->session->set_userdata('token', 'ee76410d66');
            redirect('');
        }
        else {
            redirect('auth');
        }

    }

    public function only_logged() {

        if (!$this->session->has_userdata('token')){
            redirect('auth');
        }

    }

    public function logout() {

        $this->session->unset_userdata('token');
        redirect('auth');

    }

}