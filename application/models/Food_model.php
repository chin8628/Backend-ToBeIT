<?php

class Food_model extends CI_Model {

    public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function get_menu_food() {
        $data = $this->db->get('config');
        foreach ($data->result_array() as $value) {
            return explode(',', $value['menu_food']);
        }
    }

    public function number_of_food() {
        $data = $this->db->get('config');
        foreach ($data->result_array() as $value) {
            return count(explode(',', $value['menu_food']));
        }
    }

    public function get_food_of_attendee($id) {
        $data = $this->db->get_where('checkin', array('id' => $id));
        foreach ($data->result_array() as $value) {
            return $value['food'];
        }
    }

    public function save_food_attendee($id, $food) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('checkin');
        $cnt = $this->db->count_all_results();
        if ($cnt == 1) {
            $this->db->where('id', $id);
            $this->db->update('checkin', array('food' => $food));
        }
        else if ($cnt == 0){
            $this->db->insert('checkin', array("id" => $id, "food" => $food));
        }
        else {
            return "ERR can count record of this ID more than one.";
        }
    }

    public function count_order_food() {
        //return number of menu's order by menu
        $menu = $this->get_menu_food();
        foreach ($menu as $key => $value) {
            $this->db->select('*');
            $this->db->where('food', $value);
            $this->db->from('checkin');
            $cnt[$value] = $this->db->count_all_results();
        }
        return $cnt;
    }

    public function get_order_food($menu) {
        $this->db->select('*');
        $this->db->from('profiles');
        $this->db->join('checkin', 'profiles.id_user = checkin.id', 'inner');
        $this->db->where('checkin.food', $menu);
        $query = $this->db->get();
        return $query->result_array();
    }

}