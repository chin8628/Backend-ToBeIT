<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Score extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Class_model");
        $this->load->model("Score_model");
    }

    public function index() {
        $data = array(
                "title" => "Score | Backend - ToBeIT"
            );

        $score_array = $this->Score_model->get_score();

        $data['score'] = "";
        foreach ($score_array as $key => $value) {
            $data['score'] .= '<div class="col-sm-6">';
            $data['score'] .= '<div class="panel panel-default">';
            $data['score'] .= '<div class="panel-heading">ห้อง '.$key.'</div>';
            $data['score'] .= '<div class="panel-body text-center"><h1>'.$value.' คะแนน</h1>';
            $data['score'] .= '</div>';
            $data['score'] .= '</div>';
            $data['score'] .= '</div>';
        }


        $this->parser->parse('templates/header_nologged', $data);
        $this->parser->parse('score', $data);
        $this->load->view('templates/footer');
    }

    public function findmeifucan() {

        $data = array(
                "title" => "Give score | Backend - ToBeIT"
            );

        $classroom = $this->Class_model->get_class();
        $data['room'] = "";
        foreach ($classroom as $key => $value) {
            $data['room'] .= '<label class="checkbox-inline">';
            $data['room'] .= '<input type="checkbox" name="room[]" value="'.$value.'"> '.$value.' ';
            $data['room'] .= '</label>';
        }

        $room = $this->input->post('room');
        $score = $this->input->post('score');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($room as $key => $value) {
                $this->Score_model->give_score($value, $score);
            }
            redirect('score/findmeifucan','refresh');
        }

        $this->parser->parse('templates/header_nologged', $data);
        $this->parser->parse('givescore', $data);
        $this->load->view('templates/footer');

    }

}