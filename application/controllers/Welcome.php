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

        //Generate stat another day
        $checkin_by_day = $this->Checkin_model->stat_checkin();
        $stay_by_day = $this->Checkin_model->stat_stay();
        $back_home_by_day = $this->Checkin_model->stat_back_home();
        $temp = '<ul class="nav nav-tabs" role="tablist">';
        foreach ($checkin_by_day as $key => $value) {
            $temp .= '<li role="presentation" ';
            $day = $key+1;
            if ($key == 0) {
                $temp .= 'class="active"';
            }
            $temp .= '><a href="#stat_'.$day.'" aria-controls="stat_'.$day.'" role="tab" data-toggle="tab">วันที่ '.$day.'</a></li>';
        }
        $temp .= '</ul>';
        $temp .= '<div class="tab-content">';
        foreach ($checkin_by_day as $key => $value) {
            $temp .= '<div role="tabpanel" class="tab-pane';
            $day = $key+1;
            if ($key == 0) {
                $temp .= ' active';
            }
            $temp .= '" id="stat_'.$day.'">';
            $temp .= '<div class="panel panel-default">';
            $temp .= '<div class="panel-body">';
            $temp .= '<table class="table table-bordered">';
            $temp .= '<tbody>';
            $temp .= '<tr>';
            $temp .= '<td>จำนวนคนทั้งหมด</td>';
            $temp .= '<td class="col-sm-2 text-center">'.$checkin_by_day[$key].' คน</td>';
            $temp .= '</tr>';
            $temp .= '<tr>';
            $temp .= '<td>จำนวนคนเช็คอินมาเรียน</td>';
            $temp .= '<td class="col-sm-2 text-center">'.$stay_by_day[$key].'  คน</td>';
            $temp .= '</tr>';
            $temp .= '<tr>';
            $temp .= '<td>จำนวนคนกลับบ้านแล้ว</td>';
            $temp .= '<td class="col-sm-2 text-center">'.$back_home_by_day[$key].' คน</td>';
            $temp .= '</tr>';
            $temp .= '</tbody>';
            $temp .= '</table>';
            $temp .= '</div>';
            $temp .= '</div>';
            $temp .= '</div>';
        }
        $data['stat_another_day'] = $temp;

		$this->parser->parse('templates/header', $data);
		$this->parser->parse('welcome', $data);
		$this->load->view('templates/footer');
	}

}
