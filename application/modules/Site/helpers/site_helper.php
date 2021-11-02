<?php

if (!function_exists('pr')) {

    function pr($array, $die = false) {
        echo'<pre>';
        print_r($array);
        echo'</pre>';
        if ($die)
            die();
    }

}

if (!function_exists('calculate_rank')) {

function calculate_rank($directs) {
    if($directs >= 100)
        $rank = 'Diamond';
    elseif($directs >= 50)
        $rank = 'Emerald';
    elseif($directs >= 25)
        $rank = 'Topaz';
    elseif($directs >= 20)
        $rank = 'Pearl';
    elseif($directs >= 15)
        $rank = 'Gold';
    elseif($directs >= 10)
        $rank = 'Silver';
    elseif($directs >= 5)
        $rank = 'Star';
    else
        $rank = 'Associate';
    
    return $rank;
}
}

if(!function_exists('siteContent')){
    function siteContent(){
        $ci =& get_instance();
        $ci->load->model('Main_model');
        $siteContent = $ci->Main_model->get_single_record('tbl_site_content',['id' => 1],'*');
        return $siteContent;
    }
}

if (!function_exists('is_logged_in')) {
    function is_logged_in() {
        $ci = & get_instance();
        $ci->load->library('session');
        if (isset($ci->session->userdata['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
}

if(!function_exists('userinfo')){
    function userinfo(){
        $ci =& get_instance();
        $ci->load->model('Main_model');
        $userdata = $ci->Main_model->get_single_record('tbl_users',['email' => $ci->session->userdata['user_id']],'*');
        return $userdata;
    }
}