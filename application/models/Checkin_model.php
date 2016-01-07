<?php

class Checkin_model extends CI_Model {

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

}