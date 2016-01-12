<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Date_model');
        $this->load->model('Checkin_model');
    }

	public function index()
	{
		$data = array(
				"title" => "Index | Backend - ToBeIT"
			);

        $data['checkin_today'] = $this->Checkin_model->stat_checkin_today();
        $data['stay_today'] = $this->Checkin_model->stat_stay_today();
        $data['back_home_today'] = $this->Checkin_model->stat_back_home_today();

		$this->parser->parse('templates/header', $data);
		$this->parser->parse('welcome', $data);
		$this->load->view('templates/footer');
	}

}
