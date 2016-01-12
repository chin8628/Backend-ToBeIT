<?php

class Date_model extends CI_Model {

    public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();
        date_default_timezone_set('Asia/Bangkok');
    }

    public function is_now_on_event(){

        //Return number of event's day if today is event's day, 0 for else.

        $data = $this->db->get('config');
        foreach ($data->result_array() as $value) {
            $date_event = explode(",", $value['day_of_event']);
        }
        for($i=0; $i < count($date_event); $i++){
            if (date("d.m.y") == $date_event[$i]) {
                return $i + 1;
            }
        }
        return 0;
    }

    public function number_event_day() {
        $data = $this->db->get('config');
        foreach ($data->result_array() as $value) {
            return count(explode(",", $value['day_of_event']));
        }
    }

}