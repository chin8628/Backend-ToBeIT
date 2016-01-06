<?php

class Attendees_model extends CI_Model {

        public function get_attendees($id=false, $page=1){

            $temp = "";
            $grab = 30; //set limit of select sql

            if ($id == false) {
                $query = $this->db->get('profiles', $grab, (($page - 1) * $grab));
                return $query->result_array();
            }

            $query = $this->db->get_where('profiles', array('id_user' => $id), $grab, (($page - 1) * $grab));
            return $query->result_array();

        }

        public function count_attendees(){
            return $this->db->count_all('profiles');
        }

        public function number_page(){
            $grab = 30; //set limit of select sql
            return ceil($this->count_attendees() / $grab);
        }

}