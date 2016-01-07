<?php

class Attendees_model extends CI_Model {

        public function search_on_id($id, $grab_offset, $grab){
            $this->db->select('*');
            $this->db->from('profiles');
            $this->db->where('id_student', $id);
            $this->db->limit($grab, $grab_offset);
            $query = $this->db->get();
            return $query->result_array();
        }

        public function search_on_name($name, $grab_offset, $grab){
            $this->db->select('*');
            $this->db->from('profiles');
            $this->db->like('name', $name);
            $this->db->limit($grab, $grab_offset);
            $query = $this->db->get();
            return $query->result_array();
        }

        public function search_on_surname($surname, $grab_offset, $grab){
            $this->db->select('*');
            $this->db->from('profiles');
            $this->db->like('surname', $surname);
            $this->db->limit($grab, $grab_offset);
            $query = $this->db->get();
            return $query->result_array();
        }

        public function search_on_nickname($nickname, $grab_offset, $grab){
            $this->db->select('*');
            $this->db->from('profiles');
            $this->db->like('nickname', $nickname);
            $this->db->limit($grab, $grab_offset);
            $query = $this->db->get();
            return $query->result_array();
        }

        public function search_on_religion($religion, $grab_offset, $grab){
            $this->db->select('*');
            $this->db->from('profiles');
            $this->db->like('religion', $religion);
            $this->db->limit($grab, $grab_offset);
            $query = $this->db->get();
            return $query->result_array();
        }

        public function search_on_shirt($shirt, $grab_offset, $grab){
            $this->db->select('*');
            $this->db->from('profiles');
            $this->db->like('shirt', $shirt);
            $this->db->limit($grab, $grab_offset);
            $query = $this->db->get();
            return $query->result_array();
        }

        public function search_on_school($school, $grab_offset, $grab){
            $this->db->select('*');
            $this->db->from('profiles');
            $this->db->like('school', $school);
            $this->db->limit($grab, $grab_offset);
            $query = $this->db->get();
            return $query->result_array();
        }

        public function get_attendees($grab, $search=false, $keyword=false, $page=1){

            $grab_offset = (($page - 1) * $grab);

            switch ($keyword) {
                case 'id':
                    return $this->search_on_id($search, $grab_offset, $grab);
                case 'name':
                    return $this->search_on_name($search, $grab_offset, $grab);
                case 'surname':
                    return $this->search_on_surname($search, $grab_offset, $grab);
                case 'nickname':
                    return $this->search_on_nickname($search, $grab_offset, $grab);
                case 'school':
                    return $this->search_on_school($search, $grab_offset, $grab);
                case 'religion':
                    return $this->search_on_religion($search, $grab_offset, $grab);
                case 'shirt':
                    return $this->search_on_shirt($search, $grab_offset, $grab);
                default:
                    $query = $this->db->get('profiles', $grab, (($page - 1) * $grab));
                    return $query->result_array();
            }

        }

        public function count_attendees(){
            return $this->db->count_all('profiles');
        }

        public function number_page(){
            $grab = 30; //set limit of select sql
            return ceil($this->count_attendees() / $grab);
        }

}