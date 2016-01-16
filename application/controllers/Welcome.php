<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Date_model');
        $this->load->model('Checkin_model');
        $this->load->model('Food_model');
        $this->load->model('Stat_model');
        $this->Auth_model->only_logged();
    }

	public function index()
	{
		$data = array(
				"title" => "Index | Backend - ToBeIT"
			);

        $data['checkin_today'] = $this->Checkin_model->stat_checkin_today();
        $data['stay_today'] = $this->Checkin_model->stat_stay_today();
        $data['back_home_today'] = $this->Checkin_model->stat_back_home_today();
        $data['stat_male'] = $this->Stat_model->stat_male();
        $data['stat_female'] = $this->Stat_model->stat_female();
        $data['total_attendee'] = $this->Stat_model->total_attendees();

        //Generate table of student's number
        $number_std_class = $this->Class_model->number_attendee_by_class();
        $temp = "";
        $total = 0;
        foreach ($number_std_class as $key => $value) {
            $temp .= "<tr>";
            $temp .= '<td>ห้อง '.$key.'</td>';
            $temp .= '<td class="col-sm-2 text-center">'.$value.' คน</td>';
            $temp .= '</tr>';
            $total += $value;
        }
        $temp .= "<tr>";
        $temp .= '<td>รวมทั้งหมด </td>';
        $temp .= '<td class="col-sm-2 text-center">'.$total.' คน</td>';
        $temp .= '</tr>';
        $data['number_std_class'] = $temp;

        //Generate table of number menu's order
        $order = $this->Food_model->count_order_food();
        $temp = "";
        foreach ($order as $key => $value) {
            $temp .= "<tr>";
            $temp .= '<td>'.$key.'</td>';
            $temp .= '<td class="col-sm-2 text-center">'.$value.' คน</td>';
            $temp .= '</tr>';
        }
        $data['order_menu'] = $temp;

		$this->parser->parse('templates/header', $data);
		$this->parser->parse('welcome', $data);
		$this->load->view('templates/footer');
	}

}
