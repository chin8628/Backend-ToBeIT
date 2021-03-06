<?php

class Checkin_model extends CI_Model {

    public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('Date_model');
    }

    public function search_attendees($search){

        $this->db->select('*');
        $this->db->from('profiles');
        $this->db->where('id_student', $search);
        $this->db->or_like('name', $search);
        $this->db->or_like('surname', $search);
        $this->db->or_like('nickname', $search);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function edit_room($id, $room){
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('checkin');
        $cnt = $this->db->count_all_results();

        if ($cnt == 0) {
            $this->db->insert('checkin', array("id" => $id, "room" => $room));
        }
        else if ($cnt == 1){
            $this->db->where('id', $id);
            $this->db->update('checkin', array('room' => $room));
        }
        else {
            return "ERR can count record of this ID more than one.";
        }
    }

    public function add_checkin_time($id, $type) {

        //Type 1 is checkin
        //Type 0 is checkout

        if ($type == 1) {
            $type = "checkin";
        }
        else if ($type == 0) {
            $type = "checkout";
        }

        $insert_data = array(
                            'id_user' => $id,
                            'type' => $type,
                            'date' => date("d.m.y"),
                            'time' => date("H:i:s")
                        );

        $this->db->insert('time_checkin', $insert_data);
        return 0;

    }

    public function checkin($id) {

        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('checkin');
        $cnt = $this->db->count_all_results();

        $num_event_day = $this->Date_model->number_event_day();

        //Insert log time of checkin into DB
        $this->add_checkin_time($id, 1);

        $data = $this->db->get_where('checkin', array('id' => $id));
        $last_checkin = "";
        foreach ($data->result_array() as $value) {
            $last_checkin = $value['checkin'];
        }

        $checkin = "";
        if ($last_checkin != "") {
            for ($i=0; $i < $num_event_day; $i++){
                if ($this->Date_model->is_now_on_event() == $i + 1){
                    if ($last_checkin[$i] == "2"){
                        //Junior already back to home.
                        return 112;
                    }
                    else if ($last_checkin[$i] == "1"){
                        //Junior already checkin.
                        return 111;
                    }
                    $checkin .= "1";
                }
                else
                    $checkin .= $last_checkin[$i];
            }
        }

        echo "aa";

        if ($cnt == 0) {
            $this->db->insert('checkin', array("id" => $id, "checkin" => $checkin));
        }
        else if($cnt == 1){
            $this->db->where('id', $id);
            $this->db->update('checkin', array("checkin" => $checkin));
        }
        else{
            return 0;
        }
    }

    public function checkout($id) {

        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('checkin');
        $cnt = $this->db->count_all_results();

        $num_event_day = $this->Date_model->number_event_day();

        //Insert log time of checkin into DB
        $this->add_checkin_time($id, 0);

        $data = $this->db->get_where('checkin', array('id' => $id));
        $last_checkin = "";
        foreach ($data->result_array() as $value) {
            $last_checkin = $value['checkin'];
        }

        $checkin = "";
        if ($last_checkin != "") {
            for ($i=0; $i < $num_event_day; $i++){
                if ($this->Date_model->is_now_on_event() == $i + 1){
                    if ($last_checkin[$i] == "2"){
                        //Junior already back to home.
                        return 112;
                    }
                    else if ($last_checkin[$i] == "0"){
                        //Junior wasn't checkin today.
                        return 110;
                    }
                    $checkin .= "2";
                }
                else{
                    $checkin .= $last_checkin[$i];
                }
            }
        }

        if ($cnt == 0) {
            $this->db->insert('checkin', array("id" => $id, "checkin" => $checkin));
        }
        else if($cnt == 1){
            $this->db->where('id', $id);
            $this->db->update('checkin', array("checkin" => $checkin));
        }
        $data = $this->db->get_where("checkin", array('$id'));
        return 0;

    }

    public function get_checkin($id){

        $data = $this->db->get_where('checkin', array('id' => $id));
        return $data->result_array();

    }

    public function stat_checkin_today(){

        $date = $this->Date_model->is_now_on_event();
        $number_event_day = $this->Date_model->number_event_day();

        if ($date != 0) {
            $cnt = 0;
            $data = $this->db->get('checkin');
            foreach ($data->result_array() as $value) {
                if ($value['checkin'][$date - 1] != 0){
                    $cnt += 1;
                }
            }
            return $cnt;
        }
        else {
            return 0;
        }

    }

    public function stat_stay_today(){

        $date = $this->Date_model->is_now_on_event();
        $number_event_day = $this->Date_model->number_event_day();
        if ($date != 0){
            $cnt = 0;
            $data = $this->db->get('checkin');
            foreach ($data->result_array() as $value) {
                if ($value['checkin'][$date - 1] == 1){
                    $cnt += 1;
                }
            }
            return $cnt;
        }
        else {
            return 0;
        }

    }

    public function stat_back_home_today(){

        $date = $this->Date_model->is_now_on_event();
        $number_event_day = $this->Date_model->number_event_day();

        if($date != 0){
            $cnt = 0;
            $data = $this->db->get('checkin');
            foreach ($data->result_array() as $value) {
                if ($value['checkin'][$date - 1] == 2){
                    $cnt += 1;
                }
            }
            return $cnt;
        }
        else {
            return 0;
        }

    }

    public function stat_checkin(){

        $date = $this->Date_model->is_now_on_event();
        $number_event_day = $this->Date_model->number_event_day();

        $i = 0;
        $cnt_array = array();
        for($i=0; $i < $date; $i++) {
            if ($date != 0) {
                $cnt = 0;
                $data = $this->db->get('checkin');
                foreach ($data->result_array() as $value) {
                    if ($value['checkin'][$i] != 0){
                        $cnt += 1;
                    }
                }
                $cnt_array[$i] = $cnt;
            }
            else {
                return 0;
            }
        }
        return $cnt_array;

    }

    public function stat_stay(){

        $date = $this->Date_model->is_now_on_event();
        $number_event_day = $this->Date_model->number_event_day();

        $i = 0;
        $cnt_array = array();
        for($i = 0; $i < $date; $i++){
            if ($date != 0){
                $cnt = 0;
                $data = $this->db->get('checkin');
                foreach ($data->result_array() as $value) {
                    if ($value['checkin'][$i] == 1){
                        $cnt += 1;
                    }
                }
                $cnt_array[$i] = $cnt;
            }
            else {
                return 0;
            }
        }
        return $cnt_array;

    }

    public function stat_back_home(){

        $date = $this->Date_model->is_now_on_event();
        $number_event_day = $this->Date_model->number_event_day();

        $i = 0;
        $cnt_array=  array();
        for($i=0; $i < $date; $i++){
            if($date != 0){
                $cnt = 0;
                $data = $this->db->get('checkin');
                foreach ($data->result_array() as $value) {
                    if ($value['checkin'][$i] == 2){
                        $cnt += 1;
                    }
                }
                $cnt_array[$i] = $cnt;
            }
            else {
                return 0;
            }
        }
        return $cnt_array;

    }

    public function get_checkin_time($id) {

        $data = $this->db->get_where('time_checkin', array('id_user' => $id, 'type' => 'checkin'));
        return $data->result_array();

    }

    public function get_checkout_time($id) {

        $data = $this->db->get_where('time_checkin', array('id_user' => $id, 'type' => 'checkout'));
        return $data->result_array();

    }

}