<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data = array(
				"title" => "Index | Backend - ToBeIT"
			);

		$this->parser->parse('templates/header', $data);
		$this->load->view('welcome');
		$this->load->view('templates/footer');
	}

}
