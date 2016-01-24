<?php

class Score_model extends CI_Model {

    public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model("Class_model");
    }

    public function give_score($room, $score) {

        $this->db->insert("room_score", array('room' => $room, 'score' => $score));
        return 0;

    }

    public function get_score() {

        $sum_array = array();
        $class = $this->Class_model->get_class();

        if (isset($class)) {
            foreach ($class as $value) {
                $this->db->select_sum('score');
                $this->db->where("room", $value);
                $data = $this->db->get('room_score');
                $sum_of_score = $data->result_array();
                $this->db->reset_query();
                $sum_array[$value] = $sum_of_score[0]['score'];
            }

            //Return room in key and sum in value
            return $sum_array;

        }

        return 'ERR';

    }

}