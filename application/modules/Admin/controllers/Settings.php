<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','pagination'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index() {
        if (is_admin()) {
            $response['packages'] = $this->Main_model->get_records('tbl_package', array(), '*');
            $this->load->view('package_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function news() {
        if (is_admin()) {
            $response['news'] = $this->Main_model->get_records('tbl_news', array(), '*');
            $this->load->view('news', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function EditUser($user_id) {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if($data['form_type'] == 'personal'){
                    $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('phone', 'Phone', 'trim|numeric|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'phone' => $data['phone'],
                        );
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'User Details Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Updating Details Please Try Again ...');
                        }
                    }
                }elseif($data['form_type'] == 'password'){
                    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'password' => $data['password']
                        );
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Password Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Password Please Try Again ...');
                        }
                    }
                }elseif($data['form_type'] == 'master_key'){
                    $this->form_validation->set_rules('master_key', 'Transaction Password', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'master_key' => $data['master_key']
                        );
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Transaction Password Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Transaction Password Please Try Again ...');
                        }
                    }
                }else{
                    $this->form_validation->set_rules('account_holder_name', 'Account Holder Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('bank_account_number', 'Bank Account Number', 'trim|numeric|required|xss_clean');
                    $this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'account_holder_name' => $data['account_holder_name'],
                            'bank_name' => $data['bank_name'],
                            'bank_account_number' => $data['bank_account_number'],
                            'ifsc_code' => $data['ifsc_code'],
                        );
                        $res = $this->Main_model->update('tbl_bank_details', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'BANK Details Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Updating Bank Details Please Try Again ...');
                        }
                    }
                }
            }
            $response['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
            $response['user']['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $user_id), '*');
            $this->load->view('edit_user', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function UpdateRank(){
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('directs', 'Directs', 'trim|numeric|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                    if(!empty($user)){
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $data['user_id']),array('directs' => $data['directs']));
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Rank Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Updating Rank  Please Try Again ...');
                        }
                    }else{
                        $this->session->set_flashdata('message', 'Invalid user');
                    }
                }
            }
            $this->load->view('update_rank', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function CreateNews() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
                $this->form_validation->set_rules('news', 'News', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $packArr = array(
                        'title' => $data['title'],
                        'news' => $data['news'],
                    );
                    $res = $this->Main_model->add('tbl_news', $packArr);
                    if ($res == TRUE) {
                        $this->session->set_flashdata('message', 'News Added Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Creating News  Please Try Again ...');
                    }
                }
            }
            $this->load->view('create_news', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function deleteNews($id){
        if (is_admin()) {
            $checkNews = $this->Main_model->get_single_record('tbl_news',['id' => $id],'*');
            if(!empty($checkNews)){
                $this->Main_model->delete('tbl_news',$id);
                $this->session->set_flashdata('message','News deleted successfully');
                redirect('Admin/Settings/news');
            }else{
                $this->session->set_flashdata('message','There is something wrong,Please try later');
                redirect('Admin/Settings/news');
            }
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function popup() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'doc|pdf|jpg|png';
                $config['file_name'] = 'am' . time();
                if($this->input->post('type') == 'image'){
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('media')) {
                        $this->session->set_flashdata('message', $this->upload->display_errors());
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $promoArr = array(
                            'caption' => $this->input->post('caption'),
                            'media' => $data['upload_data']['file_name'],
                            'type' => 'image'
                        ); 
                        $res = $this->Main_model->update('tbl_popup', array('id' => 1),$promoArr);
                        if ($res) {
                            $this->session->set_flashdata('message', 'Image Update Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Adding Popup Please Try Again ...');
                        }
                    }
                }else{
                    $promoArr = array(
                        'caption' => $this->input->post('caption'),
                        'media' => $this->input->post('media'),
                        'type' => 'video'
                    ); 
                    $res = $this->Main_model->update('tbl_popup', array('id' => 1),$promoArr);
                    if ($res) {
                        $this->session->set_flashdata('message', 'Image Updated Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Adding Popup Please Try Again ...');
                    }
                }
                
            }
            $response['materials'] = $this->Main_model->get_records('tbl_popup', array(), '*');
            $this->load->view('popup', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function ResetPassword() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $cpassword = $data['cpassword'];
                $npassword = $data['npassword'];
                $cnpassword = $data['cnpassword'];
                $user = $this->Main_model->get_single_record('tbl_admin', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,password');
                if ($npassword !== $cnpassword) {
                    // $response['message'] = 'Verify Password Doed Not Match';
                    $this->session->set_flashdata('message', 'Verify Password Does Not Match');
                } elseif ($cpassword !== $user['password']) {
                    // $response['message'] = 'Wrong Current Password';
                    $this->session->set_flashdata('message', 'Wrong Current Password');
                } else {
                    $updres = $this->Main_model->update('tbl_admin', array('user_id' => $this->session->userdata['user_id']), array('password' => $cnpassword));
                    if ($updres == true) {
                        // $response['message'] = 'Password Updated Successfully';
                        $this->session->set_flashdata('message', 'Password Updated Successfully');
                        $response['success'] = 1;
                    } else {
                        // $response['message'] = 'There is an error while Changing Password Please Try Again';
                        $this->session->set_flashdata('message', 'There is an error while Changing Password Please Try Again');
                    }
                }
            }
            $this->load->view('reset_password', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function payout_summary() {
        if (is_admin()) {
            $config['total_rows'] = $this->Main_model->payout_dates_count();
            $config['base_url'] = base_url('Admin/Settings/payout_summary/');
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
            $response['records'] = $this->Main_model->datewise_payout($config['per_page'], $segment);
            foreach($response['records'] as $key => $record){
                $incomes  = $this->Main_model->get_incomes('tbl_income_wallet', array('date(created_at)' => $record['date'],'amount > ' => 0), 'ifnull(sum(amount),0) as income , type');
                $response['records'][$key]['incomes'] = calculate_incomes($incomes);
            }
            $response['headerMenu'] = $this->Main_model->getIncomeType();
            $response['segament'] = $segment;
            $response['total_records'] = $config['total_rows'];
            // pr($response,true);
            $this->load->view('payout_summary', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function date_payout($date = '') {
        if (is_admin()) {
            $response['header'] = 'Date Payout';
            $config['base_url'] = base_url() . 'Admin/Settings/date_payout/' . $date;
            $config['total_rows'] = $this->Main_model->get_sum('tbl_income_wallet', array('date(created_at)' => $date), 'ifnull(count(id),0) as sum');
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
            $response['total_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('date(created_at)' => $date), 'ifnull(sum(amount),0) as sum');
            $response['user_incomes'] = $this->Main_model->get_limit_records('tbl_income_wallet', array('date(created_at)' => $date), '*', $config['per_page'], $segment, true);
            foreach($response['user_incomes'] as $k => $income){
                $response['user_incomes'][$k]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $income['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
            }
            $response['segament'] = $segment;
            $this->load->view('incomes', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function income_management(){
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|numeric|required|xss_clean');
                $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), 'user_id');
                    if (!empty($user)) {
                        if($data['type'] == 'credit'){
                            $amount = abs($data['amount']);
                        }else{
                            $amount = -abs($data['amount']);
                        }
                        $IncomeArr = array(
                            'user_id' => $data['user_id'],
                            'amount' => $amount,
                            'type' => $data['income_type'],
                            'description' => 'Admin Amount '.$data['description'],
                        );
                        $res = $this->Main_model->add('tbl_income_wallet', $IncomeArr);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Amount Transferred Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Transferring Amount  Please Try Again ...');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Invalid User ID');
                    }
                }
            }
            $this->load->view('income_management', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function rewardtable(){
    	if(is_admin()){
	        $response['header'] = 'Reward List';
	        $this->load->view('rewardTable.php',$response);
	     }else{
	     	redirect('Admin/Management/login');
	     }   
    }

      public function rewardView($pair,$rank){
      	if(is_admin()){
	       $response['header'] = $rank;

	       $response['users'] = $this->Main_model->get_records('tbl_users',['leftPower >= ' => $pair,'rightPower >=' => $pair],'user_id,name,leftPower,rightPower');
	        $this->load->view('rewardView.php',$response);
	     }else{
	     	redirect('Admin/Management/login');
	     }   


    }

}
