<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shopping extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Shopping_model','User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index() {
        if (is_logged_in()) {
            $response = array();
            $response['products'] = $this->Shopping_model->get_product();
            $this->load->view('Shopping/my_shop', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function product_list() {
        if (is_logged_in()) {
            $response = array();
            $Mainuser = $this->Shopping_model->get_single_record('tbl_users',['user_id' => $this->session->userdata['user_id']],'id,user_id,role');
            if($Mainuser['role'] == 'F'){
                if ($this->input->server('REQUEST_METHOD') == 'GET') {
                    $user_id = $this->input->get('user_id');
                    $user = $this->Shopping_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    if(!empty($user)){
                        $response['user'] = $user;
                        $response['products'] = $this->Shopping_model->get_product();
                        $this->load->view('Shopping/online-shopping.php', $response);
                    }else{
                        $this->session->set_flashdata('message', 'Invalid User ID');
                        $this->load->view('Shopping/my_shop', $response);
                    }
                    
                }else{
                   $this->load->view('Shopping/my_shop', $response);
                }
            }else{
                $this->session->set_flashdata('message', 'Only Franchise Account Can Purchase Products');
                $this->load->view('Shopping/my_shop', $response);
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function checkStock(){
        if (is_logged_in()) {
            $res = array();
            $qnty = $this->input->get('qnty');
            $product = $this->input->get('product');
            $check = $this->User_model->get_single_record('tbl_products',['id' => $product],'quantity');
            if($check['quantity'] < $qnty){
                $res['res'] = 'Stock is not available';
            }
            $res['stock'] = $check['quantity'];
            $res['qnty'] = $qnty;
            echo json_encode($res);
            exit;
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function order_list() {
        if (is_logged_in()) {
            $response = array();
            $response['orders'] = $this->Shopping_model->get_records('tbl_orders', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('Shopping/order_list', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function product($id) {
        if (is_logged_in()) {
            $response['product'] = $this->Shopping_model->get_single_record('tbl_products', array('id' => $id), '*');
            $response['product_images'] = $this->Shopping_model->get_records('tbl_product_images', array('product_id' => $id), 'image');
            $this->load->view('Shopping/product_view', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Cart() {
        if (is_logged_in()) {
            $response = array();
            $response['cart_item'] = $this->Shopping_model->cart_items($this->session->userdata['user_id']);
            $response['tax'] = $this->Shopping_model->get_single_record('tbl_tax', array('id' => 1), '*');
            $this->load->view('Shopping/cart', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function place_order() {
        if (is_logged_in()) {
            $response = array();
            $response['success'] = 0;
            $response['token_name'] = $this->security->get_csrf_token_name();
            $response['token_value'] = $this->security->get_csrf_hash();
            $user_id = $this->input->post('user_id');
            $user = $this->Shopping_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id');
            if(!empty($user)){
                $data = $this->input->post();
                $response['params'] = $data;
                // $response['shipping_charges'] = $this->Shopping_model->get_single_record('tbl_charges', array('type' => 'shipping_charges'), 'amount');
                
                if(!empty($data['product_ids'])){
                    $products = $data['product_ids'];
                    $total_quantity = 0;
                    $total_mrp = 0;
                    $total_bv = 0;
                    $total_igst = 0;
                    $total_sgst = 0;
                    $total_discount = 0;
                    foreach($products as $key => $p){
                        $response['products'][$key] = $this->Shopping_model->get_single_record('tbl_products', array('id' => $p), '*');
                        $response['products'][$key]['quantity'] = $data['quantity'][$key];
                        $total_quantity = $total_quantity + $data['quantity'][$key];
                        $total_mrp = $total_mrp + ($response['products'][$key]['mrp'] * $data['quantity'][$key]);
                        $total_bv = $total_bv + ($response['products'][$key]['bv'] * $data['quantity'][$key]);
                        $total_discount = $total_discount + ($response['products'][$key]['discount'] * $data['quantity'][$key]);
                        $total_igst = $total_igst + ($response['products'][$key]['igst'] * $data['quantity'][$key]);
                        $total_sgst = $total_sgst + ($response['products'][$key]['sgst'] * $data['quantity'][$key]);
                    }
                    // $total_price_with_gst = $total_mrp + ($total_igst + $total_sgst);
                    $total_price_after_discount = $total_mrp - $total_discount;
                    // $total_price_with_shipping_charges = $total_price_after_discount;// + $response['shipping_charges']['amount'];
                    // $response['total_mrp'] = $total_mrp;
                    // $response['total_price_with_gst'] = $total_price_with_gst;
                    // $response['total_price_after_discount'] = $total_price_after_discount;
                    $params['amount'] = $total_price_after_discount;
                    $capable_discount_coupans = $total_price_after_discount / 350;
                    // $params['tax'] = $total_mrp * 12 /100;
                    $params['bv'] = $total_bv;
                    $params['user_id'] = $user['user_id'];
                    $params['payment_method'] = $data['payment_method'];
                    $params['seller_id'] = $this->session->userdata['user_id'];
                    $params['address_id'] = 0;//$data['address_id'];
                    $params['igst'] =  $total_igst;
                    $params['sgst'] =  $total_sgst;
                    $params['order_id'] = $this->generate_order_id();
                    $coupans = $this->Shopping_model->get_single_record('tbl_coupans', array('user_id' => $user_id , 'status' => 0), 'ifnull(count(id),0) as coupans');
                    $capable_coupans = $total_mrp / 350;
                    $response['user_counpans'] = $coupans;
                    $response['capable_coupans'] = $capable_coupans;
                    if($data['coupans'] > $capable_coupans['coupans'] || $data['coupans'] > $coupans['coupans']){
                        $params['coupan_discount'] =  $data['coupans'] * 50;
                        $wallet_deduction = $params['amount'] - $params['coupan_discount'];
                        $wallet_balance = $this->Shopping_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                        $response['wallet_deduction'] = $wallet_balance;
                        if($wallet_balance['wallet_balance'] >= $wallet_deduction){
                            $params['status'] = 1;
                            $response['message'] = 'Order Placed';
                            $WalletArr = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => - $wallet_deduction ,
                                'type' => 'shopping_deduction',
                                'remark' => 'Shopping for ' . $user['user_id'] . ' with invoice #'.$params['order_id'],
                            );
                            $this->Shopping_model->add('tbl_wallet', $WalletArr);
                            // $WalletArr = array(
                            //     'user_id' => $this->session->userdata['user_id'],
                            //     'amount' => $wallet_deduction * 2 /100 ,
                            //     'type' => 'repurchase_income',
                            //     'description' => 'Shopping for ' . $user['user_id'] . ' with invoice #'.$params['order_id'],
                            // );
                            // $this->Shopping_model->add('tbl_income_wallet', $WalletArr);
                
                            $res = $this->Shopping_model->add('tbl_orders', $params);
                            if ($res == true) {
                                $this->update_business($user['user_id'], $user['user_id'], $level = 1, $params['bv'] , $type = 'shopping');
                                for($i = 1 ; $i <= $data['coupans'] ; $i++){
                                    $unused_coupan = $this->Shopping_model->get_single_record('tbl_coupans',['user_id' => $user['user_id'], 'status' => 0],'id');
                                    $this->Shopping_model->update('tbl_coupans', array('id' => $unused_coupan['id']), ['status' => 1]);
                                    $WalletArr = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => 50 ,
                                        'type' => 'discount_coupan',
                                        'remark' => 'Shopping for ' . $user['user_id'] . ' with invoice #'.$params['order_id'],
                                    );
                                    $this->Shopping_model->add('tbl_wallet', $WalletArr);
                                }
                                $totalBV = 0;
                                foreach($response['products'] as $key => $product){
                                    $orderDetail['order_id'] = $params['order_id'];
                                    $orderDetail['product_id'] = $product['id'];
                                    $orderDetail['price'] = $product['mrp'];
                                    $orderDetail['bv'] = $product['bv'];
                                    $orderDetail['quantity'] = $product['quantity'];
                                    $orderDetail['discount'] = $product['discount'];
                                    $orderDetail['igst'] = $product['igst'];
                                    $orderDetail['sgst'] = $product['sgst'];
                                    $this->Shopping_model->add('tbl_order_details', $orderDetail);
                                    $totalBV += $product['bv']; 
                                }

                                $this->repurchaseIncome($this->session->userdata['user_id'],$this->session->userdata['user_id'],$totalBV);
                                // $this->pool_entry($user['user_id'],1 , 500);
                                // $this->pool_entry($user['user_id'],1 , 500);
                                // $this->pool_entry($user['user_id'],1 , 500);
                                // $this->pool_entry($user['user_id'],1 , 500);
                                // $this->pool_entry($user['user_id'],1 , 500);
                                $response['success'] = 1;
                                $response['message'] = 'Order Submitted Succesfully';
                            } else {
                                $response['message'] = 'Error while Submitting Order Please Try Again';
                            }
                        }else{
                            $response['message'] = 'Insufficient Balance';
                        }
                    }else{
                        $response['message'] = 'Invalid Coupan Amount';
                    }
                    
                    $response['order'] = $params;
                }else{
                    $response['message'] = 'Cart is Empty 1';
                }
            }else{
                $response['message'] = 'Invalid User ID';
            }
            echo json_encode($response);
            exit;
        } else {
            redirect('Dashboard/User/login');
        }
    }

    private function repurchaseIncome($user_id,$linkedID,$amount){
        $incomeArr = [
            '1' => '0.03',
            '2' => '0.06',
            '3' => '0.05',
            '4' => '0.07',
            '5' => '0.07',
            '6' => '0.07',
            '7' => '0.05',
            '8' => '0.04',
            '9' => '0.03',
            '10' => '0.03',
            '11' => '0.02',
            '12' => '0.02',
            '13' => '0.02',
            '14' => '0.02',
            '15' => '0.02',

        ];

        foreach($incomeArr as $key => $income){
            $sponser = $this->User_model->get_single_record('tbl_users',['user_id' => $user_id],'sponser_id');
            if(!empty($sponser['sponser_id']) && $sponser['sponser_id'] != 'none'){
                $sponserStatus = $this->User_model->get_single_record('tbl_users',['user_id' => $sponser['sponser_id']],'paid_status');
                if($sponserStatus['paid_status'] >= 1){
                    $repurchaseIncome = [
                        'user_id' => $sponser['sponser_id'],
                        'amount' => $income*$amount,
                        'type' => 'repurchase_level_income',
                        'description' => 'Repurchase Level Income From User ID '.$linkedID.' at level '.$key,
                    ];
                    $this->User_model->add('tbl_income_wallet',$repurchaseIncome);
                }
                $user_id = $sponser['sponser_id'];
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
    public function generate_pool_id(){
        $pool_id = rand(10000, 99999);
        $pool = $this->User_model->get_single_record('tbl_pool',['pool_id' => $pool_id] ,'*');
        if(!empty($pool)){
            return $this->generate_pool_id();
        }else{
            return $pool_id;
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
                $this->User_model->add('tbl_income_wallet', $RankIncome);
                $this->sponser_rank_bonus($upline['user_id'] ,$level , $levelIncomes[$level]['sponser_income']);

                $this->update_pool_count($upline['upline_id'], $pool, $level + 1);
            }
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
    function update_business($user_name = 'A915813', $downline_id = 'A915813', $level = 1, $business = '40' , $type = 'shopping') {
        $user = $this->Shopping_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
            if ($user['position'] == 'L') {
                $c = 'leftBusiness';
            } else if ($user['position'] == 'R') {
                $c = 'rightBusiness';
            } else {
                return;
            }
            $this->Shopping_model->update_business($c, $user['upline_id'] , $business);
            $downlineArray = array(
                'user_id' => $user['upline_id'],
                'downline_id' => $downline_id,
                'position' => $user['position'],
                'business' => $business,
                'type' => $type,
                'created_at' => date('Y-m-d h:i:s'),
                'level' => $level,
            );
            $this->Shopping_model->add('tbl_downline_business', $downlineArray);
            $user_name = $user['upline_id'];

            if ($user['upline_id'] != '') {
                $this->update_business($user_name, $downline_id, $level + 1, $business, $type);
            }
        }
    }
    public function AddUserAddress(){
        if (is_logged_in()) {
            $response = array();
            $response['success'] = 0;
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response['token_name'] = $this->security->get_csrf_token_name();
                $response['token_value'] = $this->security->get_csrf_hash();
                $user_id = $this->input->post('user_id');
                $user = $this->Shopping_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                if(!empty($user)){
                    $cartArr = array(
                        'user_id' => $user['user_id'],
                        'name' => $this->input->post('name'),
                        'type' => '',
                        'phone' => $this->input->post('phone'),
                        'address' => $this->input->post('address'),
                        'city' => $this->input->post('city'),
                        'state' => $this->input->post('state'),
                    );
                    $res = $this->Shopping_model->add('tbl_address', $cartArr);
                    if ($res == true) {
                        $response['success'] = 1;
                        $response['message'] = 'Address Added Succesfully';
                    } else {
                        $response['message'] = 'Error while Adding Address Please Try Again';
                    }
                }else{
                    $response['message'] = 'Invalid User ID';
                }
                echo json_encode($response);
                exit;
                
            }else{
               redirect('Dashboard');
            }
           
            
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function getUserAddress($user_id){
        if (is_logged_in()) {
            $response = array();
            $response['success'] = 0;
            $user = $this->Shopping_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
            if(!empty($user)){
                $response['success'] = 1;
                $response['addresses'] = $this->Shopping_model->get_records('tbl_address', array('user_id' => $user_id), '*');
                foreach($response['addresses'] as $key =>$address){
                    $response['addresses'][$key]['state'] = $this->Shopping_model->get_single_record('states', array('id' => $address['state']), '*');
                }
                
            }else{
                $response['message'] = 'Invalid User ID';
            }
            echo json_encode($response);
            exit;
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function DeleteUserAddress($address_id){
        if (is_logged_in()) {
            $response = array();
            $response['success'] = 0;
            $cart = $this->Shopping_model->get_single_record('tbl_address', array('id' => $address_id), '*');
            if (!empty($cart)) {
                $res = $this->Shopping_model->delete('tbl_address', array('id' => $address_id));
                if ($res == true) {
                    $response['success'] = 1;
                    $response['message'] = 'Address Deleted Successfully';
                } else {
                    $response['message'] = 'Error while Deleting Address';
                }
            } else {
                $response['message'] = 'Invalid address';
            }
            echo json_encode($response);
            exit;
        } else {
            redirect('Dashboard/User/login');
        } 
    }

    public function add_to_cart($product_id) {
        if (is_logged_in()) {
            $response = array();
            $response['success'] = 0;
            $cart = $this->Shopping_model->get_single_record('tbl_cart', array('user_id' => $this->session->userdata['user_id'], 'product_id' => $product_id), '*');
            if (!empty($cart)) {
                $cartArr = array(
                    'quantity' => $cart['quantity'] + 1,
                );
                $res = $this->Shopping_model->update('tbl_cart', array('user_id' => $this->session->userdata['user_id'], 'product_id' => $product_id), $cartArr);
                if ($res == true) {
                    $response['success'] = 1;
                    $response['message'] = 'cart Updated Successfully';
                } else {
                    $response['message'] = 'Error while Updating Cart';
                }
            } else {
                $cartArr = array(
                    'user_id' => $this->session->userdata['user_id'],
                    'product_id' => $product_id,
                    'quantity' => 1,
                );
                $res = $this->Shopping_model->add('tbl_cart', $cartArr);
                if ($res == true) {
                    $response['success'] = 1;
                    $response['message'] = 'Product Added to cart Successfully';
                } else {
                    $response['message'] = 'Error while Adding product to cart';
                }
            }
            echo json_encode($response);
            exit;
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function decrease_item_from_cart($product_id) {
        if (is_logged_in()) {
            $response = array();
            $response['success'] = 0;
            $cart = $this->Shopping_model->get_single_record('tbl_cart', array('user_id' => $this->session->userdata['user_id'], 'product_id' => $product_id), '*');
            if (!empty($cart)) {
                if ($cart['quantity'] > 1) {
                    $cartArr = array(
                        'quantity' => $cart['quantity'] - 1,
                    );
                    $res = $this->Shopping_model->update('tbl_cart', array('user_id' => $this->session->userdata['user_id'], 'product_id' => $product_id), $cartArr);
                    if ($res == true) {
                        $response['success'] = 1;
                        $response['message'] = 'cart Updated Successfully';
                    } else {
                        $response['message'] = 'Error while Updating Cart';
                    }
                } else {
                    $res = $this->Shopping_model->delete('tbl_cart', array('user_id' => $this->session->userdata['user_id'], 'product_id' => $product_id));
                    if ($res == true) {
                        $response['success'] = 1;
                        $response['message'] = 'Item Removed From Cart';
                    } else {
                        $response['message'] = 'Error while Delete Item from Cart';
                    }
                }
            } else {
                $response['message'] = 'Item Not Available in Cart';
            }
            echo json_encode($response);
            exit;
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function remove_item($product_id) {
        if (is_logged_in()) {
            $response = array();
            $response['success'] = 0;
            $cart = $this->Shopping_model->get_single_record('tbl_cart', array('user_id' => $this->session->userdata['user_id'], 'product_id' => $product_id), '*');
            if (!empty($cart)) {
                $res = $this->Shopping_model->delete('tbl_cart', array('user_id' => $this->session->userdata['user_id'], 'product_id' => $product_id));
                if ($res == true) {
                    $response['success'] = 1;
                    $response['message'] = 'Item Removed From Cart';
                } else {
                    $response['message'] = 'Error while Delete Item from Cart';
                }
            } else {
                $response['message'] = 'Item Not Available in Cart';
            }
            echo json_encode($response);
            exit;
        } else {
            redirect('Dashboard/User/login');
        }
    }

    // public function place_order($tab = 'shipping') {
    //     if (is_logged_in()) {
    //         $response = array();
    //         $response['tab'] = $tab;
    //         $response['success'] = 0;
    //         $response['shipping_address'] = (object) $this->Shopping_model->get_single_record('tbl_address', array('user_id' => $this->session->userdata['user_id'], 'type' => 'shipping'), '*');
    //         $response['tax'] = (object) $this->Shopping_model->get_single_record('tbl_tax', array('id' => 1), '*');
    //         $response['e_wallet'] = $this->Shopping_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as sum');
    //         $response['income_wallet'] = $this->Shopping_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as sum');
    //         $countries = $this->Shopping_model->get_records('countries', array(), '*');
    //         $response['sstateArr'] = $this->Shopping_model->get_records('states', array('country_id' => $response['shipping_address']->country), '*');
    //         $response['scityArr'] = $this->Shopping_model->get_records('cities', array('state_id' => $response['shipping_address']->state), '*');
    //         $countryN = array();
    //         foreach ($countries as $key => $country)
    //             $countryN[$country['id']] = $country['name'];
    //         $response['countries'] = $countryN;
    //         $response['cart_item'] = $this->Shopping_model->cart_items($this->session->userdata['user_id']);
    //         $this->load->view('Shopping/place_order', $response);
    //     } else {
    //         redirect('Dashboard/User/login');
    //     }
    // }

    public function checkout() {
        if (is_logged_in()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'GET') {
                $response['success'] = 0;
                $data = $this->security->xss_clean($this->input->get());
                // $data['product_ids'] = array(3,4,5);
                // $data['quantity'] = array(1,3,5);
                // $data['user_id'] = 'admin';
                $response['user'] = $this->Shopping_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), 'id,user_id,name,first_name,last_name,package_id,paid_status,sponser_id');
                $response['states'] = $this->Shopping_model->get_records('states', array(), '*');
                $response['shipping_charges'] = $this->Shopping_model->get_single_record('tbl_charges', array('type' => 'shipping_charges'), 'amount');
                $response['wallet_balance'] = $this->Shopping_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                $response['discount_coupans'] = $this->Shopping_model->get_records('tbl_coupans', array('user_id' => $data['user_id'],'status' => 0), '*');
                if(!empty($response['user'])){
                    if(!empty($data['product_ids'])){
                        $products = $data['product_ids'];
                        foreach($products as $key => $p){
                            $response['products'][$key] = $this->Shopping_model->get_single_record('tbl_products', array('id' => $p), '*');
                            $response['products'][$key]['quantity'] = $data['quantity'][$key];
                        }
                        $this->load->view('Shopping/checkout', $response);
                    }else{
                        $this->session->set_flashdata('message', 'Cart is Empty');
                        $this->load->view('Shopping/my_shop', $response);
                    }
                }else{
                    $this->session->set_flashdata('message', 'Cart is Empty');
                    $this->load->view('Shopping/my_shop', $response);
                }
            }else{
                $this->session->set_flashdata('message', 'Cart is Empty');
                $this->load->view('Shopping/my_shop', $response);
            }
            
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function generate_order_id() {
        //$order_id = rand(1000, 9999);
        //$order = $this->Shopping_model->get_single_record('tbl_orderss', array('order_id' => $order_id), 'max(order_id) as order_id');
        $order = $this->Shopping_model->get_single_record('tbl_orders', array(), 'max(order_id) as order_id');
        return $order['order_id'] + 1;
        // if (empty($order)) {
        // } else {
        //     $this->generate_order_id();
        // }
    }

    // public function update_business($user_id, $amount, $bv) {
    //     $response['sponser'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $userinfo->sponser_id), 'id,user_id,package_id,paid_status,sponser_id');
    //     $response['sponser_package'] = $this->User_model->get_single_record('tbl_package', array('id' => $response['sponser']['package_id']), '*');
    //     $bonus = ($response['package']['bv'] * $response['sponser_package']['commision'] / 100) * 1.3;
    //     $updres = $this->User_model->update('tbl_users', array('user_id' => $userinfo->user_id), array('paid_status' => 1));
    //     $this->User_model->update('tbl_user_positions', array('package' => $response['package']['id']), array('capping' => $response['package']['capping']));
    //     if ($updres == true) {
    //         $incomeArr = array(
    //             'user_id' => $userinfo->sponser_id,
    //             'amount' => $bonus,
    //             'type' => 'personal_refferal_network_bonus',
    //             'description' => 'Personal Refferal Network Bonus from ' . $userinfo->user_id
    //         );
    //         $this->User_model->add('tbl_income_wallet', $incomeArr);

    //         $this->update_business($userinfo->user_id, 1, $response['package']['bv']);
    //         if ($response['sponser_package']['commision'] == '20') {
    //             $roll_up_amount = $response['package']['bv'] * 1.3;
    //             $this->rollup_personal_business($response['sponser']['sponser_id'], $roll_up_amount, $share = 8, $sender_id = $userinfo->user_id, 20);
    //         } elseif ($response['sponser_package']['commision'] == '22') {
    //             $roll_up_amount = $response['package']['bv'] * 1.3;
    //             $this->rollup_personal_business($response['sponser']['sponser_id'], $roll_up_amount, $share = 6, $sender_id = $userinfo->user_id, 22);
    //         } elseif ($response['sponser_package']['commision'] == '24') {
    //             $roll_up_amount = $response['package']['bv'] * 1.3;
    //             $this->rollup_personal_business($response['sponser']['sponser_id'], $roll_up_amount, $share = 4, $sender_id = $userinfo->user_id, 24);
    //         }

    //         $response['message'] = 'Product Purchase Successfully';
    //     } else {
    //         $response['message'] = 'You cannot purchase this product';
    //     }
    // }

    public function Invoice($order_id) {
        if (is_logged_in()) {
            $response = array();
            $response['success'] = 0;
            $order_details = $this->Shopping_model->order_details($order_id);
            $response['order_id'] = $order_id;
            $response['order'] = $this->Shopping_model->get_single_record('tbl_orders', array('order_id' => $order_id), '*');
            $response['franchise'] = $this->Shopping_model->get_single_record('tbl_users', array('user_id' =>  $response['order']['franchise_id']), '*');
            $response['shipping_details'] = $this->Shopping_model->get_single_record('tbl_address', array('id' => $response['order']['address_id']), '*');
            $response['user'] = $this->Shopping_model->get_single_record('tbl_users', array('user_id' => $response['order']['user_id']), 'id,user_id,name,first_name,last_name,phone,email,sponser_id,address,country,state,city,postal_code');
            $response['state'] = $this->Shopping_model->get_single_record('states', array('id' => $response['user']['state']), 'name,gstcode');
            $response['order_details'] = $order_details;
        //    pr($response);  
            $this->load->view('Shopping/invoice', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function PaidInvoice() {
        if (is_logged_in()) {
            $response = array();
            $response['success'] = 0;
            // $order_details = $this->Shopping_model->order_details($order_id);
            // $response['order_id'] = $order_id;
            // $response['order'] = $this->Shopping_model->get_single_record('tbl_orders', array('order_id' => $order_id), '*');
            // $response['franchise'] = $this->Shopping_model->get_single_record('tbl_users', array('user_id' =>  $response['order']['franchise_id']), '*');
            // $response['shipping_details'] = $this->Shopping_model->get_single_record('tbl_address', array('id' => $response['order']['address_id']), '*');
            // $response['order_details'] = $order_details;
            $response['user'] = $this->Shopping_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,name,first_name,last_name,phone,email,sponser_id,address,country,state,city,postal_code,created_at');
            $response['products'] = $this->Shopping_model->get_records('tbl_products', [], '*');
            $response['state'] = $this->Shopping_model->get_single_record('states', array('id' => $response['user']['state']), 'name,gstcode');
        //    pr($response);  
            $this->load->view('Shopping/paid_invoice', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

//     public function OnlinePayment() {
//         $cart_items = $this->Shopping_model->cart_items($this->session->userdata['user_id']);
//         $cart_amount = 0;
//         $total_bv = 0;
//         foreach ($cart_items as $item) {
//             $cart_amount = $cart_amount + ($item['quantity'] * $item['member_price']);
//             $total_bv = $total_bv + ($item['quantity'] * $item['bv']);
//         }
//         $order_id = $this->generate_order_id();
//         $OrderArr = array(
//             'order_id' => $order_id,
//             'user_id' => $this->session->userdata['user_id'],
//             'amount' => $cart_amount,
//             'payment_method' => 'online',
//             'bv' => $total_bv,
//             'status' => 1
//         );
// //        $res = $this->Shopping_model->add('tbl_orders', $OrderArr);
// //        if ($res == true) {
// //            foreach ($cart_items as $item) {
// //                $orderDetailArr = array(
// //                    'order_id' => $order_id,
// //                    'product_id' => $item['id'],
// //                    'quantity' => $item['quantity'],
// //                    'price' => $item['member_price'],
// //                    'bv' => $item['bv'],
// //                );
// ////                $this->Shopping_model->add('tbl_order_details', $orderDetailArr);
// ////                $this->Shopping_model->delete('tbl_cart', array('id' => $item['cart_id']));
// //            }
// //        }
//         echo'<body onload="document.paymentform.submit()">';
//         echo form_open(base_url('payment/'), array('name' => 'paymentform'));
// //        echo'<form action="sd" name="paymentform" method="POST">';
//         echo'<input type="text" name="user_id" value="' . $this->session->userdata['user_id'] . '">';
//         echo'<input type="text" name="package_id" value="' . $order_id . '">';
//         echo'<input type="text" name="amount" value="' . $cart_amount . '">';
//         echo'<input type="text" name="type" value="s">';
//         echo'</form>';
//         echo'</body>';
//     }

//     public function payment_response($id) {
//         $data = array();
//         $transaction = $this->Shopping_model->get_single_record('tbl_user_payments', array('transaction_id' => $id), $select = '*');
//         $tax = $this->Shopping_model->get_single_record('tbl_tax', array('id' => 1), $select = '*');
//         $response['transaction'] = $transaction;
//         $response['description'] = json_decode($transaction['description'], true);
//         if ($response['description']['actionCode'] == 0 && $response['transaction']['type'] == 's') {
//             if ($transaction['link_status'] == 0) {
//                 $cart_items = $this->Shopping_model->cart_items($this->session->userdata['user_id']);
//                 if ($cart_items)
//                     $cart_amount = 0;
//                 $total_bv = 0;
//                 foreach ($cart_items as $item) {
//                     $cart_amount = $cart_amount + ($item['quantity'] * $item['member_price']);
//                     $total_bv = $total_bv + ($item['quantity'] * $item['bv']);
//                 }
//                 $cart_amount = round($cart_amount * $tax['tax'] / 100);
//                 $order_id = $response['transaction']['order_id'];
//                 $OrderArr = array(
//                     'order_id' => $order_id,
//                     'user_id' => $this->session->userdata['user_id'],
//                     'amount' => $cart_amount,
//                     'payment_method' => 'online',
//                     'bv' => $total_bv,
//                     'status' => 1
//                 );
//                 $res = $this->Shopping_model->add('tbl_orders', $OrderArr);
//                 if ($res == true) {
//                     foreach ($cart_items as $item) {
//                         $orderDetailArr = array(
//                             'order_id' => $order_id,
//                             'product_id' => $item['id'],
//                             'quantity' => $item['quantity'],
//                             'price' => $item['member_price'],
//                             'bv' => $item['bv'],
//                         );
//                         $this->Shopping_model->add('tbl_order_details', $orderDetailArr);
//                         $this->Shopping_model->delete('tbl_cart', array('id' => $item['cart_id']));
//                     }
//                 }
//                 $this->Shopping_model->update('tbl_user_payments', array('transaction_id' => $id), array('link_status' => 1));
//                 $response['message'] = 'Order Placed Successfully';
//             }else{
//                 $response['message'] = 'This Order Already Placed';
//             }
// //            pr($this->session->userdata,true);
//         } else {
//             $response['message'] = 'Error In payment process';
//         }
//         $this->load->view('payment_response', $response);
//     }

}
