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
if (!function_exists('is_admin')) {

    function is_admin() {
        $ci = & get_instance();
        $ci->load->library('session');
        if (isset($ci->session->userdata['role']) && $ci->session->userdata['role'] == 'A') {
            return true;
        } else {
            return false;
        }
    }

}
if (!function_exists('pool_count')) {

    function pool_count() {
        $ci = & get_instance();
        $ci->load->model('Main_model');
        $pool_count = $ci->Main_model->get_single_record('tbl_pool', array(), 'max(pool_level) as pool_count');
        return $pool_count;
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
if (!function_exists('calculate_package')) {

    function calculate_package($package_id) {
        if($package_id == 1)
            $package = '3600';
        elseif($package_id == 2)
            $package = '1400';
        else
            $package = 'Free';
        return $package;
    }
}

if (!function_exists('incomes')) {

    function incomes() {
        $incomes = array(
          'matching_bonus'=> 'Matching Income',
          'direct_level_income'=> 'Senior Support Bonus',
          'team_performace_bonus' => 'Team Performace Bonus',
          'silver_income'=> 'Star Royalty',
          'gold_income'=> 'Ruby Royalty',
          'platinum_income' => 'Royal Royalty',
          'upline_income' => 'Upline Income',
          'club_income' => 'Club Income',
          'repurchase_level_income' => 'Repurchase Level Income',
          'car_fund' => 'Car Fund',
          'house_fund' => 'House Fund',
          'travel_fund' => 'Travel Fund',
          'life_time_royalty' => 'Life Time Royalty',

        );
        return $incomes;
    }

}

if(!function_exists('calculate_incomes')){
    function calculate_incomes($incomeArr){
        $incomeNames = array(
            'matching_bonus',
            'direct_level_income',
            'silver_income',
            'gold_income',
            'platinum_income',
            'upline_income',
            'club_income',
            'repurchase_level_income',
            'car_fund',
            'house_fund',
            'travel_fund',
            'life_time_royalty',
            'team_performace_bonus',
        );
        $incomeVal = array();
        foreach($incomeNames as $key => $name){
            foreach($incomeArr as $k => $i){
                if($i['type'] == $name){
                    $incomeVal[ $i['type']] = $i['income'];
                    break;
                }else{
                    $incomeVal[$name] = 0;
                }
            }
        }
        return $incomeVal;
    }
}
