<?php

class Stat_model extends CI_Model {

    public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('Class_model');
    }

    public function total_attendees() {
        return $this->db->count_all_results('profiles');
    }

    public function stat_male() {
        $this->db->select('*');
        $this->db->where('prename', 'นาย');
        $this->db->from('profiles');
        return $this->db->count_all_results();
    }

    public function stat_female() {
        $this->db->select('*');
        $this->db->where('prename', 'นาง');
        $this->db->or_where('prename', 'นางสาว');
        $this->db->from('profiles');
        return $this->db->count_all_results();
    }

}