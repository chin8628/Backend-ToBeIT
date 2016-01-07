<?php

class Page_model extends CI_Model {

    public function paginate($table, $grab, $url, $page_now=false){

        $number_atten = $this->db->count_all($table);
        $page = ceil($number_atten / $grab);
        $temp = '<nav><ul class="pagination">';
        if($page == 1){
            $temp .= '<li><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        else{
            $temp_page = $page - 1;
            $temp .= '<li><a href="'.$url.'?page='.$temp_page.'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for($i=1; $i <= $page; $i+=1){
            if($page_now == $i && $page_now != false)
                $temp .= '<li class="active"><a href="'.$url.'?page='.$i.'">'.$i.'</a></li>';
            else
                $temp .= '<li><a href="'.$url.'?page='.$i.'">'.$i.'</a></li>';
        }
        if($page == $this->attendees_model->number_page()){
            $temp .= '<li><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
        }
        else{
            $page += 1;
            $temp .= '<li><a href="'.$url.'?page='.$page.'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
        }
        $temp .= "</ul></nav>";

        return $temp;
    }
}