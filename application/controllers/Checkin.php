<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Checkin_model');
    }

    public function index()
    {
        $data = array(
                "title" => "Checkin | Backend - ToBeIT"
            );

        $search = $this->input->get('search');

        if ($search != ""){
            $result_search = $this->Checkin_model->search_attendees($search);
            $temp = "";
            foreach ($result_search as $value) {
                $temp .= "<tr>";
                $temp .= "<td>".$value['id_student']."</td>";
                $temp .= "<td>".$value['prename']." ".$value['name']." ".$value['surname']."</td>";
                $temp .= "<td>".$value['nickname']."</td>";
                $temp .= "<td>".$value['school']."</td>";
                $temp .= '<td><a rel="stylesheet" href="checkin/come?id='.$value['id_user'].'" class="btn btn-success">Check In</a> <a rel="stylesheet" href="checkin/back?id='.$value['id_user'].'" class="btn btn-danger">Check Out</a></td>';
                $temp .= "</tr>";
            }
            $data['attendees'] = $temp;
        }
        else {
            $data['attendees'] = "";
        }

        $this->parser->parse('templates/header', $data);
        $this->parser->parse('checkin', $data);
        $this->load->view('templates/footer');
    }

    public function come(){
        $id = $this->input->get('id');

    }

}
