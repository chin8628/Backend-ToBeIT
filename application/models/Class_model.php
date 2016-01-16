<?php

class Class_model extends CI_Model {

    public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();
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
        $this->db->select('*');
        $this->db->from('profiles');
        $this->db->join('checkin', 'profiles.id_user = checkin.id', 'inner');
        $this->db->where('checkin.room', $room);
        $query = $this->db->get();
        return $query->result_array();
    }

}