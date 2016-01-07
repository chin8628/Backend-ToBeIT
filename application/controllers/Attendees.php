<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendees extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('attendees_model');
        $this->load->model('page_model');
    }

    public function index(){
        $data = array(
                "title" => "Profile | Backend - ToBeIT"
            );

        //Get a page from get method for set limit to select sql
        if (!empty($this->input->get('page'))){
            $profile = $this->attendees_model->get_attendees(false, $this->input->get('page'));
            $page = $this->input->get('page');
        }
        else{
            $profile = $this->attendees_model->get_attendees();
            $page = 1;
        }

        /*
            Generate table from result select `Profiles`
        */
        $temp = "";
        foreach ($profile as $value) {
            $temp .= "<tr>";
            $temp .= "<td>".$value['id_student']."</td>";
            $temp .= "<td>".$value['prename']." ".$value['name']." ".$value['surname']."</td>";
            $temp .= "<td>".$value['nickname']."</td>";
            if ($value['facebook'] != "") {
                $temp .= '<td><a href="http://www.facebook.com/'.$value['facebook'].'" class="btn btn-default">Facebook</a></td>';
            }
            else {
                $temp .= '<td><a href="http://www.facebook.com" class="btn btn-default" disabled="disabled">Facebook</a></td>';
            }
            $temp .= '<td><a href="attendees/edit?id='.$value['id_user'].'" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>';
            $temp .= '<a href="attendees/attendees?id='.$value['id_user'].'" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>';
            $temp .= '<a href="attendees/delete?id='.$value['id_user'].'" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>';
            $temp .= "</tr>";
        }

        $data['table_attendees'] = $temp;
        $data['pagination'] = $this->page_model->paginate('profiles', 30, 'attendees', $page);
        $data['number_atten'] = $this->attendees_model->count_attendees();;

        $this->parser->parse('templates/header', $data);
        $this->parser->parse('attendees', $data);
        $this->load->view('templates/footer');
    }

}