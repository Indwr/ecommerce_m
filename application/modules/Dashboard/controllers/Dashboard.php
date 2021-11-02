<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index() {
        if (is_logged_in()) {
            redirect('Dashboard/User/');
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function coupans(){
        if (is_logged_in()) {
            $response = array();
            $this->load->view('coupons-amazing', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function Matching_business(){
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Matching Business';
            $response['records'] = $this->User_model->get_records('tbl_point_matching_income',['user_id' => $this->session->userdata['user_id']],'*');
            $this->load->view('matching_business', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function ActivateAccount() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                // if($response['user']['role'] == 'F'){
                    $data = $this->security->xss_clean($this->input->post());
                    $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $user_id = $data['user_id'];
                        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                        $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                        $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                        if(!empty($user)){
                            if($wallet['wallet_balance'] >= $package['price']){
                                if($user['paid_status'] == 0){
                                    $sendWallet = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => -$package['price'],
                                        'type' => 'account_activation',
                                        'remark' => 'Account Activation Deduction for '.$user_id,
                                    );
                                    $this->User_model->add('tbl_wallet', $sendWallet);
                                    $topupData = array(
                                            'paid_status' => 1,
                                            'package_id' => $data['package_id'] ,
                                            'capping' => $package['capping'] ,
                                            'package_amount' => $package['price'],
                                            'topup_date' => date('Y-m-d h:i:s'),
                                            );
                                    $this->User_model->update('tbl_users', array('user_id' => $user_id),$topupData);
                                    $this->User_model->update_directs($user['sponser_id']);
                                    $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs');
                                    $DirectIncome = array(
                                        'user_id' => $user['sponser_id'],
                                        'amount' => $package['direct_income'] ,
                                        'type' => 'direct_income',
                                        'description' => 'Direct Income from Activation of Member '.$user_id,
                                    );
                                //  $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                    $this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'] , $type = 'topup');
                                    $this->update_direct_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'] , $type = 'topup');
                                    // $this->repurchase_income($user['sponser_id'],($package['direct_income'] * 20 / 100),'direct_income' ,'Direct Income from Activation of Member '.$user_id);
                                    // $this->level_income($sponser['sponser_id'] , $user['user_id'],$package['level_income']);
                                    //$this->pool_entry($user['user_id'],1 , 500);
                                    //$this->pool_entry($user['user_id'],1 , 500);
                                    //$this->pool_entry($user['user_id'],1 , 500);
                                    //$this->pool_entry($user['user_id'],1 , 500);
                                    //$this->pool_entry($user['user_id'],1 , 500);
                                    // if($package['price'] == 3600)
                                    // $this->rank_bonus($user['user_id'], 200,$user['user_id'],0 , $package['price']);
                                    // else
                                    // $this->rank_bonus($user['user_id'], 105,$user['user_id'],0 , $package['price']);
                                    $this->credit_coupans($user['user_id']);
                                    $this->session->set_flashdata('message', 'Account Activated Successfully');
                                }else{
                                    $this->session->set_flashdata('message', 'This Account Already Acitvated');
                                }
                            }else{
                                $this->session->set_flashdata('message', 'Insuffcient Balance');
                            }
                        }else{
                            $this->session->set_flashdata('message', 'Invalid User ID');
                        }
                    }
                // }else{
                //     $this->session->set_flashdata('message', 'Only Franchise Account Can Activate Accounts');
                // }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package', array(), '*');
            $this->load->view('activate_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function upgradeAccount() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('package_id', 'Package', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    //$user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                    if(!empty($user)){
                        if($wallet['wallet_balance'] >= $package['price']){
                            if($user['package_amount'] < $package['price']){
                                $sendWallet = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$package['price'],
                                    'type' => 'account_activation',
                                    'remark' => 'Account Activation Deduction for '.$this->session->userdata['user_id'],
                                );
                                $this->User_model->add('tbl_wallet', $sendWallet);
                                $topupData = array(
                                        'paid_status' => 1,
                                        'package_id' => $data['package_id'] ,
                                        'capping' => $package['capping'] ,
                                        'package_amount' => $package['price'],
                                        'topup_date' => date('Y-m-d h:i:s'),
                                        );
                                $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']),$topupData);
                                //$this->User_model->update_directs($user['sponser_id']);
                                // $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs');
                                // $DirectIncome = array(
                                //     'user_id' => $user['sponser_id'],
                                //     'amount' => $package['direct_income'] ,
                                //     'type' => 'direct_income',
                                //     'description' => 'Direct Income from Activation of Member '.$user_id,
                                // );
                            //  $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                $this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'] , $type = 'topup');
                                //$this->credit_coupans($user['user_id']);
                                $this->session->set_flashdata('message', 'Account upgraded Successfully');
                                redirect('Dashboard/upgradeAccount');
                            }else{
                                $this->session->set_flashdata('message', 'This Account Already upgraded to this price');
                            }
                        }else{
                            $this->session->set_flashdata('message', 'Insuffcient Balance');
                        }
                    }else{
                        $this->session->set_flashdata('message', 'Invalid User ID');
                    }
                }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package', array('price >' => $response['user']['package_amount']), '*');
            $this->load->view('upgradeAccount', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    private function credit_coupans($user_id){
        for($i = 1 ; $i <= 14 ; $i++){
            $coupanArr = [
                'user_id' => $user_id,
                'coupan_code' => $this->generate_coupan_code(),
                'amount' => 50,
            ];
            $this->User_model->add('tbl_coupans', $coupanArr);
        }
    }
    private function generate_coupan_code(){
        $coupan = rand(100000,999999);
        $coupan_code = $this->User_model->get_single_record('tbl_coupans',['coupan_code' => $coupan],'*');
        if(!empty($coupan_code)){
            return $this->generate_coupan_code();
        }else{
            return $coupan;
        }
    }
    function update_business($user_name = 'A915813', $downline_id = 'A915813', $level = 1, $business = '40' , $type = 'topup') {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
            if ($user['position'] == 'L') {
                $c = 'leftPower';
            } else if ($user['position'] == 'R') {
                $c = 'rightPower';
            } else {
                return;
            }
            $this->User_model->update_business($c, $user['upline_id'] , $business);
            $downlineArray = array(
                'user_id' => $user['upline_id'],
                'downline_id' => $downline_id,
                'position' => $user['position'],
                'business' => $business,
                'type' => $type,
                'created_at' => date('Y-m-d h:i:s'),
                'level' => $level,
            );
            $this->User_model->add('tbl_downline_business', $downlineArray);
            $user_name = $user['upline_id'];

            if ($user['upline_id'] != '') {
                $this->update_business($user_name, $downline_id, $level + 1, $business, $type);
            }
        }
    }

    function update_direct_business($user_name, $downline_id, $level = 1, $business , $type = 'topup') {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'sponser_id , position,user_id');
        if (!empty($user)) {
            $downlineArray = array(
                'user_id' => $user['sponser_id'],
                'downline_id' => $downline_id,
                'position' => $user['position'],
                'business' => $business,
                'type' => $type,
                'created_at' => date('Y-m-d h:i:s'),
                'level' => $level,
            );
            $this->User_model->add('tbl_direct_business', $downlineArray);
            $user_name = $user['sponser_id'];

            if ($user['sponser_id'] != '') {
                $this->update_direct_business($user_name, $downline_id, $level + 1, $business, $type);
            }
        }
    }

    public function pool_entry($user_id ,$pool_level = 1 , $pool_amount = 500){
        $main_pool_upline = $this->User_model->get_single_record('tbl_pool', array('level1 <' => 4 , 'pool_level' => $pool_level), 'id,user_id,pool_id,level1');
        if(!empty($main_pool_upline)){
            $pool_upline = $this->User_model->find_pool_upline('tbl_pool',['user_id' => $main_pool_upline['user_id']],'*');
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => $pool_upline['pool_id'],
                'pool_level' => $pool_level,
                'pool_amount' => $pool_amount,
                'pool_id' => $this->generate_pool_id()
            );
            $this->User_model->add('tbl_pool', $poolArr);
            // $this->User_model->update('tbl_pool', array('id' => $pool_upline['id']),array('level1' => $pool_upline['level1'] + 1));
            $this->update_pool_count($pool_upline['pool_id'],1,1);
            // $this->check_pool_stats();
        }else{
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => '',
                'pool_level' => $pool_level,
                'pool_amount' => $pool_amount,
                'pool_id' => $this->generate_pool_id()
            );
            $this->User_model->add('tbl_pool', $poolArr);
        }
    }
    public function update_pool_count($upline_id, $pool, $level) {
        $levelIncomes = [
            1 => ['sponser_income' => 0.30 , 'income' => 1],
            2 => ['sponser_income' => 0.30 , 'income' => 1.5],
            3 => ['sponser_income' => 0.40 , 'income' => 2],
            4 => ['sponser_income' => 0.50 , 'income' => 2.5],
            5 => ['sponser_income' => 0.50 , 'income' => 3],
         ];
        if ($level <= 5) {
            $upline = $this->User_model->get_single_record('tbl_pool', array('pool_id' => $upline_id), 'id,user_id,pool_id,upline_id,level1,level2,level3,level4,level5');
            if (!empty($upline)) {
                $this->User_model->update('tbl_pool', array('id' => $upline['id']), array('level' . $level => $upline['level' . $level] + 1));
                $RankIncome = array(
                    'user_id' => $upline['user_id'],
                    'amount' => $levelIncomes[$level]['income'],
                    'type' => 'pool_income',
                    'description' => 'Pool Bonus From level '.$level,
                );
              //  $this->User_model->add('tbl_income_wallet', $RankIncome);
                $this->sponser_rank_bonus($upline['user_id'] ,$level , $levelIncomes[$level]['sponser_income']);

                $this->update_pool_count($upline['upline_id'], $pool, $level + 1);
            }
        }
    }
    public function generate_pool_id(){
        $pool_id = rand(10000, 99999);
        $pool = $this->User_model->get_single_record('tbl_pool',['pool_id' => $pool_id] ,'*');
        if(!empty($pool)){
            return $this->generate_pool_id();
        }else{
            return $pool_id;
        }
    }
    public function check_pool_stats(){
        $achievers = $this->User_model->get_records('tbl_pool', array('level1income' => 0 , 'level1' => 4), '*');
        foreach($achievers as $key => $achiever){
            $RankIncome = array(
                'user_id' => $achiever['user_id'],
                'amount' => 4,
                'type' => 'pool_income',
                'description' => 'Pool Bonus From level 1',
            );
            $this->User_model->add('tbl_income_wallet', $RankIncome);
            $this->sponser_rank_bonus($achiever['user_id'] , 1 , 1.2);
            $this->User_model->update('tbl_pool', array('id' => $achiever['id']),array('level1income' => 1));
        }
        $achievers2 = $this->User_model->get_records('tbl_pool', array('level2income' => 0 , 'level2' => 16), '*');
        foreach($achievers2 as $key => $achiever){
            $RankIncome = array(
                'user_id' => $achiever['user_id'],
                'amount' => 24,
                'type' => 'pool_income',
                'description' => 'Pool Bonus From level 2',
            );
            $this->User_model->add('tbl_income_wallet', $RankIncome);
            $this->sponser_rank_bonus($achiever['user_id'] , 2 , 4.80);
            $this->User_model->update('tbl_pool', array('id' => $achiever['id']),array('level2income' => 1));
        }
        $achievers3 = $this->User_model->get_records('tbl_pool', array('level3income' => 0 , 'level3' => 64), '*');
        foreach($achievers3 as $key => $achiever){
            $RankIncome = array(
                'user_id' => $achiever['user_id'],
                'amount' => 128,
                'type' => 'pool_income',
                'description' => 'Pool Bonus From level 3',
            );
            $this->User_model->add('tbl_income_wallet', $RankIncome);
            $this->sponser_rank_bonus($achiever['user_id'] , 3 , 25.60);
            $this->User_model->update('tbl_pool', array('id' => $achiever['id']),array('level3income' => 1));
        }
    }
    private function sponser_rank_bonus($user_id , $level , $amount){
        $user = $this->User_model->get_single_record('tbl_users',['user_id' => $user_id],'id,user_id,sponser_id');
        if(!empty($user)){
            $RankIncome = array(
                'user_id' => $user['sponser_id'],
                'amount' => $amount,
                'type' => 'rank_bonus',
                'description' => 'Rank Bonus from UserID '.$user_id . ' At level '.$level,
            );
            $this->User_model->add('tbl_income_wallet', $RankIncome);
        }
    }
    public function getUserIdForRegister($country_code = '') {
        $sponser = $this->User_model->get_single_record('tbl_users', array(), 'ifnull(max(id_number),0) + 1 as next_id');
        if ($sponser['next_id'] == 1) {
            $user_id = '10001';
        } else {
            $user_id = $sponser['next_id'];
        }
        return $user_id;
    }
    public function generateUserId(){
        $user_id = rand(10000,99999);
    }
    public function magic_income_use(){
        $magic_users = $this->User_model->magic_users();
        pr($magic_users);
        foreach($magic_users as $user){
            $this->register_magic_user($user['user_id']);
        }
    }
    public function register_magic_user($user_id){
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
        $id_number = $this->getUserIdForRegister();
        $userData['user_id'] = 'WIN'.$id_number;
        $userData['id_number'] = $id_number;
        $userData['sponser_id'] = $user['sponser_id'];
        $userData['name'] = $user['name'];
        $userData['phone'] = $user['phone'];
        $userData['password'] = $user['password'];
        $userData['user_type'] = 'magic';
        $this->User_model->add('tbl_users', $userData);
        $this->User_model->add('tbl_bank_details',array('user_id' => $userData['user_id']));
        $this->repurchase_income($user_id,-3600,'magic_user_registration' ,'New Magic User Registered with ID '.$userData['user_id']);
        $this->topup_magic_user($userData['user_id']);
    }
    public function topup_magic_user($user_id){
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
        $package = $this->User_model->get_single_record('tbl_package', array('id' => 1), '*');
        $this->User_model->update('tbl_users', array('user_id' => $user_id),array('paid_status' => 1,'package_id' => $package['id'] , 'package_amount' => $package['price'],'topup_date' => date('Y-m-d h:i:s')));
        $this->User_model->update_directs($user['sponser_id']);
        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs');
        $DirectIncome = array(
            'user_id' => $user['sponser_id'],
            'amount' => $package['direct_income'] * 80 /100 ,
            'type' => 'direct_income',
            'description' => 'Direct Income from Activation of Member '.$user_id,
        );
      //  $this->User_model->add('tbl_income_wallet', $DirectIncome);
        $this->repurchase_income($user['sponser_id'],($package['direct_income'] * 20 / 100),'direct_income' ,'Direct Income from Activation of Member '.$user_id);
        $this->level_income($sponser['sponser_id'] , $user['user_id'],$package['level_income']);
        $this->pool_entry($user['user_id'],1 , 500);
        if($package['price'] == 3600)
            $this->rank_bonus($user['user_id'], 200,$user['user_id'],0 , $package['price']);
        else
            $this->rank_bonus($user['user_id'], 105,$user['user_id'],0 , $package['price']);
        //$this->rank_bonus($user['user_id'], 200,$user['user_id'],0 , $package['price']);
    }
    public function differance_income_distribution(){
        $rank_incomes = array(
            5 => 50,
            10 => 75,
            15 => 100,
            20 => 125,
            25 => 150,
            50 => 175,
            100 => 200,
        );

    }
    public function rank_bonus($user_id = 'AMAZING6388', $amount ='200', $sender_id  = 'AMAZING5177', $total_distribution = 0 , $package_amount = 3600 ,$last_rank = 0){
        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id,sponser_id,paid_status,package_id,directs');
        if($amount > 0){
            if(!empty($sponser)){
                $sponser['last_distribution'] = $total_distribution;
                if($package_amount == 3600){
                    if($sponser['directs'] >= 100){
                        $income = 200;
                        $winner_rank = 7;
                    }elseif($sponser['directs'] >= 50){
                        $income = 175;
                        $winner_rank = 6;
                    }elseif($sponser['directs'] >= 25){
                        $income = 150;
                        $winner_rank = 5;
                    }elseif($sponser['directs'] >= 20){
                        $income = 125;
                        $winner_rank = 4;
                    }elseif($sponser['directs'] >= 15){
                        $income = 100;
                        $winner_rank = 3;
                    }elseif($sponser['directs'] >= 10){
                        $income = 75;
                        $winner_rank = 2;
                    }elseif($sponser['directs'] >= 5){
                        $income = 50;
                        $winner_rank = 1;
                    }elseif($sponser['directs'] >= 0){
                        $winner_rank = 0;
                        $income = 0;
                    }
                }else{
                    if($sponser['directs'] >= 100){
                        $income = 105;
                        $winner_rank = 7;
                    }elseif($sponser['directs'] >= 50){
                        $income = 90;
                        $winner_rank = 6;
                    }elseif($sponser['directs'] >= 25){
                        $income = 75;
                        $winner_rank = 5;
                    }elseif($sponser['directs'] >= 20){
                        $income = 60;
                        $winner_rank = 4;
                    }elseif($sponser['directs'] >= 15){
                        $income = 45;
                        $winner_rank = 3;
                    }elseif($sponser['directs'] >= 10){
                        $income = 30;
                        $winner_rank = 2;
                    }elseif($sponser['directs'] >= 5){
                        $income = 15;
                        $winner_rank = 1;
                    }elseif($sponser['directs'] >= 0){
                        $income = 0;
                        $winner_rank = 0;
                    }
                }
                $main_income = $income - $total_distribution;
                $total_distribution = $total_distribution + $main_income;
                if($main_income > $amount){
                    $main_income = $amount;
                }
                $amount = $amount - $main_income;
                $user_rank = calculate_rank($sponser['directs']);
                $RankIncome = array(
                        'user_id' => $sponser['user_id'],
                        'amount' => $main_income * 80 / 100 ,
                        'type' => 'rank_bonus',
                        'description' => 'Rank Bonus From '.$sender_id . ' At '.$user_rank ,
                    );
                    // $RankIncome['total_distribution'] = $total_distribution;
                    // $RankIncome['income'] = $main_income;
                if($main_income > 0){
                    if($winner_rank > $last_rank){
                        $this->User_model->add('tbl_income_wallet', $RankIncome);
                        $this->repurchase_income($sponser['user_id'],($main_income * 20 / 100),'rank_bonus' ,'Rank Bonus From '.$sender_id);
                        $last_rank = $winner_rank;
                    }
                }

                $this->rank_bonus($sponser['sponser_id'], $amount,$sender_id , $total_distribution , $package_amount,$last_rank);
            }
        }
    }
    // public function rank_bonus($user_id = 'WIN10024', $amount ='200', $sender_id  = 'WIN10024', $last_distribution = 0){
    //     $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id,sponser_id,paid_status,package_id,directs');
    //     if(!empty($sponser)){
    //         $sponser['rank'] = calculate_rank($sponser['directs']);
    //         $bonus_amount = calculate_rank_bonus($sponser['directs'],$sponser['package_id']);
    //         if($bonus_amount > 0){
    //             // $bonus_amount = $bonus_amount - $last_distribution;
    //             // if($amount > $bonus_amount)
    //             //     $income = $bonus_amount;
    //             // else
    //             //     $income = $amount;
    //                 $income = $bonus_amount;

    //             if($income > 0){
    //                 $RankIncome = array(
    //                     'user_id' => $sponser['user_id'],
    //                     'amount' => $income * 100 / 100 ,
    //                     'type' => 'rank_bonus',
    //                     'description' => 'Rank Bonus From '.$sender_id,
    //                 );
    //                 $sponser['income'] = $income;
    //                 $sponser['last_distribution'] = $last_distribution;
    //                 $sponser['status'] = '--------------------------';
    //                 // $this->User_model->add('tbl_income_wallet', $RankIncome);
    //                 $this->repurchase_income($sponser['user_id'],($income * 20 / 100),'rank_bonus' ,'Rank Bonus From '.$sender_id);
    //             }
    //             pr($sponser);
    //             $last_distribution =  $last_distribution - $income;
    //             if($amount > 0){
    //                 $this->rank_bonus($sponser['sponser_id'] , $amount , $sender_id , abs($last_distribution));
    //                 echo'case1';
    //             }
    //         }else{
    //             $this->rank_bonus($sponser['sponser_id'] , $amount , $sender_id, $last_distribution);
    //             echo'case2';
    //         }


    //     }
    // }
    public function repurchase_income($user_id,$amount,$type ,$description){
        $RepurchaseIncome = array(
            'user_id' => $user_id,
            'amount' => $amount ,
            'type' => $type,
            'description' => $description,
        );
        $this->User_model->add('tbl_repurchase_income', $RepurchaseIncome);
    }
    public function DirectIncomeWithdraw() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    // $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    // $winto_user_id = $this->input->post('user_id');
                    $master_key = $this->input->post('master_key');
                    $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(sum(amount),0) as balance');
                    if($withdraw_amount >= 500){
                        if($withdraw_amount % 100 == 0){
                            if($balance['balance'] >= $withdraw_amount){
                                if($user['master_key'] == $master_key){
                                    if($kyc_status['kyc_status'] == 2){
                                        $DirectIncome = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => - $withdraw_amount ,
                                            'type' => 'direct_income_withdraw',
                                            'description' => 'Direct income Withdraw ',
                                        );
                                        $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                        if($data['pin_transfer'] == 0)
                                        {
                                            $withdrawArr = array(
                                                'user_id' => $this->session->userdata['user_id'],
                                                'amount' => $withdraw_amount,
                                                'type' => 'direct_income',
                                                'tds' => $withdraw_amount * 5 /100,
                                                'admin_charges' => $withdraw_amount * 10 /100,
                                                'fund_conversion' => 0,
                                                'payable_amount' => $withdraw_amount - ($withdraw_amount * 15 /100)
                                            );
                                            $this->User_model->add('tbl_withdraw', $withdrawArr);
                                        }else{
                                            // $fund_converstion = $withdraw_amount * 45 /100;
                                            // $withdrawArr['user_id'] = $this->session->userdata['user_id'];
                                            // $withdrawArr['type'] = 'direct_income' ;
                                            // $withdrawArr['amount'] = $withdraw_amount;
                                            // $withdrawArr['admin_charges'] = $withdraw_amount * 10 /100;
                                            // $withdrawArr['fund_conversion'] = $withdraw_amount * 45 /100;
                                            // $withdrawArr['tds'] = $withdrawArr['fund_conversion'] * 5 /100;
                                            // $withdrawArr['payable_amount'] = $withdrawArr['fund_conversion'] - $withdrawArr['tds'];
                                            // $this->User_model->add('tbl_withdraw', $withdrawArr);
                                            $walletArr = array(
                                                'user_id' => $this->session->userdata['user_id'],
                                                'amount' => $withdraw_amount * 85 / 100,
                                                'type' => 'direct_income_withdraw',
                                                'remark' => 'fund generated from direct income withdraw',
                                                'sender_id' => $this->session->userdata['user_id'],
                                            );
                                            $this->User_model->add('tbl_wallet', $walletArr);
                                        }
                                        $this->session->set_flashdata('message', 'Withdraw Requested     Successfully');
                                    }else{
                                        $this->session->set_flashdata('message', 'Please Complete your Kyc before withdrawal amount');
                                    }
                                }else{
                                    $this->session->set_flashdata('message', 'Invalid Master Key');
                                }
                            }else{
                                $this->session->set_flashdata('message', 'Insuffcient Balance');
                            }
                        }else{
                            $this->session->set_flashdata('message', 'Withdraw Amount is multiple of 100');
                        }

                    }else{
                        $this->session->set_flashdata('message', 'Minimum Withdrawal Amount is Rs 500');
                    }

                }else{
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('direct_income_withdraw', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function app_fund_transfer($me_id , $amount , $sender_id){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://winto.in/MobileApp/Money_transfer/receiveMoneyFromSite",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => array('me_id' => $me_id ,'amount' => $amount,'sender_id' => $sender_id),
            CURLOPT_HTTPHEADER => array(),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    public function get_app_user($user_id){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://winto.in/MobileApp/Money_transfer/validate_user",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('user_id' => $user_id),
            CURLOPT_HTTPHEADER => array(),
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    public function TaskIncomeWithdraw() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    // $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    // $winto_user_id = $this->input->post('user_id');
                    $master_key = $this->input->post('master_key');
                    $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "'.$this->session->userdata['user_id'].'" and (type = "task_income" or  type = "task_income_withdraw" or type = "task_level_income")', 'ifnull(sum(amount),0) as balance');
                    if($withdraw_amount >= 200){
                        if($balance['balance'] >= $withdraw_amount){
                            if($user['master_key'] == $master_key){
                                $DirectIncome = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => - $withdraw_amount ,
                                    'type' => 'task_income_withdraw',
                                    'description' => 'Task income Withdraw ',
                                );
                                $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                if($data['pin_transfer'] == 0)
                                {
                                    $withdrawArr = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => $withdraw_amount,
                                        'type' => 'task_income',
                                        'tds' => $withdraw_amount * 5 /100,
                                        'admin_charges' => $withdraw_amount * 10 /100,
                                        'fund_conversion' => 0,
                                        'payable_amount' => $withdraw_amount - ($withdraw_amount * 15 /100)
                                    );
                                    $this->User_model->add('tbl_withdraw', $withdrawArr);
                                }else{
                                    $fund_converstion = $withdraw_amount * 45 /100;
                                    $withdrawArr['user_id'] = $this->session->userdata['user_id'];
                                    $withdrawArr['type'] = 'task_income' ;
                                    $withdrawArr['amount'] = $withdraw_amount;
                                    $withdrawArr['admin_charges'] = $withdraw_amount * 10 /100;
                                    $withdrawArr['fund_conversion'] = $withdraw_amount * 45 /100;
                                    $withdrawArr['tds'] = $withdrawArr['fund_conversion'] * 5 /100;


                                    $withdrawArr['payable_amount'] = $withdrawArr['fund_conversion'] - $withdrawArr['tds'];

                                    $this->User_model->add('tbl_withdraw', $withdrawArr);
                                    $walletArr = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => $withdraw_amount * 45 / 100,
                                        'type' => 'task_income_withdraw',
                                        'remark' => 'fund generated from direct income withdraw',
                                        'sender_id' => $this->session->userdata['user_id'],
                                    );
                                    $this->User_model->add('tbl_wallet', $walletArr);
                                }
                                $this->session->set_flashdata('message', 'Withdraw Requested     Successfully');
                                // $app_response = $this->app_fund_transfer($winto_user_id , ($withdraw_amount * 90 / 100) , $user['user_id']);
                                // $app_response = json_decode($app_response,true);
                                // if($app_response['success'] == 1){
                                //     $DirectIncome = array(
                                //         'user_id' => $this->session->userdata['user_id'],
                                //         'amount' => - $withdraw_amount ,
                                //         'type' => 'direct_income_withdraw',
                                //         'description' => 'Amount WIthdraw in Winto Account for User'.$winto_user_id,
                                //     );
                                //     $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                //     $this->session->set_flashdata('message', 'Amount Withdrawal Successfully');
                                // }else{
                                //     $this->session->set_flashdata('message', $app_response['message']);
                                // }
                            }else{
                                $this->session->set_flashdata('message', 'Invalid Master Key');
                            }
                        }else{
                            $this->session->set_flashdata('message', 'Insuffcient Balance');
                        }
                    }else{
                        $this->session->set_flashdata('message', 'Minimum Withdrawal Amount is Rs 200');
                    }

                }else{
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "'.$this->session->userdata['user_id'].'" and (type = "task_income" or type = "task_income_withdraw" or type = "task_level_income")', 'ifnull(sum(amount),0) as balance');
            $this->load->view('task_income_withdraw', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    function level_income($sponser_id , $activated_id,$package_income){
        $incomes = explode(',',$package_income);
        // $incomes = array(70,35,30,25,20,15,10,5,5);
        foreach($incomes as $key => $income){
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status');
            if(!empty($sponser)){
                if($sponser['paid_status'] == 1){
                    $LevelIncome = array(
                        'user_id' => $sponser['user_id'],
                        'amount' => $income * 80 /100 ,
                        'type' => 'direct_level_income',
                        'description' => 'Level Income from Activation of Member '.$activated_id  . ' At level '.($key + 2),
                    );
                    $this->repurchase_income($sponser['user_id'],($income * 20 / 100),'direct_level_income' ,'Level Income from Activation of Member '.$activated_id  . ' At level '.($key + 2));
                    $this->User_model->add('tbl_income_wallet', $LevelIncome);
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }
    public function CookieBasedTracking() {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->count_cookies($this->session->userdata['user_id']);
            $this->load->view('cookie_based_tracking', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function withdraw_history() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Withdraw Summary';
            $response['transactions'] = $this->User_model->get_records('tbl_withdraw', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('transaction_history', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function tds_charges() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'TDS Charges';
            $response['transactions'] = $this->User_model->get_records('tbl_withdraw', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('tds_charges', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function forgot_password() {
        $response = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $user = $this->User_model->get_single_record('tbl_users', ' user_id = "'.$data['user_id'].'" or email = "'.$data['user_id'].'"', 'name,user_id,email,password,master_key');
            if (!empty($user)) {
                $message = "Dear " . $user['name'] . ' Your User ID '.$user['user_id'].'  password for Your Account is ' . $user['password'] .' Transaction Password '.$user['master_key'];
                $response['message'] = 'One Time Password Sent on Your Register Mobile Number, Please check';
                notify_user($data['user_id'] , $message);
                $this->send_email($user['email'], 'Security Alert', $message);
                $this->session->set_flashdata('message', 'Password Sent On Your Register Mobile Number');
            } else {
                $this->session->set_flashdata('message', 'Invalid User ID');
            }
        }
        $this->load->view('forgot_password', $response);
    }

    public function send_email($email = '349kuldeep@gmail.com', $subject = "Security Alert", $message = 'hello i am here') {
        date_default_timezone_set('Asia/Singapore');
        $this->load->library('email');
        $this->email->from('info@dway.com', 'DwaySwotfish');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->send();
    }

}
