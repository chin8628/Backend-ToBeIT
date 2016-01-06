<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendees extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('attendees_model');
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

        $data['number_atten'] = $this->attendees_model->count_attendees();

        $temp = '<nav><ul class="pagination">';
        if($page == 1){
            $temp .= '<li><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        else{
            $page -= 1;
            $temp .= '<li><a href="attendees?page='.$page.'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for($i=1; $i <= $this->attendees_model->number_page(); $i+=1){
            if($page == $i - 1)
                $temp .= '<li class="active"><a href="attendees?page='.$i.'">'.$i.'</a></li>';
            else
                $temp .= '<li><a href="attendees?page='.$i.'">'.$i.'</a></li>';
        }
        if($page == $this->attendees_model->number_page()){
            $temp .= '<li><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
        }
        else{
            $page += 1;
            $temp .= '<li><a href="attendees?page='.$page.'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
        }
        $temp .= "</ul></nav>";
        $data['pagination'] = $temp;

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

        $this->parser->parse('templates/header', $data);
        $this->parser->parse('attendees', $data);
        $this->load->view('templates/footer');
    }

}
