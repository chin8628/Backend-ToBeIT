<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('attendees_model');
        $this->load->model('page_model');
        $this->load->model('Checkin_model');
        $this->load->model('Class_model');
        $this->load->model('Sheet_model');
        $this->load->model('Food_model');
        $this->Auth_model->only_logged();
    }

    public function index() {

        $data = array(
                "title" => "Report | Backend - ToBeIT"
            );

        $menu = $this->Food_model->get_menu_food();
        $data['menu_food'] = "";
        foreach ($menu as $key => $value) {
            $data['menu_food'] .= '<option>'.$value.'</option>';
        }

        $this->parser->parse('templates/header', $data);
        $this->parser->parse('report', $data);
        $this->load->view('templates/footer');

    }

    public function order_food() {

        $menu = $this->input->get('menu');
        $order = $this->Food_model->get_order_food($menu);
        echo '<h3><center>รายชื่อจำนวนคนสั่งเมนูอาหาร '.$menu.'</center></h3>';
        echo '<table>';
        echo '<tbody>';
        echo '<tr><td align="center" width="120px">เลขประจำตัว</td><td>ชื่อ - นามสกุล</td><td>ชื่อเล่น</td><td width="100px"></td></tr>';
        foreach ($order as $key => $value) {
            echo '<tr>';
            echo '<td align="center">' . $value['id_student'] . '</td>';
            echo '<td>' . $value['prename'] . ' ' . $value['name'] . ' ' . $value['surname'] . '</td>';
            echo '<td>' . $value['nickname'] . '</td>';
            echo '<td><center><div style="height: 10px; width: 10px; border: solid 1px black;"></div></center></td>';
            echo '</tr>';
        }
        echo "</tbody>";
        echo "</table>";

    }

}
