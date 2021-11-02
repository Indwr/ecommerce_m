<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','pagination'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index() {
        if (is_logged_in()) {
            $response['task_links'] = $this->User_model->get_records('tbl_task_links', array(), '*');
            foreach($response['task_links'] as $key => $link){
                $response['task_links'][$key]['counter'] = $this->User_model->get_single_record('tbl_task_counter', "user_id = '".$this->session->userdata['user_id']."' and date(created_at) = date(NOW()) and task_id = '".$link['id']."'", '*');
            }
            $response['task'] = $this->User_model->get_single_record('tbl_task', "user_id = '".$this->session->userdata['user_id']."' and date(created_at) = date(NOW())", '*');
            $this->load->view('task', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function TaskPerform() {
        if (is_logged_in()) {
            $response['task'] = $this->User_model->get_single_record('tbl_task', "user_id = '".$this->session->userdata['user_id']."' and date(created_at) = date(NOW())", '*');
            $this->load->view('task_perform', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function TaskComplete($task_id){
        if (is_logged_in()) {
            $data['success'] = 0;
            $task = $this->User_model->get_single_record('tbl_task', "user_id = '".$this->session->userdata['user_id']."' and date(created_at) = date(NOW())", '*');
            if(!empty($task)){
                $today_task = $this->User_model->get_single_record('tbl_task_counter', "user_id = '".$this->session->userdata['user_id']."' and date(created_at) = date(NOW()) and task_id = '".$task_id."'", '*');

                if(empty($today_task)){
                    $TaskCounterIncome = array(
                        'user_id' => $this->session->userdata['user_id'],
                        'task_id' => $task_id,
                    );
                    $this->User_model->add('tbl_task_counter', $TaskCounterIncome);
                    $this->User_model->update('tbl_task', array('id' => $task['id']),array('tasks' => $task['tasks']+ 1));
                    $data['success'] = 1;
                    $data['message'] = 'Task Completed Successfully';
                }else{
                    $data['success'] = 0;
                    $data['message'] = "This Task Already Completed";
                }
            }else{
                $StartTask = array(
                    'user_id' => $this->session->userdata['user_id'],
                    'tasks' => 1,
                    'redeem' => 0,
                );
                $this->User_model->add('tbl_task', $StartTask);
                $data['message'] = 'Task Completed Successfully';
                $data['success'] = 1;
            }
            echo json_encode($data);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function RedeemMoney(){
        if (is_logged_in()) {
            $data['success'] = 0;
            $task = $this->User_model->get_single_record('tbl_task', "user_id = '".$this->session->userdata['user_id']."' and date(created_at) = date(NOW())", '*');
            if(!empty($task)){
                if($task['redeem'] == 0){
                    if($task['tasks'] >= 15){
                        $this->User_model->update('tbl_task', array('id' => $task['id']),array('redeem' => 1));
                        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                        $data['success'] = 1;
                        $data['message'] = 'Money Redeemed Successfully';
                        $TaskIncome = array(
                            'user_id' => $user['user_id'],
                            'amount' => 25 ,
                            'type' => 'task_income', 
                            'description' => 'Task Income',
                        );
                        $this->User_model->add('tbl_income_wallet', $TaskIncome);
                        $this->task_level_income($user['sponser_id'] , $user['user_id']);
                    }else{
                        $data['message'] = 'Still your tasks are Not Completed';
                    }
                }else{
                    $data['success'] = 0;
                    $data['message'] = "you have Already Redeem Your Money";
                }
            }else{
                $data['message'] = 'Your tasks Are Not Completed Today';
                $data['success'] = 0;
            }
            echo json_encode($data);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function task_level_income($sponser_id,$activated_id){
        $incomes = array(10,9,8,7,5,4,3,2,1,0.5,0.25,0.25,0.10,0.10,0.10);
        foreach($incomes as $key => $income){
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status');
            if(!empty($sponser)){
                if($sponser['paid_status'] == 1){
                    $LevelIncome = array(
                        'user_id' => $sponser['user_id'],
                        'amount' => $income ,
                        'type' => 'task_level_income', 
                        'description' => 'Task Income from Member '.$activated_id  . ' At level '.($key + 1),
                    );
                    $this->User_model->add('tbl_income_wallet', $LevelIncome);
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }

    public function userCoupan(){
        if (is_logged_in()) {
            $response['coupon'] = $this->User_model->get_records('tbl_coupans',['user_id' => $this->session->userdata['user_id']],'*');
            $this->load->view('userCoupon',$response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function payout_summary() {
        if (is_logged_in()) {
            $config['total_rows'] = $this->User_model->payout_dates_count(['user_id' => $this->session->userdata['user_id']]);
            $config['base_url'] = base_url('Dashboard/Task/payout_summary/');
            $config ['uri_segment'] = 4;
            $config['per_page'] = 10;
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
            $response['records'] = $this->User_model->datewise_payout($config['per_page'], $segment,['user_id' => $this->session->userdata['user_id'],'amount >' => 0]);
            foreach($response['records'] as $key => $record){
                $incomes  = $this->User_model->get_incomes('tbl_income_wallet', array('date(created_at)' => $record['date'],'amount > ' => 0,'user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as income , type');
                $response['records'][$key]['incomes'] = calculate_incomes($incomes);
            }
            $response['headerMenu'] = $this->User_model->getIncomeType();
            $response['segament'] = $segment;
            $response['total_records'] = $config['total_rows'];
            // pr($response,true);
            $this->load->view('payout_summary', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function payoutReport($date=" "){
        if (is_logged_in()) {
            $response['userinfo'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'name,user_id,address,city,state,postal_code,email,phone');
            $response['city'] = $this->User_model->get_single_record('cities', array('id' => $response['userinfo']['city']), 'name');
            $response['state'] = $this->User_model->get_single_record('states', array('id' => $response['userinfo']['state']), 'name');
            $response['date'] = $date;
            $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', array('date(created_at)' => $date,'user_id' => $this->session->userdata['user_id'],'amount >' => 0), 'ifnull(sum(amount),0) as total_income');
            $response['user_incomes'] = $this->User_model->get_records('tbl_income_wallet',"date(created_at) = '".$date."' and user_id = '".$this->session->userdata['user_id']."' and amount > '0' GROUP BY type", 'ifnull(sum(amount),0) as total,type');
            $response['bv'] = $this->User_model->get_single_record('tbl_point_matching_income', array('date(created_at)' => $date,'user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('payoutReport',$response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function date_payout($date = '') {
        if (is_logged_in()) {
            $response['header'] = 'Date Payout';
            $config['base_url'] = base_url() . 'Dashboard/Task/date_payout/' . $date;
            $config['total_rows'] = $this->User_model->get_sum('tbl_income_wallet', array('date(created_at)' => $date,'user_id' => $this->session->userdata['user_id'],'amount >' => 0), 'ifnull(count(id),0) as sum');
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
            $segment = $this->uri->segment(5);
            $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', array('date(created_at)' => $date,'user_id' => $this->session->userdata['user_id'],'amount >' => 0), 'ifnull(sum(amount),0) as total_income');
            //$response['total_income'] = $this->User_model->get_sum('tbl_income_wallet', array('date(created_at)' => $date,'user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as sum');
            $response['user_incomes'] = $this->User_model->get_limit_records('tbl_income_wallet', array('date(created_at)' => $date,'user_id' => $this->session->userdata['user_id'],'amount >' => 0), '*', $config['per_page'], $segment, true);
            $response['segament'] = $segment;
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
}
