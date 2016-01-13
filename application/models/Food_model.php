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

}