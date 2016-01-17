<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('attendees_model');
        $this->load->model('page_model');
        $this->load->helper('form');
        $this->load->model('Date_model');
        $this->load->model('Checkin_model');
        $this->load->model('Class_model');
        $this->load->model('Sheet_model');
        $this->Auth_model->only_logged();
    }

    public function index(){

        $data = array(
                "title" => "Index | Backend - ToBeIT"
            );

        $this->parser->parse('templates/header', $data);
        $this->parser->parse('setting', $data);
        $this->load->view('templates/footer');

    }

}