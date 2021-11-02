<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
        date_default_timezone_set('Asia/Kolkata');
    }

    public function index() {

    }
    public function point_match_cron() {
        $response['users'] = $this->Main_model->get_records('tbl_users', '(leftPower >= 2 and rightPower >= 1 and directs >= 2) OR (leftPower >= 1 and rightPower >= 2  and directs >= 2)', 'id,user_id,sponser_id,leftPower,rightPower,package_amount,capping,directs');
        foreach ($response['users'] as $user) {
            pr($user);
            // $user_package = $this->Main_model->get_single_record_desc('tbl_package', array('id' => $user['package']), '*');
            $user_match = $this->Main_model->get_single_record_desc('tbl_point_matching_income', array('user_id' => $user['user_id']), '*');
            $position_directs = $this->Main_model->count_position_directs($user['user_id']);
            // if(!empty($position_directs) && count($position_directs) == 2){
                if (!empty($user_match)) {
                    if ($user['leftPower'] > $user['rightPower']) {
                        $old_income = $user['rightPower'];
                    } else {
                        $old_income = $user['leftPower'];
                    }
                    if ($user_match['left_bv'] > $user_match['right_bv']) {
                        $new_income = $user_match['right_bv'];
                    } else {
                        $new_income = $user_match['left_bv'];
                    }
                    $income = ($old_income - $new_income);
                    $user_income = $income * 50;
                    if ($user_income > 0) {
                        $matchArr = array(
                            'user_id' => $user['user_id'],
                            'left_bv' => $user['leftPower'],
                            'right_bv' => $user['rightPower'],
                            'amount' => $user_income,
                        );
                        $this->Main_model->add('tbl_point_matching_income', $matchArr);
                        if($user['capping'] < $user_income){
                            $user_income = $user['capping'];
                        }
                        $incomeArr = array(
                            'user_id' => $user['user_id'],
                            'amount' => $user_income,
                            'type' => 'matching_bonus',
                            'description' => 'Point Matching Bonus'
                        );
                        $this->Main_model->add('tbl_income_wallet', $incomeArr);
                        $this->generation_income($user['sponser_id'], ($user_income), $user['user_id'], 'generation_income');
                        $this->sponsers_directs_bonus($user['user_id'] , $user_income * 10/100);
                        // $this->direct_sponser_income(($user_income * 5 / 100), $user['directs'], $user['user_id']);
                        pr($matchArr);
                    }
                } else {
                    if ($user['leftPower'] > $user['rightPower']) {
                        $leftPower = $user['leftPower'] - 1;
                        $rightPower = $user['rightPower'];
                    } else {
                        $rightPower = $user['rightPower'] -1;
                        $leftPower = $user['leftPower'];
                    }
                    if($leftPower > $rightPower){
                        $income = $rightPower;

                    }else{
                        $income = $leftPower;
                    }
                    $user_income = $income * 50;
                    //                echo $user_income;
                    if($user['capping'] < $user_income){
                        $user_income = $user['capping'];
                    }
                    $matchArr = array(
                        'user_id' => $user['user_id'],
                        'left_bv' => $user['leftPower'],
                        'right_bv' => $user['rightPower'],
                        'amount' => $user_income,
                    );
                    $this->Main_model->add('tbl_point_matching_income', $matchArr);
                    $incomeArr = array(
                        'user_id' => $user['user_id'],
                        'amount' => $user_income,
                        'type' => 'matching_bonus',
                        'description' => 'Point Matching Bonus'
                    );
                    $this->Main_model->add('tbl_income_wallet', $incomeArr);
                    $this->generation_income($user['sponser_id'], ($user_income), $user['user_id'], 'generation_income');
                    $this->sponsers_directs_bonus($user['user_id'] , $user_income * 10/100);
                    pr($matchArr);
                }

            // }
        }
        pr($response);
        die('code executed Successfully');
    }

    public function sponsers_directs_bonus($user_id , $amount){
        $directs = $this->Main_model->get_records('tbl_users',['sponser_id' => $user_id,'paid_status' => 1] , 'id,user_id');
        if(!empty($directs)){
            $income = $amount / count($directs);
            foreach($directs as $k => $direct){
                $incomeArr = array(
                    'user_id' => $direct['user_id'],
                    'amount' => $income,
                    'type' => 'direct_level_income',
                    'description' => 'Senior Support Bonus from '.$user_id
                );
                $this->Main_model->add('tbl_income_wallet', $incomeArr);
            }
        }
    }
//     public function point_match_cron() {
//         $response['users'] = $this->Main_model->get_records('tbl_users', '(leftPower >= 1 and rightPower >= 1 )', 'id,user_id,sponser_id,leftPower,rightPower,package_amount,capping');
//         foreach ($response['users'] as $user) {
//             pr($user);
//             // $user_package = $this->Main_model->get_single_record_desc('tbl_package', array('id' => $user['package']), '*');
//             $user_match = $this->Main_model->get_single_record_desc('tbl_point_matching_income', array('user_id' => $user['user_id']), '*');
//             if (!empty($user_match)) {
//                 if ($user['leftPower'] > $user['rightPower']) {
//                     $old_income = $user['rightPower'];
//                 } else {
//                     $old_income = $user['leftPower'];
//                 }
//                 if ($user_match['left_bv'] > $user_match['right_bv']) {
//                     $new_income = $user_match['right_bv'];
//                 } else {
//                     $new_income = $user_match['left_bv'];
//                 }
//                 $income = ($old_income - $new_income);
//                 $user_income = $income * 8 / 100;
//                 if ($user_income > 0) {
//                     if($user_income > $user['capping']){
//                         $user_income = $user['capping'];
//                     }
//                     $matchArr = array(
//                         'user_id' => $user['user_id'],
//                         'left_bv' => $user['leftPower'],
//                         'right_bv' => $user['rightPower'],
//                         'amount' => $user_income,
//                     );
//                     $this->Main_model->add('tbl_point_matching_income', $matchArr);
//                     $incomeArr = array(
//                         'user_id' => $user['user_id'],
//                         'amount' => $user_income,
//                         'type' => 'matching_bonus',
//                         'description' => 'Point Matching Bonus'
//                     );
//                     $this->Main_model->add('tbl_income_wallet', $incomeArr);
//                     $this->generation_income($user['sponser_id'] , $user_income , $user['user_id'],'salary_income');
//                     pr($matchArr);
//                 }
//             } else {
//                 if ($user['leftPower'] > $user['rightPower']) {
//                     $income = $user['rightPower'];
//                 } else {
//                     $income = $user['leftPower'];
//                 }
//                 $user_income = $income * 8 / 100;
// //                echo $user_income;
//                 if($user_income > $user['capping']){
//                     $user_income = $user['capping'];
//                 }
//                 $matchArr = array(
//                     'user_id' => $user['user_id'],
//                     'left_bv' => $user['leftPower'],
//                     'right_bv' => $user['rightPower'],
//                     'amount' => $user_income,
//                 );
//                 $this->Main_model->add('tbl_point_matching_income', $matchArr);
//                 $incomeArr = array(
//                     'user_id' => $user['user_id'],
//                     'amount' => $user_income,
//                     'type' => 'matching_bonus',
//                     'description' => 'Point Matching Bonus'
//                 );
//                 $this->Main_model->add('tbl_income_wallet', $incomeArr);
//                 //$this->generation_income($user['sponser_id'] , $user_income , $user['user_id'],'salary_income');
//                 pr($matchArr);
//             }
//         }
//         pr($response);
//         die('code executed Successfully');
//     }
    public function generation_income($user_id , $amount , $sender_id , $type = 'direct_sponser_income'){
        //10,5,3,2,1 salary_income
        $incomeArr = [15,10,10,5];
        foreach($incomeArr as $key => $ia){
            $user = $this->Main_model->get_single_record('tbl_users',['user_id' => $user_id] , 'user_id , sponser_id');
            if(!empty($user)){
                $incomeArr = array(
                    'user_id' => $user['user_id'],
                    'amount' => $amount * $ia / 100,
                    'type' => 'team_performace_bonus',
                    'description' => 'Team Performance Bonus From ' .$sender_id
                );
                $user_id = $user['sponser_id'];
               $this->Main_model->add('tbl_income_wallet', $incomeArr);
            }
        }
    }
    public function roi_booster(){
        $rois = $this->Main_model->get_records('tbl_roi', ['booster_status' => 0], '*');
        foreach($rois as $key => $roi){
            $user = $this->Main_model->get_single_record_desc('tbl_users', ['user_id' => $roi['user_id']], 'package_amount');
            $directs_count = $this->Main_model->get_single_record('tbl_users',['sponser_id' => $roi['user_id'],'package_amount >=' => $user['package_amount']] ,'ifnull(count(id),0) as direct_count');
            if($directs_count['direct_count'] >= 2){
                $this->Main_model->update('tbl_roi', array('id' => $roi['id']), array('days' => round($roi['days']/1.5), 'roi_amount' => ($roi['roi_amount'] * 1.5),'booster_status' => 1) );
            }
        }
    }
    public function repurchase_matching_income(){
        $todays_bv = $this->Main_model->get_single_record_desc('tbl_orders', 'month(created_at) = month(now())', 'ifnull(sum(bv),0) as todays_bv');
        $response['users'] = $this->Main_model->get_records('tbl_users', '(leftBusiness >= 1 and rightBusiness >= 1 )', 'id,user_id,sponser_id,leftBusiness,rightBusiness,package_amount,capping');
        $i = 0;
        $matching_users = array();
        $matched_bv = 0;
        foreach ($response['users'] as $user) {
            $user_match = $this->Main_model->get_single_record_desc('tbl_business_matching', array('user_id' => $user['user_id']), '*');
            if (!empty($user_match)) {
                if ($user['leftBusiness'] > $user['rightBusiness']) {
                    $old_income = $user['rightBusiness'];
                } else {
                    $old_income = $user['leftBusiness'];
                }
                if ($user_match['left_bv'] > $user_match['right_bv']) {
                    $new_income = $user_match['right_bv'];
                } else {
                    $new_income = $user_match['left_bv'];
                }
                $income = ($old_income - $new_income);
                if ($income > 0) {
                    $matching_users[$i]['user_id'] = $user['user_id'];
                    $matching_users[$i]['left_bv'] = $user_match['left_bv'];
                    $matching_users[$i]['right_bv'] = $user_match['right_bv'];
                    $matching_users[$i]['bv'] = $income;
                    $matching_users[$i]['sponser_id'] = $user['sponser_id'];
                    $matched_bv  = $matched_bv  + $income;
                    $i++;
                }
            } else {
                if ($user['leftBusiness'] > $user['rightBusiness']) {
                    $income = $user['rightBusiness'];
                } else {
                    $income = $user['leftBusiness'];
                }
                $matching_users[$i]['user_id'] = $user['user_id'];
                $matching_users[$i]['left_bv'] = $user['leftBusiness'];
                $matching_users[$i]['right_bv'] = $user['rightBusiness'];
                $matching_users[$i]['bv'] = $income;
                $matching_users[$i]['sponser_id'] = $user['sponser_id'];
                $matched_bv  = $matched_bv  + $income;
                $i++;
            }
        }
        // pr($matching_users);
        echo ' Todays BV  : ' .$todays_bv['todays_bv'] .'<br>';
        $distribution = $todays_bv['todays_bv'] * 32 / 100;
        echo ' Distribution Amount  : ' .$distribution.'<br>';
        echo ' Matched BV  : ' .$matched_bv  .'<br>';
        if($matched_bv > 0){
            $one_pair_amount = round(($distribution / $matched_bv),2);
            echo 'One BV Amount  : ' .$one_pair_amount . '<br>';
            foreach($matching_users as $user){
                $user['income'] = $user['bv'] * $one_pair_amount;
                $matchArr = array(
                    'user_id' => $user['user_id'],
                    'left_bv' => $user['left_bv'],
                    'right_bv' => $user['right_bv'],
                    'amount' => $user['income'],
                );
                $this->Main_model->add('tbl_business_matching', $matchArr);
                $incomeArr = array(
                    'user_id' => $user['user_id'],
                    'amount' =>$user['income'],
                    'type' => 'repurchase_income',
                    'description' => 'Repurchase Income'
                );
                pr($user);
                $this->Main_model->add('tbl_income_wallet', $incomeArr);
                //$this->generation_income($user['sponser_id'] , ($user['income']* 5 / 100) , $user['user_id'],'direct_sponser_income');
            }

        }
    }

    public function scratchStatus(){
		$checkCron = $this->Main_model->get_single_record('tbl_cron','date(created_at) = date(NOW()) AND cron_name = "scratch"','*');
		if(empty($checkCron)){
			$this->Main_model->update('tbl_users',array(),['scratch' => 0]);
			$this->Main_model->add('tbl_cron',['cron_name' => 'scratch']);
		}else{
			echo 'Cron is already run';
		}
    }

    public function roiCron(){
        die;
      // if(date('D') == 'Sun' || date('D') == 'Sat'){
      //     die('its weekend');
      // }
        $roi_users = $this->Main_model->get_records('tbl_roi', array('amount >' => 0 , 'type !=' => 'salary'), '*');
        foreach($roi_users as $key => $user){
            $new_day = $user['days'] - 1;
            $incomeArr = array(
                'user_id' => $user['user_id'],
                'amount' => $user['roi_amount'],
                'type' => 'daily_roi_income',
                'description' => 'Daily Redeem Points at '.$new_day . ' Day',
            );
            pr($user);
            $this->Main_model->add('tbl_income_wallet', $incomeArr);
            $this->Main_model->update('tbl_roi', array('id' => $user['id']), array('days' => $new_day, 'amount' => ($user['amount'] - $user['roi_amount'])));
        }
    }
    public function retopupCron(){
        $users = $this->Main_model->get_records('tbl_users', 'date(topup_date) > date(now()) - 3 and package_id > 0', 'id,user_id,date(topup_date),paid_status,package_amount');
        foreach($users as $key => $user){
            pr($user);
            $directs = $this->Main_model->get_single_record('tbl_users', array('sponser_id' => $user['user_id'] , 'package_amount >=' => $user['package_amount']), 'sum(package_amount) as package_amount,count(id) as directs,');
            $roi = $this->Main_model->get_single_record('tbl_roi', array('user_id' => $user['user_id']) ,'*');
            $fastrack_income = $this->Main_model->get_single_record('tbl_income_wallet', array('user_id' => $user['user_id'] ,'type' => 'fasttrack_income') ,'*');
            if(empty($fastrack_income)){

                if($roi['amount'] > 0){
                    if($directs['directs'] >= 5){
                        $incomeArr = array(
                            'user_id' => $user['user_id'],
                            'amount' => $user['package_amount'] * 2,
                            'type' => 'fasttrack_income',
                            'description' => 'FastTrack Income at ',
                        );
                        $this->Main_model->add('tbl_income_wallet', $incomeArr);
                        $this->Main_model->update('tbl_roi', array('user_id' => $user['user_id']), array( 'amount' => 0));
                    }elseif($directs['directs'] >= 3){
                        $incomeArr = array(
                            'user_id' => $user['user_id'],
                            'amount' => $user['package_amount'],
                            'type' => 'fasttrack_income',
                            'description' => 'FastTrack Income at ',
                        );
                        $this->Main_model->add('tbl_income_wallet', $incomeArr);
                        // $this->Main_model->update('tbl_roi', array('user_id' => $user['user_id']), array( 'amount' => 0));
                    }
                }
            }
        }
    }
    public function WithdrawCron(){
        $date = date('d');
        if($date == '11' || $date == '21' || $date == '30' ){
            $checkCron = $this->Main_model->get_single_record('tbl_cron','date(created_at) = date(NOW()) AND cron_name = "withdraw_cron"','*');
            if(empty($checkCron)){
                $users = $this->Main_model->withdraw_users(100);
                pr($users);
                foreach($users as $key => $user){
                    if($user['total_amount'] % 100 == 0){
                        $amount = $user['total_amount'];
                    }else{
                        $deduct = $user['total_amount'] % 100;
                        $amount = $user['total_amount'] -$deduct;
                    }

                    $DirectIncome = array(
                        'user_id' => $user['user_id'],
                        'amount' => - $amount ,
                        'type' => 'withdraw_request',
                        'description' => 'Withdraw Request',
                    );
                    $this->Main_model->add('tbl_income_wallet', $DirectIncome);
                    $withdrawArr = array(
                        'user_id' => $user['user_id'],
                        'amount' => $amount,
                        'type' => 'direct_income',
                        'tds' => $amount  * 5 /100,
                        'admin_charges' => $amount  * 5 /100,
                        'fund_conversion' => 0,
                        'payable_amount' => $amount * 90 /100
                    );
                    $this->Main_model->add('tbl_withdraw', $withdrawArr);
                }
                $this->Main_model->add('tbl_cron',['cron_name' => 'withdraw_cron']);
            }else{
                echo 'Cron is already run';
            }
        }else{
            echo 'Withdraw on 10,20,30 of every month';
        }
    }
    public function rewardsCron(){
        $awardsArr = array(
            2000,
            6000,
            16000,
            36000,
            86000,
            186000,
            386000
        );
        $response['users'] = $this->Main_model->get_records('tbl_users', '(leftPower >= 2000 and rightPower >= 2000 )', 'id,user_id,sponser_id,leftPower,rightPower,package_amount,capping');
        foreach ($response['users'] as $user) {
            pr($user);
            if($user['leftPower'] >= 386000 && $user['rightPower'] >= 386000){
                $userReward = $this->Main_model->get_single_record_desc('tbl_rewards', array('user_id' => $user['user_id'] , 'amount' => 20000), '*');
                if(empty($userReward)){
                    $incomeArr = array(
                        'user_id' => $user['user_id'],
                        'amount' => 20000,
                        'type' => 'rewards_income',
                        'description' => 'Reward Income',
                    );
                    $this->Main_model->add('tbl_income_wallet', $incomeArr);
                    $this->Main_model->add('tbl_rewards', array('user_id' => $user['user_id'] , 'amount' => 20000));
                }
            }
            if($user['leftPower'] >= 186000 && $user['rightPower'] >= 186000){
                $userReward = $this->Main_model->get_single_record_desc('tbl_rewards', array('user_id' => $user['user_id'] , 'amount' => 6000), '*');
                if(empty($userReward)){
                    $incomeArr = array(
                        'user_id' => $user['user_id'],
                        'amount' => 6000,
                        'type' => 'rewards_income',
                        'description' => 'Reward Income',
                    );
                    $this->Main_model->add('tbl_income_wallet', $incomeArr);
                    $this->Main_model->add('tbl_rewards', array('user_id' => $user['user_id'] , 'amount' => 6000));
                }
            }
            if($user['leftPower'] >= 86000 && $user['rightPower'] >= 86000){
                $userReward = $this->Main_model->get_single_record_desc('tbl_rewards', array('user_id' => $user['user_id'] , 'amount' => 2000), '*');
                if(empty($userReward)){
                    $incomeArr = array(
                        'user_id' => $user['user_id'],
                        'amount' => 2000,
                        'type' => 'rewards_income',
                        'description' => 'Reward Income',
                    );
                    $this->Main_model->add('tbl_income_wallet', $incomeArr);
                    $this->Main_model->add('tbl_rewards', array('user_id' => $user['user_id'] , 'amount' => 2000));
                }
            }
            if($user['leftPower'] >= 36000 && $user['rightPower'] >= 36000){
                $userReward = $this->Main_model->get_single_record_desc('tbl_rewards', array('user_id' => $user['user_id'] , 'amount' => 1000), '*');
                if(empty($userReward)){
                    $incomeArr = array(
                        'user_id' => $user['user_id'],
                        'amount' => 1000,
                        'type' => 'rewards_income',
                        'description' => 'Reward Income',
                    );
                    $this->Main_model->add('tbl_income_wallet', $incomeArr);
                    $this->Main_model->add('tbl_rewards', array('user_id' => $user['user_id'] , 'amount' => 1000));
                }
            }
            if($user['leftPower'] >= 16000 && $user['rightPower'] >= 16000){
                $userReward = $this->Main_model->get_single_record_desc('tbl_rewards', array('user_id' => $user['user_id'] , 'amount' => 500), '*');
                if(empty($userReward)){
                    $incomeArr = array(
                        'user_id' => $user['user_id'],
                        'amount' => 500,
                        'type' => 'rewards_income',
                        'description' => 'Reward Income',
                    );
                    $this->Main_model->add('tbl_income_wallet', $incomeArr);
                    $this->Main_model->add('tbl_rewards', array('user_id' => $user['user_id'] , 'amount' => 500));
                }
            }
            if($user['leftPower'] >= 6000 && $user['rightPower'] >= 6000){
                $userReward = $this->Main_model->get_single_record_desc('tbl_rewards', array('user_id' => $user['user_id'] , 'amount' => 200), '*');
                if(empty($userReward)){
                    $incomeArr = array(
                        'user_id' => $user['user_id'],
                        'amount' => 200,
                        'type' => 'rewards_income',
                        'description' => 'Reward Income',
                    );
                    $this->Main_model->add('tbl_income_wallet', $incomeArr);
                    $this->Main_model->add('tbl_rewards', array('user_id' => $user['user_id'] , 'amount' => 200));
                }
            }
            if($user['leftPower'] >= 2000 && $user['rightPower'] >= 2000){
                $userReward = $this->Main_model->get_single_record_desc('tbl_rewards', array('user_id' => $user['user_id'] , 'amount' => 100), '*');
                // pr($userReward);
                if(empty($userReward)){
                    $incomeArr = array(
                        'user_id' => $user['user_id'],
                        'amount' => 100,
                        'type' => 'rewards_income',
                        'description' => 'Reward Income',
                    );
                    $this->Main_model->add('tbl_income_wallet', $incomeArr);
                    $this->Main_model->add('tbl_rewards', array('user_id' => $user['user_id'] , 'amount' => 100));
                }
            }
        }
    }
    public function coinPaymentCheck(){
        $cmd = 'get_tx_ids';
        $public_key = 'dcc0051691db18fd4657a725d956f5cddb16e95b7394322c5c1d071a6e9eacb9';
        $private_key = '8D9be455F35Ed9e76B69bE1cdbe8004e8a46f73Ede5Ff7D711F74307a888CBA7';
        $req['version'] = 1;
        $req['cmd'] = $cmd;
        $req['key'] = $public_key;
        $req['format'] = 'json';
        $post_data = http_build_query($req, '', '&');
        $hmac = hash_hmac('sha512', $post_data, $private_key);
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($ch);
        pr($data);
        $data = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);

        foreach($data['result'] as $d){
            $b_transaction = $this->Main_model->get_single_record_desc('BTC_TRANSACTION', array('transaction_id' => $d), '*');
            if(empty($b_transaction)){
                $this->getinfo2('get_tx_info', $d);
            }
            pr($d);
            // $sql = "SELECT transaction_id from BTC_TRANSACTION where transaction_id = '".$d."'";
            // $result = $conn->query($sql);
            // $i = 1;
            // if ($result->num_rows == 0) {
            //     getinfo2($conn,'get_tx_info', $d);
            // }else{
            //     echo $d.' this id already registered <br>';
            // }
        }
    }
    function getinfo2($cmd = 'get_tx_info', $tax_id ='CPDI1TBAPSGQYM0DBRRDHSMTA0') {
        $public_key = 'dcc0051691db18fd4657a725d956f5cddb16e95b7394322c5c1d071a6e9eacb9';
        $private_key = '8D9be455F35Ed9e76B69bE1cdbe8004e8a46f73Ede5Ff7D711F74307a888CBA7';
        $req['version'] = 1;
        $req['cmd'] = $cmd;
        $req['txid'] = $tax_id;
        $req['full'] = TRUE;
        $req['key'] = $public_key;
        $req['format'] = 'json'; //supported values are json and xml
        $post_data = http_build_query($req, '', '&');
        $hmac = hash_hmac('sha512', $post_data, $private_key);
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($ch);
        $data2 = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
        echo'<pre>';
        print_r($data2);
        echo'</pre>';
        $send['transaction_id'] = $tax_id;
        $send['created_time'] = $data2['result']['time_created'];
        $send['time_expires'] = $data2['result']['time_expires'];
        $send['status'] = $data2['result']['status'];
        $send['status_text'] = $data2['result']['status_text'];
        $send['type'] = $data2['result']['type'];
        $send['coin'] = $data2['result']['coin'];
        $send['amount'] = $data2['result']['amount'];
        $send['amountf'] = $data2['result']['checkout']['amountf'];
        $send['received'] = $data2['result']['received'];
        $send['receivedf'] = $data2['result']['receivedf'];
        $send['recv_confirms'] = $data2['result']['recv_confirms'];
        $send['payment_address'] = $data2['result']['payment_address'];
        $send['invoice'] = $data2['result']['checkout']['invoice'];
        $send['user_id'] = $data2['result']['checkout']['custom'];
        $send['first_name'] = $data2['result']['checkout']['first_name'];
        $send['last_name'] = $data2['result']['checkout']['last_name'];
        $send['package'] = $data2['result']['checkout']['item_name'];
        // $columns = implode(", ",array_keys($send));
        // // $escaped_values = array_map(array_values($send));
        // $values  = '"'.implode('","', array_values($send)).'"';
        // print_r(array_values($send));
        $this->Main_model->add('BTC_TRANSACTION', $send);
        // echo $sql = "INSERT INTO `BTC_TRANSACTION`($columns) VALUES ($values)";
        // $conn->query($sql);
        if($send['status'] ==    100){
            $amountArr = array('user_id' => $send['first_name'] ,'amount' => $send['amountf'],'transaction_id' => $send['transaction_id']);
            $this->Main_model->add('tbl_payment_request', $amountArr);
        //    echo $sql2 = "insert into tbl_payment_request (user_id ,amount,transaction_id ) values('".$send['first_name']."' ,'".$send['amountf']."','".$send['transaction_id']."')";
        //     $conn->query($sql2);
        }
    }
    public function topup_account(){

    }
    public function bitCoinResponse($cmd = 'get_tx_info', $tax_id ='CPEB5IAUSQKYDAMGR8G1GBW0MF'){
        $public_key = 'dcc0051691db18fd4657a725d956f5cddb16e95b7394322c5c1d071a6e9eacb9';
        $private_key = '8D9be455F35Ed9e76B69bE1cdbe8004e8a46f73Ede5Ff7D711F74307a888CBA7';
        $req['version'] = 1;
        $req['cmd'] = $cmd;
        $req['txid'] = $tax_id;
        $req['full'] = TRUE;
        $req['key'] = $public_key;
        $req['format'] = 'json'; //supported values are json and xml
        $post_data = http_build_query($req, '', '&');
        $hmac = hash_hmac('sha512', $post_data, $private_key);
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($ch);
        $data2 = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
        echo'<pre>';
        print_r($data2);
        echo'</pre>';
    }
    public function calculate_salary_income(){
        $response['users'] = $this->Main_model->get_records('tbl_users', '(leftPower >= 100000 and rightPower >= 100000 )', 'id,user_id,sponser_id,leftPower,rightPower,package_amount,capping');
        foreach ($response['users'] as $user) {
            $macthings = [
                ['matching' => '1000000' , 'amount' => 5000],
                ['matching' => '2500000' , 'amount' => 10000],
                ['matching' => '5000000' , 'amount' => 25000],
                ['matching' => '10000000' , 'amount' => 50000],
            ];
            foreach($macthings as $key => $match){
                $user['matching'] = $match['matching'];
                $user['amount'] = $match['amount'];
                pr($user);
                if($user['leftPower'] >= $match['matching'] && $user['rightPower'] >= $match['matching']){
                    echo 'Achieved';
                    $roi_status = $this->Main_model->get_single_record_desc('tbl_roi', array('type' => 'salary','roi_amount' => $match['amount'] , 'user_id' => $user['user_id']), '*');
                    if(empty($roi_status)){
                        $incomeArr = array(
                            'user_id' => $user['user_id'],
                            'amount' => $match['amount'] * 12,
                            'type' => 'salary',
                            'days' => '12',
                            'roi_amount' => $match['amount'],
                        );
                        $this->Main_model->add('tbl_roi', $incomeArr);
                    }
                }
            }
        }
    }
    public function credit_salary_income(){
        $roi_users = $this->Main_model->get_records('tbl_roi', array('amount >' => 0 , 'type' => 'salary'), '*');
        foreach($roi_users as $key => $user){
            $this_month_roi = $this->Main_model->get_single_record_desc('tbl_income_wallet', array('type' => 'salary_income' , 'user_id' => $user['user_id'],'month(created_at)' => date('m')), '*');
            if(empty($this_month_roi)){

                $new_day = $user['days'] - 1;
                $incomeArr = array(
                    'user_id' => $user['user_id'],
                    'amount' => $user['roi_amount'],
                    'type' => 'salary_income',
                    'description' => 'salary Income at '.$new_day . ' Month',
                );
                pr($user);
                $this->Main_model->add('tbl_income_wallet', $incomeArr);
                $this->Main_model->update('tbl_roi', array('id' => $user['id']), array('days' => $new_day, 'amount' => ($user['amount'] - $user['roi_amount'])));
            }
        }
    }
}
