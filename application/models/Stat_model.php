<?php

class Checkin_model extends CI_Model {

    public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function stat_male() {
        $this->db->select('*');
        $this->db->where('prename', 'นาย');
        $this->db->form('profiles');
        echo $this->db->count_all_results();
    }

}