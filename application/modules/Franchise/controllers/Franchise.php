<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Franchise extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index() {
        if (is_logged_in()) {
            $response['popup'] = $this->User_model->get_single_record1('tbl_user_popup', '*');
            $response['news'] = $this->User_model->get_single_record1('tbl_news', '*');
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['franchise_id']), '*');
            $response['totalStock'] = $this->User_model->get_single_record('tbl_franchise_products',['user_id' => $this->session->userdata['franchise_id']],'ifnull(sum(quantity),0) as totalStock');
            $response['ewallet'] = $this->User_model->get_single_record('tbl_wallet',['user_id' => $this->session->userdata['franchise_id']],'ifnull(sum(amount),0) as ewallet');
            $response['totalSale'] = $this->User_model->get_single_record('tbl_orders',['franchise_id' => $this->session->userdata['franchise_id']],'count(id) as totalSale');
            $this->load->view('header', $response);
            $this->load->view('index', $response);
            $this->load->view('footer', $response);
        } else {
            redirect('Franchise/login');
        }
    }

    public function stockTranser(){
        if (is_logged_in()) {
            if($this->input->server("REQUEST_METHOD") == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id','User ID','trim|required');
                $this->form_validation->set_rules('product','Select  Product','trim|required');
                $this->form_validation->set_rules('quantity','Quantity','trim|required');
                $this->form_validation->set_rules('tranxid','Transaction ID','trim|required');
                if($this->form_validation->run() != false){
                    $checkUser = $this->User_model->get_single_record('tbl_franchise',['user_id' => $data['user_id']],'*');
                    if(!empty($checkUser)){
                        $checkStock = $this->User_model->get_single_record('tbl_franchise_products',['user_id' => $this->session->userdata['franchise_id'],'product_id' => $data['product']],'quantity');
                        if($checkStock['quantity'] >= $data['quantity']){
                            $checkEntry = $this->User_model->get_single_record('tbl_franchise_products',['user_id' => $data['user_id'],'product_id' => $data['product']],'*');
                            if(empty($checkEntry)){
                                $stockEntry = [
                                    'user_id' => $data['user_id'],
                                    'product_id' => $data['product'],
                                    'quantity' => $data['quantity'],
                                    'tranxid' => $data['tranxid'],
                                ];
                                $res = $this->User_model->add('tbl_franchise_products',$stockEntry);
                                $this->User_model->update('tbl_franchise_products',['user_id' => $this->session->userdata['franchise_id'],'product_id' => $data['product']],['quantity' => ($checkStock['quantity'] - $data['quantity'])]);
                                if($res){
                                    $this->session->set_flashdata('message','Stock transferred successfully');
                                    redirect('Franchise/stockTranser');
                                }else{
                                    $this->session->set_flashdata('message','Error while transferring stock');
                                }
                            }else{
                                $stockEntry = [
                                    'quantity' => ($data['quantity'] + $checkEntry['quantity']) ,
                                    'tranxid' => ($checkEntry['tranxid'].','.$data['tranxid']),
                                ];
                                $res = $this->User_model->update('tbl_franchise_products',['user_id' => $data['user_id'],'product_id' => $data['product']],$stockEntry);
                                $this->User_model->update('tbl_franchise_products',['user_id' => $this->session->userdata['franchise_id'],'product_id' => $data['product']],['quantity' => ($checkStock['quantity'] - $data['quantity'])]);
                                if($res){
                                    $this->session->set_flashdata('message','Stock transfered successfully');
                                }else{
                                    $this->session->set_flashdata('message','Error while transferring stock');
                                }
                            }

                        }else{
                            $this->session->set_flashdata('message','Not enought stock to transfer');
                        }
                    }else{
                        $this->session->set_flashdata('message','Invalid User ID');
                    }
                }
            }
            $product = array();
            $product = $this->User_model->get_records('tbl_franchise_products',['user_id' => $this->session->userdata['franchise_id']],'product_id,quantity');
            foreach($product as $key => $p){
                $product[$key]['detail'] = $this->User_model->get_single_record('tbl_products',['id' => $p['product_id']],'title');
            }
            $option = '<option value="">Select Product</option>';
            foreach($product as $k => $pro){
                $option.='<option value='.$pro['product_id'].'>'.$pro['detail']['title'].' ('.$pro['quantity'].')</option>';
            }
            $response['form'] = '<div class="form-group">
                                    <label class="col-xl-3 col-lg-3 col-form-label">User ID</label>
                                    <div class="col-lg-9 col-xl-6">
                                       <input type="text" name="user_id" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Select Product</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <select name="product" class="form-control">'.$option.'</select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Quantity</label>
                                    <div class="col-lg-9 col-xl-6">
                                       <input type="number" name="quantity" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Transaction ID</label>
                                    <div class="col-lg-9 col-xl-6">
                                       <input type="text" name="tranxid" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-9 col-xl-6">
                                       <button type="submit" class="btn btn-success">Transfer</button>
                                    </div>
                                </div>';
            $response['header'] = 'Transfer Stock';
            $this->load->view('form',$response);
        } else {
            redirect('Franchise/login');
        }
    }

    public function login() {
        redirect('Franchise/MainLogin');
    }
    public function MainLogin() {
        $response['message'] = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $checkUser = $this->User_model->get_single_record('tbl_franchise', array('user_id' => $data['user_id']), '*');
            if(!empty($checkUser)){
                $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id'], 'password' => $data['password']), 'id,user_id,disabled');
                if (!empty($user)) {
                    if ($user['disabled'] == 0) {
                        $this->session->set_userdata('franchise_id', $user['user_id']);
                        $this->session->set_userdata('role', 'F');
                        redirect('Franchise/');
                    } else {
                        $response['message'] = 'This Account Is Blocked Please Contact to Administrator';
                    }
                } else {
                    $response['message'] = 'Invalid Credentials';
                }
            }else{
                $response['message'] = 'Invalid Credentials';
            }
        }
        $this->load->view('main_login', $response);
    }

    public function logout() {
        $this->session->unset_userdata(array('franchise_id', 'role'));
        redirect('Franchise/login');
    }
}