<?php

class Sheet_model extends CI_Model {

    public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('Date_model');
    }

    public function get_sheet() {
        $data = $this->db->get('config');
        foreach ($data->result_array() as $value) {
            return explode(",", $value['name_sheet']);
        }
    }

    public function get_sheet_of_attendee($id) {
        /*
            Format of sheet's array
            array(5) {
                ["1"] => "science,math",
                ["2"] => "P.E,Social" < keep sheet's name
                  ^ is Day of event
            };
        */
        $data = $this->db->get_where('checkin', array('id' => $id));
        foreach ($data->result_array() as $value) {
            $temp_json = json_decode($value['sheet'], TRUE);
            if (isset($value['sheet'])){
                foreach ($temp_json as $key => $value) {
                    $temp_json[$key] = json_decode($value, TRUE);
                }
            }
        }
        return $temp_json;
    }

    public function get_sheet_of_attendee_today($id) {
        $today = $this->Date_model->is_now_on_event();
        if ($today != 0){
            $data = $this->db->get_where('checkin', array('id' => $id));
            foreach ($data->result_array() as $value) {
                $sheet_today = json_decode($value['sheet'], TRUE);
            }
            return json_decode($sheet_today[$today], TRUE);
        }
        else {
            return 'ERR';
        }
    }

    public function save_sheet_attendee($id, $sheet_today) {
        //Get input $sheet_today in array term.
        $today = $this->Date_model->is_now_on_event();
        $sheet_atten = $this->get_sheet_of_attendee($id);
        if($today != 0){
            if ($sheet_atten != ""){
                foreach ($sheet_atten as $key => $value) {
                    $sheet_atten[$key] = json_encode($value);
                }
            }
            $sheet_atten[$today] = json_encode($sheet_today);
            $json_sheet = json_encode($sheet_atten);
            //Check If record exist
            $this->db->select('*');
            $this->db->where('id', $id);
            $this->db->from('checkin');
            $cnt = $this->db->count_all_results();
            if ($cnt == 1) {
                $this->db->where('id', $id);
                $this->db->update('checkin', array('sheet' => $json_sheet));
            }
            else if ($cnt == 0){
                $this->db->insert('checkin', array("id" => $id, 'sheet' => $json_sheet));
            }
            else {
                return "ERR can count record of this ID more than one.";
            }
        }
        else {
            return 'Not event day';
        }
    }

}