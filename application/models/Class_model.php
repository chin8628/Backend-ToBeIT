<?php

class Class_model extends CI_Model {

    public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('Date_model');
    }

    public function get_class(){
        //Return array of classroom
        $this->db->select('classroom');
        $this->db->from('config');
        $data = $this->db->get();
        foreach ($data->result_array() as $value) {
            $class = explode(",", $value['classroom']);
        }
        return $class;
    }

    public function get_student_class($id){
        $data = $this->db->get_where('checkin', array('id' => $id));
        foreach ($data->result_array() as $value) {
            return $value['room'];
        }
    }

    public function list_attendee_in_room($room) {
        $number_day_event = $this->Date_model->is_now_on_event();
        $this->db->select('*');
        $this->db->from('profiles');
        $this->db->join('checkin', 'profiles.id_user = checkin.id', 'inner');
        $this->db->where('checkin.room', $room);
        $data = $this->db->get();
        $result_atten = array();
        foreach ($data->result_array() as $value) {
            $checkin_by_day = $value['checkin'][$number_day_event - 1];
            if ($checkin_by_day == 1){
                array_push($result_atten, $value);
            }
        }
        return $result_atten;
    }

    public function number_attendee_by_class() {
        $class_arr = $this->Class_model->get_class();
        $number_std_class = array();
        $number_day_event = $this->Date_model->is_now_on_event();
        foreach ($class_arr as $key => $value) {
            $this->db->select('*');
            $this->db->where('room', $value);
            $this->db->from('checkin');
            $data = $this->db->get();
            $cnt = 0;
            foreach ($data->result_array() as $value_checkin) {
                $checkin_by_day = $value_checkin['checkin'][$number_day_event - 1];
                if ($checkin_by_day == 1){
                    $cnt++;
                }
            }
            $number_std_class[$value] = $cnt;
        }
        return $number_std_class;
    }

}