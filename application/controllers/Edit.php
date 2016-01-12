<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {

    public function index()
    {
        $data = array(
                "title" => "Edit profile | Backend - ToBeIT"
            );

        $this->parser->parse('templates/header', $data);
        $this->load->view('edit');
        $this->load->view('templates/footer');
    }

}
