<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Management extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','pagination'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index() {
        if (is_admin()) {
            $response = array();
            $response['total_users'] = $this->Main_model->get_sum('tbl_users', array(), 'ifnull(count(id),0) as sum');
            $response['paid_users'] = $this->Main_model->get_sum('tbl_users', array('paid_status' => '1'), 'ifnull(count(id),0) as sum');
            $response['today_joined_users'] = $this->Main_model->get_sum('tbl_users', 'date(created_at) = date(now())', 'ifnull(count(id),0) as sum');
            $response['todayPaidUsers'] = $this->Main_model->get_sum('tbl_users', 'date(created_at) = date(now()) and paid_status > 0', 'ifnull(count(id),0) as sum');
            $response['total_payout'] = $this->Main_model->get_sum('tbl_income_wallet', array('amount > ' => 0), 'ifnull(sum(amount),0) as sum');
            
            //---------incomes start------
            $response['direct_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'direct_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['matching_bonus'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'matching_bonus'), 'ifnull(sum(amount),0) as sum , type');

            $response['direct_level_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'direct_level_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['silver_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'silver_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['gold_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'gold_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['platinum_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'platinum_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['upline_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'upline_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['club_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'club_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['repurchase_level_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'repurchase_level_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['car_fund'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'car_fund'), 'ifnull(sum(amount),0) as sum , type');
            $response['house_fund'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'house_fund'), 'ifnull(sum(amount),0) as sum , type');
            $response['travel_fund'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'travel_fund'), 'ifnull(sum(amount),0) as sum , type');
            $response['life_time_royalty'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'life_time_royalty'), 'ifnull(sum(amount),0) as sum , type');
            

            //---------incomes end---------
            $response['pool_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'pool_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['rank_bonus'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'rank_bonus'), 'ifnull(sum(amount),0) as sum , type');
            $response['self_promotional_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'self_promotional_income'), 'ifnull(sum(amount),0) as sum , type');
            $response['direct_income_withdraw_request'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'direct_income_withdraw_request'), 'ifnull(sum(amount),0) as sum , type');
            $response['task_income_withdraw_request'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => 'task_income_withdraw_request'), 'ifnull(sum(amount),0) as sum , type');
            $response['total_sent_fund'] = $this->Main_model->get_sum('tbl_wallet', array(), 'ifnull(sum(amount),0) as sum');
            $response['used_fund'] = $this->Main_model->get_sum('tbl_wallet', array('amount <' => '0'), 'ifnull(sum(amount),0) as sum ');
            $response['requested_fund'] = $this->Main_model->get_sum('tbl_payment_request', array(), 'ifnull(sum(amount),0) as sum');
            $response['totalEmail'] = $this->Main_model->get_sum('tbl_support_message', array(), 'ifnull(count(id),0) as sum');
            $response['readEmail'] = $this->Main_model->get_sum('tbl_support_message', array(), 'ifnull(count(id),0) as sum');
            $response['unreadEmail'] = $this->Main_model->get_sum('tbl_support_message', array(), 'ifnull(count(id),0) as sum');
            $response['todayDirectIncome'] = $this->Main_model->get_sum('tbl_income_wallet', 'date(created_at) = date(now()) and type = "direct_income"', 'ifnull(sum(amount),0) as sum');
            $response['todayDirectLevelIncome'] = $this->Main_model->get_sum('tbl_income_wallet', 'date(created_at) = date(now()) and type = "direct_level_income"', 'ifnull(sum(amount),0) as sum');
            $response['todayPromotionalIncome'] = $this->Main_model->get_sum('tbl_income_wallet', 'date(created_at) = date(now()) and type = "self_promotional_income"', 'ifnull(sum(amount),0) as sum');
            $response['todayPoolIncome'] = $this->Main_model->get_sum('tbl_income_wallet', 'date(created_at) = date(now()) and type = "pool_income"', 'ifnull(sum(amount),0) as sum');
            $this->load->view('dashboard', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function CommingSoon($header = ''){
        $response['header'] = ucwords(str_replace('_',' ',$header));
        $this->load->view('coming_soon',$response);
    }
    public function sample(){
        $this->load->view('sample');
    }
    public function get_user($user_id) {
        if (is_admin()) {
            $response = array();
            $response['success'] = 0;
            $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            if(!empty($user)){
                $response['success'] = 1;
                $response['message'] = 'user Found';
                $response['user'] = $user;
                echo $user['name'];
            }else{
                echo 'User Not Found';
            }
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function users() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $startDate = $this->input->get('startDate');
            $endDate = $this->input->get('endDate');
            $where = array($field => $value);
            if (empty($where[$field])){
                $where = array();
                if(!empty($startDate) && !empty($endDate)){
                    $where['date(created_at) >='] = $startDate;
                    $where['date(created_at) <='] = $endDate;
                }
            }else{
                if(!empty($startDate) && !empty($endDate)){
                    $where['date(created_at) >='] = $startDate;
                    $where['date(created_at) <='] = $endDate;
                }
            }
            //pr($where,true);
            $config['total_rows'] = $this->Main_model->get_sum('tbl_users', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/users';
            $config ['uri_segment'] = 4;
            $config['per_page'] = 50;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['users'] = $this->Main_model->get_limit_records('tbl_users', $where, 'id,user_id,name,last_name,phone,password,master_key,email,sponser_id,directs,package_id,package_amount,paid_status,created_at,disabled,position,role', $config['per_page'], $segment);
            foreach($response['users'] as $key => $user){
                $response['users'][$key]['e_wallet'] = $this->Main_model->get_single_record('tbl_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as e_wallet');
                $response['users'][$key]['income_wallet'] = $this->Main_model->get_single_record('tbl_income_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as income_wallet');
            }


            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['startDate'] = $startDate;
            $response['endDate'] = $endDate;
            $response['total_records'] = $config['total_rows'];
            $response['path'] = 'users';
            $this->load->view('users', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function royaltyUsers() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field])){
                $where = array();
                $where['leftPower >='] = '5';
                $where['rightPower >='] = '5';
            }else{
                $where['leftPower >='] = '5';
                $where['rightPower >='] = '5';
            }
            //pr($where,true);
            $config['total_rows'] = $this->Main_model->get_sum('tbl_users', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/royaltyUsers';
            $config ['uri_segment'] = 4;
            $config['per_page'] = 50;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['users'] = $this->Main_model->get_limit_records('tbl_users', $where, 'id,user_id,name,last_name,phone,password,master_key,email,sponser_id,directs,package_id,package_amount,paid_status,created_at,disabled,position,leftPower,rightPower', $config['per_page'], $segment);
            foreach($response['users'] as $key => $user){
                $response['users'][$key]['e_wallet'] = $this->Main_model->get_single_record('tbl_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as e_wallet');
                $response['users'][$key]['income_wallet'] = $this->Main_model->get_single_record('tbl_income_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as income_wallet');
            }


            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $response['path'] = 'royaltyUsers';
            $this->load->view('royaltyAchiever', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function pool_chart() {
        if (is_admin()) {
            $response['users'] = $this->Main_model->get_records('tbl_pool', array(), '*');
            foreach($response['users'] as $key => $user){
                $response['users'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), 'name');
            }
            $this->load->view('pool_chart', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function today_joinings() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $startDate = $this->input->get('startDate');
            $endDate = $this->input->get('endDate');
            $where = array($field => $value);
            if (empty($where[$field])){
                $where = array();

                $where['date(created_at)'] = date('Y-m-d');
                if(!empty($startDate) && !empty($endDate)){
                    $where['date(created_at) >='] = $startDate;
                    $where['date(created_at) <='] = $endDate;
                }
            }else{
                $where['date(created_at)'] = date('Y-m-d');
                if(!empty($startDate) && !empty($endDate)){
                    $where['date(created_at) >='] = $startDate;
                    $where['date(created_at) <='] = $endDate;
                }
            }
            //pr($where,true);

            $config['total_rows'] = $this->Main_model->get_sum('tbl_users', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/users';
            $config ['uri_segment'] = 4;
            $config['per_page'] = 50;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['users'] = $this->Main_model->get_limit_records('tbl_users', $where, 'id,user_id,name,last_name,phone,password,master_key,email,sponser_id,directs,package_id,package_amount,paid_status,created_at,disabled,position', $config['per_page'], $segment);
            foreach($response['users'] as $key => $user){
                $response['users'][$key]['e_wallet'] = $this->Main_model->get_single_record('tbl_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as e_wallet');
                $response['users'][$key]['income_wallet'] = $this->Main_model->get_single_record('tbl_income_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as income_wallet');
            }


            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['startDate'] = $startDate;
            $response['endDate'] = $endDate;
            $response['total_records'] = $config['total_rows'];
            $response['path'] = 'today_joinings';
            $this->load->view('users', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function todayPaid() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            if (empty($where[$field])){
                $where = array();
                $where['date(created_at)'] = date('Y-m-d');
                $where['paid_status'] = 1;
            }else{
                $where['date(created_at)'] = date('Y-m-d');
                $where['paid_status'] = 1;
            }
            //pr($where,true);

            $config['total_rows'] = $this->Main_model->get_sum('tbl_users', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/todayPaid';
            $config ['uri_segment'] = 4;
            $config['per_page'] = 50;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['users'] = $this->Main_model->get_limit_records('tbl_users', $where, 'id,user_id,name,last_name,phone,password,master_key,email,sponser_id,directs,package_id,package_amount,paid_status,created_at,disabled,position', $config['per_page'], $segment);
            foreach($response['users'] as $key => $user){
                $response['users'][$key]['e_wallet'] = $this->Main_model->get_single_record('tbl_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as e_wallet');
                $response['users'][$key]['income_wallet'] = $this->Main_model->get_single_record('tbl_income_wallet', array('user_id' => $user['user_id']), 'ifnull(sum(amount),0) as income_wallet');
            }


            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $response['path'] = 'todayPaid';
            $this->load->view('users', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function clubUsers(){
        if (is_admin()) {
            $data['Business'] = $this->Main_model->get_records('tbl_direct_business',"week(created_at) = week(now()) and position = 'L' GROUP BY user_id",'ifnull(sum(business),0) as leftValue,user_id');
            foreach($data['Business'] as $key => $lb){
                $data['Business'][$key]['rightvalue'] = $this->Main_model->get_sum2('tbl_direct_business',"week(created_at) = week(now()) and position = 'R' and user_id = '".$lb['user_id']."'",'ifnull(sum(business),0) as sum');
            }
            $clubUser = array();
            foreach($data['Business'] as $key2 => $da){
                if($da['leftValue']>= 50 && $da['rightvalue']>= 50){
                    $clubUser[$key2] =  $da;
                }
            }
            $response['users'] = $this->Main_model->get_records('tbl_users',['leftPower >=' => '50' ,'rightPower >=' => '50'],'user_id,leftPower as leftValue,rightPower as rightvalue');
            $response['header'] = 'Club User';
            //$response['users'] = $clubUser;
            $this->load->view('royaltyAchiever',$response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function silverRoyaltyUsers(){
        if (is_admin()) {
            $data['Business'] = $this->Main_model->get_records('tbl_direct_business',"position = 'L' and level = '1' GROUP BY user_id",'ifnull(sum(business),0) as leftValue,user_id');
            foreach($data['Business'] as $key => $lb){
                $data['Business'][$key]['rightvalue'] = $this->Main_model->get_sum2('tbl_direct_business',"position = 'R' and level = '1' and user_id = '".$lb['user_id']."'",'ifnull(sum(business),0) as sum');
            }
            $silverRoyalty = array();
            foreach($data['Business'] as $key1 => $da){
                if($da['leftValue']>= 10 && $da['rightvalue']>= 10){
                    $silverRoyalty[$key1] =  $da;
                }
            }
            $response['header'] = 'Silver Royalty User';
            $response['users'] = $silverRoyalty;
            $this->load->view('royaltyAchiever',$response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function goldRoyaltyUsers(){
        if (is_admin()) {
            $data['Business'] = $this->Main_model->get_records('tbl_direct_business',"position = 'L' and level = '1' GROUP BY user_id",'ifnull(sum(business),0) as leftValue,user_id');
            foreach($data['Business'] as $key => $lb){
                $data['Business'][$key]['rightvalue'] = $this->Main_model->get_sum2('tbl_direct_business',"position = 'R' and level = '1' and user_id = '".$lb['user_id']."'",'ifnull(sum(business),0) as sum');
            }
            $goldRoyalty = array();
            foreach($data['Business'] as $key2 => $da){
                if($da['leftValue']>= 20 && $da['rightvalue']>= 20){
                    $goldRoyalty[$key2] =  $da;
                }
            }
            $response['header'] = 'Gold Royalty User';
            $response['users'] = $goldRoyalty;
            $this->load->view('royaltyAchiever',$response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function platinumRoyaltyUsers(){
        if (is_admin()) {
            $data['Business'] = $this->Main_model->get_records('tbl_direct_business',"position = 'L' and level = '1' GROUP BY user_id",'ifnull(sum(business),0) as leftValue,user_id');
            foreach($data['Business'] as $key => $lb){
                $data['Business'][$key]['rightvalue'] = $this->Main_model->get_sum2('tbl_direct_business',"position = 'R' and level = '1' and user_id = '".$lb['user_id']."'",'ifnull(sum(business),0) as sum');
            }
            $platinumRoyalty = array();
            foreach($data['Business'] as $key3 => $da){
                if($da['leftValue']>= 40 && $da['rightvalue']>= 40){
                    $platinumRoyalty[$key3] =  $da;
                }
            }
            $response['header'] = 'Platinum Royalty User';
            $response['users'] = $platinumRoyalty;
            $this->load->view('royaltyAchiever',$response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function lifeTimeRoyalty(){
        if (is_admin()) {
            $response['users'] = $this->Main_model->get_records('tbl_users',['leftPower >=' => '100','rightPower >=' => '100'],'user_id,leftPower as leftValue,rightPower as rightValue');
            $response['header'] = 'Lifetime Royalty User First';
            $this->load->view('royaltyAchiever',$response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function lifeTimeRoyalty2(){
        if (is_admin()) {
            $response['users'] = $this->Main_model->get_records('tbl_users',['leftPower >=' => '100','rightPower >=' => '100'],'user_id,leftPower as leftValue,rightPower as rightValue');
            $response['header'] = 'Lifetime Royalty User Second';
            $this->load->view('royaltyAchiever',$response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function user_login($user_id) {
        if (is_admin()) {
            $this->session->set_userdata('user_id', $user_id);
            redirect('Dashboard/User');
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function paidUsers() {
        if (is_admin()) {
            $response['users'] = $this->Main_model->get_records('tbl_users', array('paid_status' => 1), '*');
            $this->load->view('paid_users', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function UserInvoice() {
        if (is_admin()) {
            $response['users'] = $this->Main_model->get_records('tbl_users', array('paid_status' => 1), '*');
            $this->load->view('user_invoice', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function BlockedMembers() {
        if (is_admin()) {
            $response['users'] = $this->Main_model->get_records('tbl_users', array('disabled' => 1), '*');
            $this->load->view('paid_users', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Genelogy($user_id = 'admin') {
        if (is_admin()) {
            $response = array();
            $response['level1'] = $this->Main_model->get_tree_user($user_id);
            $response['level2'][1] = $this->Main_model->get_tree_user($response['level1']->left_node);
            $response['level2'][2] = $this->Main_model->get_tree_user($response['level1']->right_node);
            if (!empty($response['level2'][1]->left_node))
                $response['level3'][1] = $this->Main_model->get_tree_user($response['level2'][1]->left_node);
            else
                $response['level3'][1] = array();
            if (!empty($response['level2'][1]->right_node))
                $response['level3'][2] = $this->Main_model->get_tree_user($response['level2'][1]->right_node);
            else
                $response['level3'][2] = array();
            if (!empty($response['level2'][2]->left_node))
                $response['level3'][3] = $this->Main_model->get_tree_user($response['level2'][2]->left_node);
            else
                $response['level3'][3] = array();
            if (!empty($response['level2'][2]->right_node))
                $response['level3'][4] = $this->Main_model->get_tree_user($response['level2'][2]->right_node);
            else
                $response['level3'][4] = array();
            $this->load->view('genelogy', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Tree($user_id = 'adminadmin') {
        if (is_admin()) {
            $response = array();
            $response['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            $response['users'] = $this->Main_model->get_records('tbl_users', array('sponser_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            foreach($response['users'] as $key => $directs){
                $response['users'][$key]['sub_directs'] = $this->Main_model->get_records('tbl_users', array('user_id' => $directs['user_id']), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            }
            $this->load->view('tree', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function Pool($user_id = 'adminadmin' ,$pool_id) {
        if (is_admin()) {
            $response = array();
            // $response['user'] = $this->Main_model->get_single_record('tbl_pool', array('user_id' => $user_id , 'pool_level' => $pool_id), '*');
            $response['users'] = $this->Main_model->get_records('tbl_pool', array( 'pool_level' => $pool_id), '*');
            // foreach($response['users'] as $key => $directs){
            //     $response['users'][$key]['user_info'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $directs['user_id']), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            // }
            // $response['pool_id'] = $pool_id;
            // $this->load->view('pool', $response);
            $this->load->view('pool_view', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function RankUsers() {
        if (is_admin()) {
            $response = array();
            $response['users'] = $this->Main_model->get_records('tbl_user_positions', array('user_id != ' => 'admin'), '*');
            foreach ($response['users'] as $key => $users) {
                $response['users'][$key]['package'] = $this->Main_model->get_single_record('tbl_package', array('id' => $users['package']), '*');
            }
            $this->load->view('rank_users', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function login() {
        if (is_admin()) {
            redirect('Admin/Management');
        } else {
            $response['message'] = '';
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $user = $this->Main_model->get_single_record('tbl_admin', array('user_id' => $data['user_id'], 'password' => $data['password'], 'role' => 'A'), 'id,user_id,role,name,email');
                if (!empty($user)) {
                    $this->session->set_userdata('user_id', $user['user_id']);
                    $this->session->set_userdata('role', $user['role']);
                    redirect('Admin/Management/');
                } else {
                    $response['message'] = 'Invalid Credentials';
                }
            }
            $this->load->view('login', $response);
        }
    }

    public function logout() {
        $this->session->unset_userdata(array('user_id', 'role'));
        redirect('Admin/Management/login');
    }

    public function Fund_requests($status = '') {
        if (is_admin()) {
            if($status == ''){
                $where = array();
            }else{
                $where = array('status' => $status);
            }
            $response['requests'] = $this->Main_model->get_records('tbl_payment_request', $where, '*');
            $this->load->view('fund_requests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function fund_history() {
        if (is_admin()) {
            $response['requests'] = $this->Main_model->get_records('tbl_wallet', array(), '*');
            $this->load->view('fund_history', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function update_fund_request($id) {
        if (is_admin()) {
            $response['request'] = $this->Main_model->get_single_record('tbl_payment_request', array('id' => $id), '*');
            $response['user_info'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['request']['user_id']), 'id,user_id,first_name,last_name,email,phone,country,image,site_url');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['status'] == 'Reject') {
                    $updres = $this->Main_model->update('tbl_payment_request', array('id' => $id), array('status' => 2, 'remarks' => $data['remarks']));
                    if ($updres == true) {
                        $this->session->set_flashdata('error', 'Reqeust Rejected Successfully');
                    } else {
                        $this->session->set_flashdata('error', 'There is an error while Rejecting request Please try Again ..');
                    }
                } elseif ($data['status'] == 'Approve') {
                    if ($response['request']['status'] !== 1) {
                        $updres = $this->Main_model->update('tbl_payment_request', array('id' => $id), array('status' => 1, 'remarks' => $data['remarks']));
                        if ($updres == true) {
                            $this->session->set_flashdata('error', 'Reqeust Accepted And Fund released Successfully');
                            $walletData = array(
                                'user_id' => $response['request']['user_id'],
                                'amount' => $response['request']['amount'],
                                'sender_id' => 'admin',
                                'type' => 'admin_fund',
                                'remark' => $data['remarks'],
                            );
                            $this->Main_model->add('tbl_wallet', $walletData);
                        } else {
                            $this->session->set_flashdata('error', 'There is an error while Rejecting request Please try Again ..');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'This Payment Request Already Approved');
                    }
                }
            }
            $this->load->view('update_fund_request', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function SendWallet(){
        $response = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|numeric|xss_clean');
            if ($this->form_validation->run() != FALSE) {
                $user_id = $data['user_id'];
                $amount = $data['amount'];
                $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                if(!empty($user)){
                    $sendWallet = array(
                        'user_id' => $user_id,
                        'amount' => $amount,
                        'type' => 'admin_amount',
                        'sender_id' => 'admin',
                        'remark' => 'Fund Sent By Admin',
                    );
                    $this->Main_model->add('tbl_wallet', $sendWallet);
                    $this->session->set_flashdata('message', 'Fund Sent Successfully');
                }else{
                    $this->session->set_flashdata('message', 'Invalid User ID');
                }
            }
        }
        $this->load->view('send_wallet', $response);
    }
    public function UpdateRank($user_id) {
        if (is_admin()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $user = $this->Main_model->get_single_record('tbl_user_positions', array('user_id' => $user_id), '*');
                $user_package = $this->Main_model->get_single_record('tbl_package', array('id' => $user['package']), '*');
                $new_package = $this->Main_model->get_single_record('tbl_package', array('id' => $data['package']), '*');
                if ($user_package['bv'] == $new_package['bv']) {
                    $this->session->set_flashdata('messsage', 'This Account Have Already Same BV');
                } else {
                    $updres = $this->Main_model->update('tbl_user_positions', array('user_id' => $data['user_id']), array('package' => $new_package['id'], 'capping' => $new_package['capping']));
                    if ($updres == true) {
                        $new_bv = $new_package['bv'] - $user_package['bv'];
                        if ($new_bv > 0) {
                            $response['sponser'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'id,user_id,package_id,sponser_id,paid_status');
                            $response['sponser_package'] = $this->Main_model->get_single_record('tbl_package', array('id' => $response['sponser']['package_id']), '*');
                            $bonus = ($new_bv * $response['sponser_package']['commision'] / 100) * 1.3;
                            if ($response['sponser_package']['commision'] == '20') {
                                $roll_up_amount = $response['sponser_package']['bv'] * 1.3;
                                $this->rollup_personal_business($response['sponser']['sponser_id'], $roll_up_amount, $share = 8, $sender_id = $data['user_id'], 20);
                            } elseif ($response['sponser_package']['commision'] == '22') {
                                $roll_up_amount = $response['sponser_package']['bv'] * 1.3;
                                $this->rollup_personal_business($response['sponser']['sponser_id'], $roll_up_amount, $share = 6, $sender_id = $data['user_id'], 22);
                            } elseif ($response['sponser_package']['commision'] == '24') {
                                $roll_up_amount = $response['sponser_package']['bv'] * 1.3;
                                $this->rollup_personal_business($response['sponser']['sponser_id'], $roll_up_amount, $share = 4, $sender_id = $data['user_id'], 24);
                            }
                        }
                        $this->update_business($data['user_id'], 1, $new_bv);

                        $this->session->set_flashdata('messsage', 'Rank Updated Successfully');
                    }
                }
            }
            $response['user'] = $this->Main_model->get_single_record('tbl_user_positions', array('user_id' => $user_id), '*');
            $response['user_info'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
            $response['user_package'] = $this->Main_model->get_single_record('tbl_package', array('id' => $response['user']['package']), '*');
            $response['packages'] = $this->Main_model->get_records('tbl_package', array(), '*');
            $this->load->view('update_rank', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function rollup_personal_business($sponser_id = 'SG10006', $amount = '2070', $share = 4, $sender_id = 'SG10011', $last_distribution) {
        $sponser = $this->Main_model->get_user_package_commison($sponser_id);
        if (!empty($sponser)) {
//            pr($sponser);
            if ($sponser['commision'] == '28') {
                $this->credit_income($sponser_id, ($amount * $share / 100), 'roll_up_personal_network', 'Roll Up Personal Network Income from User ' . $sender_id);
            } elseif ($sponser['commision'] == '24') {
                if ($sponser['commision'] > $last_distribution) {
                    $this->credit_income($sponser['user_id'], ($amount * 4 / 100), 'roll_up_personal_network', 'Roll Up Personal Network Income from User ' . $sender_id);
                    if ($share > 4)
                        $this->rollup_personal_business($sponser['sponser_id'], $amount = '100', $share = $share - 4, $sender_id = 'sd', 24);
                }else {
                    $this->rollup_personal_business($sponser['sponser_id'], $amount, $share, $sender_id, $last_distribution);
                }
            } elseif ($sponser['commision'] == '22') {
                if ($sponser['commision'] > $last_distribution) {
                    $this->credit_income($sponser['user_id'], ($amount * 2 / 100), 'roll_up_personal_network', 'Roll Up Personal Network Income from User ' . $sender_id);
                    if ($share > 2)
                        $this->rollup_personal_business($sponser['sponser_id'], $amount = '100', $share = $share - 2, $sender_id = 'sd', 22);
                }else {
                    $this->rollup_personal_business($sponser['sponser_id'], $amount, $share, $sender_id, $last_distribution);
                }
            } elseif ($sponser['commision'] == '20') {
                $this->rollup_personal_business($sponser['sponser_id'], $amount, $share, $sender_id, $last_distribution);
            }
        }
    }

    public function credit_income($user_id, $amount, $type, $description) {
        $incomeArr = array(
            'user_id' => $user_id,
            'amount' => $amount,
            'type' => $type,
            'description' => $description,
        );
        $this->Main_model->add('tbl_income_wallet', $incomeArr);
    }

    function update_business($user_name = 'SG10004', $level = 1, $bv = 1380) {
        $user = $this->Main_model->get_single_record('tbl_user_positions', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (count($user)) {
//            pr($user);
            if ($user['position'] == 'L') {
                $c = 'left_bv';
            } else if ($user['position'] == 'R') {
                $c = 'right_bv';
            } else {
                return;
            }
            $this->Main_model->update_bv($c, $user['upline_id'], $bv);
            $user_name = $user['upline_id'];

            if ($user['upline_id'] != '') {
                $this->update_business($user_name, $level = 1, $bv);
            }
        }
    }

    function content_management($title = false) {
        if (is_admin()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $updres = $this->Main_model->update('tbl_content', array('title' => $title), array('content' => $data['content']));
                if ($updres == true) {
                    $this->session->set_flashdata('message', 'Content Updated Successfully');
                } else {
                    $this->session->set_flashdata('message', 'There is an error while Updating Content Please try Again ..');
                }
            }
            $response['content'] = $this->Main_model->get_single_record('tbl_content', array('title' => $title), '*');
            $this->load->view('content_management', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    function blockStatus($user_id , $status) {
        if (is_admin()) {
            $response['success'] = 0;
            $updres = $this->Main_model->update('tbl_users', array('user_id' => $user_id), array('disabled' => $status));
            if ($updres == true) {
                $response['success'] = 1;
                $response['message'] = 'Status Updated Successfully';
            } else {
                $response['message'] = 'Error While Updating Status';
            }
            echo json_encode($response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    function MakeFranchise($user_id) {
        if (is_admin()) {
            $response['success'] = 0;
            $updres = $this->Main_model->update('tbl_users', array('user_id' => $user_id), array('role' => 'F'));
            if ($updres == true) {
                $response['success'] = 1;
                $response['message'] = 'Franchise Account Created Successfully Successfully';
            } else {
                $response['message'] = 'Error While Making Franchise';
            }
            echo json_encode($response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    function MakeUser($user_id) {
        if (is_admin()) {
            $response['success'] = 0;
            $updres = $this->Main_model->update('tbl_users', array('user_id' => $user_id), array('role' => 'U'));
            if ($updres == true) {
                $response['success'] = 1;
                $response['message'] = 'Franchise Account Created Successfully Successfully';
            } else {
                $response['message'] = 'Error While Making Franchise';
            }
            echo json_encode($response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    function promo_code() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $this->form_validation->set_rules('promo_code', 'Promo Code', 'trim|required|xss_clean');
                $this->form_validation->set_rules('discount', 'Discount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('valid_upto', 'Valid Upto', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
//                    $real_date = '08/08/2019';

                    $data = $this->security->xss_clean($this->input->post());
                    $date = date_create($data['valid_upto']);
                    $valid_upto = date_format($date, "Y-m-d");
                    $promoArr = array(
                        'promo_code' => $data['promo_code'],
                        'discount' => $data['discount'],
                        'valid_upto' => $valid_upto
                    );
                    $res = $this->Main_model->add('tbl_promo_codes', $promoArr);
                    if ($res) {
                        $this->session->set_flashdata('message', 'Promo Code Created Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Creating New Promo Code Please Try Again ...');
                    }
                }
            }
            $response['promo_codes'] = $this->Main_model->get_records('tbl_promo_codes', array(), '*');
            $this->load->view('promo_code', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    function delete_promo_code($id) {
        if (is_admin()) {
            $response = array();
            $promo_code = $this->Main_model->get_single_record('tbl_promo_codes', array('id' => $id), '*');
            if (!empty($promo_code)) {
                $res = $this->Main_model->delete('tbl_promo_codes', $id);
                if ($res) {
                    $this->session->set_flashdata('message', 'Promo Code Deleted Successfully');
                } else {
                    $this->session->set_flashdata('message', 'Error While Deleting Promo Code Please Try Again ...');
                }
            } else {
                $this->session->set_flashdata('message', 'Error While Deleting Promo Code Please After some Time ...');
            }
            $response['promo_codes'] = $this->Main_model->get_records('tbl_promo_codes', array(), '*');
            $this->load->view('promo_code', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    function popup_upload(){
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $data = html_escape($data);
                if($data['type'] == 'image'){
                    if (!empty($_FILES['media']['name'])) {
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
                        $config['file_name'] = 'payment_slip';
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('media')) {
                            $this->session->set_flashdata('error', $this->upload->display_errors());
                        } else {
                            $fileData = array('upload_data' => $this->upload->data());
                            $fileData = array('upload_data' => $this->upload->data());
                            $userData['media'] = $fileData['upload_data']['file_name'];
                            $userData['type'] = 'image';
                            $userData['caption'] = $this->input->post('caption');
                            $updres = $this->Main_model->add('tbl_popup',$userData);
                            if ($updres == true) {
                                $this->session->set_flashdata('error', 'Popup Uploaded Successfully');
                            }else {
                                $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
                            }
                        }
                    }else{
                        $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
                    }
                }else{
                    $userData['media'] = $this->input->post('media');
                    $userData['type'] = 'video';
                    $userData['caption'] = $this->input->post('caption');
                    $updres = $this->Main_model->add('tbl_popup',$userData);
                    if ($updres == true) {
                        $this->session->set_flashdata('error', 'Popup Uploaded Successfully');
                    } else {
                        $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
                    }
                }
            }
            $response['popup'] = $this->Main_model->get_single_record('tbl_popup',[],'status');
            $response['header'] = 'Upload Popup Image'; 
            $this->load->view('popup.php',$response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    function dashboardPopup(){
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $data = html_escape($data);
                if($data['type'] == 'image'){
                    if (!empty($_FILES['media']['name'])) {
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
                        $config['file_name'] = 'popup'.time();
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('media')) {
                            $this->session->set_flashdata('error', $this->upload->display_errors());
                        } else {
                            $fileData = array('upload_data' => $this->upload->data());
                            $fileData = array('upload_data' => $this->upload->data());
                            $userData['media'] = $fileData['upload_data']['file_name'];
                            $userData['type'] = 'image';
                            $userData['caption'] = $this->input->post('caption');
                            $updres = $this->Main_model->add('tbl_user_popup',$userData);
                            if ($updres == true) {
                                $this->session->set_flashdata('error', 'Popup Uploaded Successfully');
                            } else {
                                $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
                            }
                        }
                    }else{
                        $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
                    }
                }
            }
            $response['popup'] = $this->Main_model->get_single_record('tbl_user_popup',[],'status');
            $response['users'] = 1;
            $response['header'] = 'Dashboard Popup Image'; 
            $this->load->view('popup.php',$response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function popupSettings(){
        if (is_admin()) {
            $check = $this->Main_model->get_single_record('tbl_popup',[],'status');
            if($check['status'] == 0){
                $status = 1;
            }else{
                $status = 0;
            }
            $this->Main_model->update('tbl_popup',[],['status' => $status]);
            redirect('Admin/Management/popup_upload');
        } else {
            redirect('Admin/Management/login');
        }
    }
    
    public function popupUSettings(){
        if (is_admin()) {
            $check = $this->Main_model->get_single_record('tbl_user_popup',[],'status');
            if($check['status'] == 0){
                $status = 1;
            }else{
                $status = 0;
            }
            $this->Main_model->update('tbl_user_popup',[],['status' => $status]);
            redirect('Admin/Management/dashboardPopup');
        } else {
            redirect('Admin/Management/login');
        }
    }
    

}
