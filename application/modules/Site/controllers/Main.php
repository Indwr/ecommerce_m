<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','pagination'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('site'));
    }

    public function index() {
        $response['news'] = $this->Main_model->get_records('tbl_news', array(), '*');
        $response['popup'] = $this->Main_model->get_single_record1('tbl_popup', '*');
        $response['top_ranks'] = $this->Main_model->top_ranks();
        $response['top_eaners'] = $this->Main_model->top_earners();
        $response['category'] = $this->Main_model->get_records('tbl_category',[],'*');
        foreach($response['category'] as $key => $cate){
            $response['category'][$key]['product'] = $this->Main_model->get_single_record('tbl_products',['category_id' => $cate['id']],'count(id) as record');
        }
        $response['product'] = $this->Main_model->get_records('tbl_products',['category_type' => '1'],'*');
        foreach($response['product'] as $pk => $pro){
            $response['product'][$pk]['cat'] = $this->Main_model->get_single_record('tbl_category',['id' => $pro['category_id']],'category_name');
            $response['product'][$pk]['image'] = $this->Main_model->get_single_record('tbl_product_images',['product_id' => $pro['id']],'image');
        }

        $response['product2'] = $this->Main_model->get_records('tbl_products',['category_type' => '2'],'*');
        foreach($response['product2'] as $pk => $pro){
            $response['product2'][$pk]['cat'] = $this->Main_model->get_single_record('tbl_category',['id' => $pro['category_id']],'category_name');
            $response['product2'][$pk]['image'] = $this->Main_model->get_single_record('tbl_product_images',['product_id' => $pro['id']],'image');
        }

        $response['product3'] = $this->Main_model->get_records('tbl_products',['category_type' => '3'],'*');
        foreach($response['product3'] as $pk => $pro){
            $response['product3'][$pk]['cat'] = $this->Main_model->get_single_record('tbl_category',['id' => $pro['category_id']],'category_name');
            $response['product3'][$pk]['image'] = $this->Main_model->get_single_record('tbl_product_images',['product_id' => $pro['id']],'image');
        }

        $response['sliderFirst'] = $this->Main_model->get_records('tbl_slider_first',[],'*');
        $response['sliderSecond'] = $this->Main_model->get_records('tbl_slider_second',[],'*');
        $this->load->view('index.php',$response);
    }

    public function Addcart($id){
        $product = $this->Main_model->get_single_record('tbl_products',['id' => $id],'id,category_id,title,mrp,type,description');
        $image = $this->Main_model->get_single_record('tbl_product_images',['product_id' => $id],'image');
        $cartitem = [
            'id' => $product['id'],
            'image' => $image['image'],
            'category_id' => $product['category_id'],
            'title' => $product['title'],
            'mrp' => $product['mrp'],
            'type' => $product['type'],
            'description' => $product['description'],
            'quantity' => 1,
            'total' => $product['mrp']
        ];
        $_SESSION['cart'][$cartitem['id']] = $cartitem;
        redirect('Site/Main/product_detail/'.$id);
    }

    public function Addcart2($id){
        $product = $this->Main_model->get_single_record('tbl_products',['id' => $id],'id,category_id,title,mrp,type,description');
        $image = $this->Main_model->get_single_record('tbl_product_images',['product_id' => $id],'image');
        $cartitem = [
            'id' => $product['id'],
            'image' => $image['image'],
            'category_id' => $product['category_id'],
            'title' => $product['title'],
            'mrp' => $product['mrp'],
            'type' => $product['type'],
            'description' => $product['description'],
            'quantity' => 1,
            'total' => $product['mrp']
        ];
        $_SESSION['cart'][$cartitem['id']] = $cartitem;
        redirect('Site/Main/shop');
    }

    public function cart(){
        $data = array();
        if(!empty($_SESSION['cart'])){
            $data['cart'] = $_SESSION['cart'];
            foreach($data['cart'] as $key => $cart){
                $data['cart'][$key]['cate'] = $this->Main_model->get_single_record('tbl_category',['id' => $cart['category_id']],'category_name');
                $data['cart'][$key]['image'] = $this->Main_model->get_single_record('tbl_product_images',['product_id' => $cart['id']],'image');
            }
        }
        $this->load->view('cart',$data);
    }

    public function updateCart(){
        $id = $this->input->get('item');
        $qnty = $this->input->get('qnty');
        $checkQuantity = $this->Main_model->get_single_record('tbl_products',['id' => $id],'quantity');
        if($checkQuantity['quantity'] >= $qnty){
            $price =  $_SESSION['cart'][$id]['mrp'];
            $_SESSION['cart'][$id]['quantity'] = $qnty;
            $_SESSION['cart'][$id]['total'] = $price*$qnty;
            $_SESSION['cart'][$id]['total'];
            echo 'Quantity Added';
        }else{
            echo 'Stock Not Available';
        }
    }

    public function removecart(){
        $id = $this->input->get('item');
        unset($_SESSION['cart'][$id]);
    }

    public function checkout(){
        if(is_logged_in()){
            if($this->input->server('REQUEST_METHOD')== "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $total = 0;
                if(!empty($data['title'])){
                    foreach($data['title'] as $key =>  $d){
                        $cartitem[$key]['product_id'] = $data['id'][$key];
                        $cartitem[$key]['title'] = $data['title'][$key];
                        $cartitem[$key]['quantity'] = $data['quantity'][$key];
                        $cartitem[$key]['total'] = $data['total'][$key];
                        $total += $data['total'][$key];
                    }
                    $_SESSION['cartItem'] = $cartitem;
                    $_SESSION['finalAmount'] = $total;
                }
                redirect('Site/Main/checkout2');
            }
            $this->load->view('checkout');
        }else{
            redirect('Site/Main/login');
        }
    }

    public function checkout2(){
        if(is_logged_in()){
            if(!empty($_SESSION['cartItem'])){
                $userdata = $this->Main_model->get_single_record('tbl_users',['email' => $this->session->userdata['user_id']],'*');
                $response = [
                    'appId' => '9372163489a7264ac230f8c6f12739',
                    'orderId' => $this->order_id(),
                    'orderAmount' => $_SESSION['finalAmount'],
                    'orderCurrency' => 'INR',
                    'orderNote' => 'Test',
                    'customerName' => $userdata['name'],
                    'customerEmail' => $userdata['email'],
                    'customerPhone' => $userdata['phone'],
                    'returnUrl' => base_url('Site/Main/returndata'),
                    'notifyUrl' => base_url('Site/Main/notifyUser'),
                ];
                $response['signature'] = $this->getSignature($response);
                $this->session->set_userdata('orderId',$response['orderId']);
                //echo json_encode($response);
                $this->load->view('checkout2',$response);
            }else{
                echo '<script>
                    alert("There is no item in the cart");
                    window.location.href = "https://arisestarworld.com/Site/Main/cart";
                </script>';
            }
        }else{
            redirect('Site/Main/login');
        }
    }

    private function order_id() {
        $order = $this->Main_model->get_single_record('tbl_online_payment', array(), 'max(orderId) as orderId');
        $neworderid = $order['orderId'] + 1;
        $this->Main_model->add('tbl_online_payment',['orderId' => $neworderid]);
        return $neworderid;
    }

    private function getSignature($postData){
        $secretKey = "0cd872a693c63f77b0fcb0de97f62f0d82151b3b";
        ksort($postData);
        $signatureData = "";
        foreach ($postData as $key => $value){
            $signatureData .= $key.$value;
        }
        $signature = hash_hmac('sha256', $signatureData, $secretKey,true);
        $signature = base64_encode($signature);
        return $signature;
    }

    public function notifyUser(){
        //$this->load->view('notifyUsers');
    }

    public function returndata(){
        $response = array();
        if(!empty($_POST)){
            $_POST['email'] = $this->session->userdata['user_id'];
            $this->Main_model->add('tbl_online_payment',$_POST);
            foreach($_SESSION['cartItem'] as $d){
                $order = [
                    'product_id' => $d['product_id'],
                    'price' => $d['total'],
                    'quantity' => $d['quantity'],
                    'title' => $d['title'],
                ];
                $this->Main_model->update('tbl_order_details',['order_id' => $this->session->userdata['orderId']],$order);
            }
            unset($_SESSION['cartItem']);
            unset($_SESSION['finalAmount']);
            unset($_SESSION['cart']);
            unset($_SESSION['totalAmount']);
            unset($_SESSION['orderId']);
            $this->session->set_flashdata('message','Payment Done Successfully');
            $response['message'] = $_POST;
        }
        $this->load->view('return',$response);
    }

    // public function userLogin(){
    //     if(!empty($_SESSION['token'])){
    //         if($this->input->get('token') == $_SESSION['token']){
    //             $checkUser = $this->Main_model->get_single_record('tbl_users',['user_id' => $this->input->get('user'),'password' => $this->input->get('password')],'*');
    //             if(!empty($checkUser)){
    //                 $_SESSION['paymentUser'] = $checkUser['user_id'];
    //                 $getWallet = $this->Main_model->get_single_record('tbl_wallet',['user_id' => $this->input->get('user')],'ifnull(sum(amount),0) as balance');
    //                 if(!empty($_SESSION['totalAmount'])){
    //                     if($getWallet['balance'] >= $_SESSION['totalAmount']){
    //                         echo '<p style="color:red;">Wallet Balance $'.$getWallet['balance'].'</p>';
    //                         echo '<button class="btn btn-success" onclick="paymentProcess()">Proceed To Payment </button>';
    //                     }else{
    //                         echo '<p style="color:red;">Wallet Balance $'.$getWallet['balance'].'</p>';
    //                         echo '<p style="color:red;">Your Wallet Balance is low</p>';
    //                     }
    //                 }else{
    //                     echo '<p style="color:red;">No item is added to cart</p>';
    //                 }
    //             }else{
    //                 echo '<p style="color:red;">Invalid User ID or Password</p>';
    //             }
    //         }else{
    //             echo '<p style="color:red;">This session Expire,Please try again</p>';
    //         }
    //     }else{
    //         echo '<p style="color:red;">Server Error,Please try again</p>';
    //     }
    // }

    public function payment(){
        $this->place_order();

    }

    private function place_order() {
        if (!empty($_SESSION['paymentUser'])) {
            $user_id = $_SESSION['paymentUser'];
            $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id');
            if(!empty($user)){
                $data = $_SESSION['cartItem'];
                $response['params'] = $_SESSION['cartItem'];
                if(!empty($data)){
                    $products = $data;
                    $total_quantity = 0;
                    $total_mrp = 0;
                    $total_bv = 0;
                    $total_igst = 0;
                    $total_sgst = 0;
                    $total_discount = 0;
                    foreach($products as $key => $p){
                        $response['products'][$key] = $this->Main_model->get_single_record('tbl_products', array('id' => $p['product_id']), '*');
                        $response['products'][$key]['quantity'] = $products[$key]['quantity'];
                        $total_quantity = $total_quantity + $products[$key]['quantity'];
                        $total_mrp = $total_mrp + ($response['products'][$key]['mrp'] * $products[$key]['quantity']);
                        $total_bv = $total_bv + ($response['products'][$key]['bv'] * $products[$key]['quantity']);
                        $total_discount = $total_discount + ($response['products'][$key]['discount'] * $products[$key]['quantity']);
                        $total_igst = $total_igst + ($response['products'][$key]['igst'] * $products[$key]['quantity']);
                        $total_sgst = $total_sgst + ($response['products'][$key]['sgst'] * $products[$key]['quantity']);
                    }
                    $total_price_after_discount = $total_mrp - $total_discount;
                    $params['amount'] = $total_price_after_discount;
                    $params['bv'] = $total_bv;
                    $params['user_id'] = $user['user_id'];
                    $params['payment_method'] = '';//$data['payment_method'];
                    $params['seller_id'] = $_SESSION['paymentUser'];
                    $params['address_id'] = 0;//$data['address_id'];
                    $params['igst'] =  $total_igst;
                    $params['sgst'] =  $total_sgst;
                    $params['order_id'] = $this->generate_order_id();
                        $wallet_deduction = $params['amount'];
                        $wallet_balance = $this->Main_model->get_single_record('tbl_wallet', array('user_id' => $user_id), 'ifnull(sum(amount),0) as wallet_balance');
                        $response['wallet_deduction'] = $wallet_balance;
                        if($wallet_balance['wallet_balance'] >= $wallet_deduction){
                            $params['status'] = 1;
                            $response['message'] = 'Order Placed';
                            $WalletArr = array(
                                'user_id' => $user_id,
                                'amount' => - $wallet_deduction ,
                                'type' => 'shopping_deduction',
                                'remark' => 'Shopping for ' . $user['user_id'] . ' with invoice #'.$params['order_id'],
                            );
                            $this->Main_model->add('tbl_wallet', $WalletArr);

                            $res = $this->Main_model->add('tbl_orders', $params);
                            if ($res == true) {
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
                                    $this->Main_model->add('tbl_order_details', $orderDetail);
                                    $getQuantity = $this->Main_model->get_single_record('tbl_products', array('id' => $orderDetail['product_id']), 'quantity');
                                    $this->Main_model->update('tbl_products',['id' => $orderDetail['product_id']],['quantity' => ($getQuantity['quantity'] - $orderDetail['quantity'])]);
                                    $totalBV += $product['bv'];
                                }

                                $this->repurchaseIncome($user_id,$user_id,$totalBV);
                                echo 'Order Submitted successfully';
                                $response['success'] = 1;
                                $response['message'] = 'Order Submitted Succesfully';
                                session_destroy();
                            } else {
                                $response['message'] = 'Error while Submitting Order Please Try Again';
                            }
                        }else{
                            $response['message'] = 'Insufficient Balance';
                        }

                    $response['order'] = $params;
                }else{
                    echo 'Cart is Empty 1';
                }
            }else{
                echo  'Invalid User ID';
            }
        } else {
            die('Server Error');
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
            $sponser = $this->Main_model->get_single_record('tbl_users',['user_id' => $user_id],'sponser_id');
            if(!empty($sponser['sponser_id']) && $sponser['sponser_id'] != 'none'){
                $sponserStatus = $this->Main_model->get_single_record('tbl_users',['user_id' => $sponser['sponser_id']],'paid_status');
                if($sponserStatus['paid_status'] >= 1){
                    $repurchaseIncome = [
                        'user_id' => $sponser['sponser_id'],
                        'amount' => $income*$amount,
                        'type' => 'repurchase_level_income',
                        'description' => 'Repurchase Level Income From User ID '.$linkedID.' at level '.$key,
                    ];
                    $this->Main_model->add('tbl_income_wallet',$repurchaseIncome);
                }
                $user_id = $sponser['sponser_id'];
            }
        }
    }

    private function update_business($user_name = 'A915813', $downline_id = 'A915813', $level = 1, $business = '40' , $type = 'shopping') {
        $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
            if ($user['position'] == 'L') {
                $c = 'leftBusiness';
            } else if ($user['position'] == 'R') {
                $c = 'rightBusiness';
            } else {
                return;
            }
            $this->Main_model->update_business($c, $user['upline_id'] , $business);
            $downlineArray = array(
                'user_id' => $user['upline_id'],
                'downline_id' => $downline_id,
                'position' => $user['position'],
                'business' => $business,
                'type' => $type,
                'created_at' => date('Y-m-d h:i:s'),
                'level' => $level,
            );
            $this->Main_model->add('tbl_downline_business', $downlineArray);
            $user_name = $user['upline_id'];

            if ($user['upline_id'] != '') {
                $this->update_business($user_name, $downline_id, $level + 1, $business, $type);
            }
        }
    }

    private function generate_order_id() {
        $order = $this->Main_model->get_single_record('tbl_orders', array(), 'max(order_id) as order_id');
        return $order['order_id'] + 1;
    }

    public function product_detail($id) {
        $response['product'] = $this->Main_model->get_single_record('tbl_products',['id' => $id],'*');
        $response['image'] = $this->Main_model->get_single_record('tbl_product_images',['product_id' => $id],'image');
        $this->load->view('product_detail.php',$response);
    }
    public function bank() {
        $response['bankDetails'] = $this->Main_model->get_single_record('tbl_site_content',['id' => '1'],'bank_details');
        $this->load->view('bank.php',$response);
    }
    public function businessPlan() {
        $response['pdf_file'] = $this->Main_model->get_single_record('tbl_site_content',['id' => '1'],'pdf');
        $this->load->view('business-plan.php',$response);
    }
    public function shop() {
        $id = $this->input->get('value');
        $v1 = $this->input->get('start');
        $v2 = $this->input->get('end');
        if(!empty($id)){
            $v1 = $this->input->get('start');
            $v2 = $this->input->get('end');
            $where['category_id'] = $id;
            if(!empty($v2)){
                $where = ['mrp >=' => $v1,'mrp <=' => $v2,'category_id' => $id];
            }
            $allP = $this->Main_model->get_records('tbl_products',[],'*');
            $config['base_url'] = base_url('Site/Main/shop/?value='.$id);
            $config['total_rows'] = count($allP);
            $config['per_page'] = 51;
            $config['page_query_string'] = TRUE;
            $offset = $this->input->get('per_page');

            $response['allCategory'] = $this->Main_model->get_records('tbl_category',[],'*');
            $response['category'] = $this->Main_model->get_single_record('tbl_category',['id' => $id],'category_name');
            $response['product'] = $this->Main_model->get_limit_records('tbl_products',$where, '*' ,$config['per_page'], $offset);

            foreach($response['product'] as $pk => $pro){
                $response['product'][$pk]['cat'] = $this->Main_model->get_single_record('tbl_category',['id' => $pro['category_id']],'category_name');
                $response['product'][$pk]['image'] = $this->Main_model->get_single_record('tbl_product_images',['product_id' => $pro['id']],'image');
            }
            $this->pagination->initialize($config);
            $response['id'] = $id;
        }else{
            $where = array();
            $v1 = $this->input->get('start');
            $v2 = $this->input->get('end');
            if(!empty($v2)){
                $where = ['mrp >=' => $v1,'mrp <=' => $v2];
            }
            //pr($where,true);
            $allP = $this->Main_model->get_records('tbl_products',[],'*');
            $config['base_url'] = base_url('Site/Main/shop/?value='.$id);
            $config['total_rows'] = count($allP);
            $config['per_page'] = 51;
            $config['page_query_string'] = TRUE;
            $offset = $this->input->get('per_page');

            $response['allCategory'] = $this->Main_model->get_records('tbl_category',[],'*');
            $response['category'] = ['category_name' => 'All Products'];
            $response['product'] = $this->Main_model->get_limit_records('tbl_products',$where, '*' ,$config['per_page'], $offset);
            foreach($response['product'] as $pk => $pro){
                $response['product'][$pk]['cat'] = $this->Main_model->get_single_record('tbl_category',['id' => $pro['category_id']],'category_name');
                $response['product'][$pk]['image'] = $this->Main_model->get_single_record('tbl_product_images',['product_id' => $pro['id']],'image');
            }
            $this->pagination->initialize($config);
        }
        $this->load->view('shop.php',$response);
    }
    public function company() {
        $response['company_profile'] = $this->Main_model->get_single_record('tbl_site_content',['id' => '1'],'company_profile');
        $this->load->view('company.php',$response);
    }
    public function news() {
        $response['news'] = $this->Main_model->get_single_record('tbl_site_content',['id' => '1'],'news');
        $this->load->view('news.php',$response);
    }
    public function legal() {
        $response['legal'] = $this->Main_model->get_single_record('tbl_site_content',['id' => '1'],'legal');
        $this->load->view('legal.php',$response);
    }
    public function franchise() {
        $response['data'] = $this->Main_model->get_records('tbl_franchise',[],'*');
        $this->load->view('franchise.php',$response);
    }
    public function about() {
        $response['content'] = $this->Main_model->get_single_record('tbl_site_content',['id' => '1'],'content');
        $this->load->view('about.php',$response);
    }
    public function contact() {
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');
            if($this->form_validation->run() != FALSE){
                $userData = [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'subject' => $data['subject'],
                    'message' => $data['message'],
                ];
                $this->Main_model->add('tbl_contactUs',$userData);
                $this->session->set_flashdata('message','Your Query sent successfully');
            }
        }
        $this->load->view('contact.php');
    }
    public function terms() {
        $this->load->view('terms.php');
    }
    public function refundpolicy() {
        $this->load->view('refundpolicy.php');
    }
    public function privacypolicy() {
        $this->load->view('privacypolicy.php');
    }
    public function returnpolicy() {
        $this->load->view('returnpolicy.php');
    }
    public function faq() {
        $this->load->view('faq.php');
    }
    public function shippingpolicy() {
        $this->load->view('shippingpolicy.php');
    }
    public function content($content) {
        $this->load->view($content);
    }

    public function venderList(){
        $data = $this->Main_model->get_records('tbl_visiting_cards',['status' => 1],'*');
        $tr = array();
        foreach($data as $key => $d){
           $tr[$key] = '<div class="col-lg-4 col-md-4">
                            <div class="team-card text-center">
                                <img style="width:100%; min-height:300px" src='.base_url('uploads/'.$d['image']).' alt="">
                                <p class="mb-4">'.$d['name'].'</p>
                                <h6 class="mb-0 text-success">'.$d['city'].'</h6>
                                <h6 class="mb-0 text-success">'.$d['state'].'</h6>
                            </div>
                        </div>';
        }
        $response['tr'] = $tr;
        $response['header'] = 'Vender List';
        $response['header2'] = 'Our Vender';
        $this->load->view('venderList',$response);
    }

    public function videos(){
        $data = $this->Main_model->get_records('tbl_img_vid',['status' => 2],'*');
        $tr = array();
        foreach($data as $key => $d){
           $tr[$key] = '<div class="col-lg-4 col-md-4">
                            <div class="team-card text-center">
                                <iframe src="https://www.youtube.com/embed/'.$d['media'].'"></iframe>
                            </div>
                        </div>';
        }
        $response['tr'] = $tr;
        $response['header'] = 'Video List';
        $response['header2'] = 'Our Video';
        $this->load->view('videos',$response);
    }

    public function images(){
        $data = $this->Main_model->get_records('tbl_img_vid',['status' => 1],'*');
        $tr = array();
        foreach($data as $key => $d){
           $tr[$key] = '<div class="col-lg-4 col-md-4">
                            <div class="team-card text-center">
                                <img style="width:100%; min-height:300px" src='.base_url('uploads/'.$d['media']).' alt="">
                            </div>
                        </div>';
        }
        $response['tr'] = $tr;
        $response['header'] = 'Images List';
        $response['header2'] = 'Our Images';
        $this->load->view('images',$response);
    }

    public function achiever(){
        $data = $this->Main_model->get_records('tbl_achievers',[],'*');
        $tr = array();
        foreach($data as $key => $d){
           $tr[$key] = '<div class="col-lg-4 col-md-4">
                            <div class="team-card text-center">
                                <img style="width:100%; min-height:300px" src='.base_url('uploads/'.$d['image']).' alt="">
                                <p class="mb-4">'.$d['user_id'].'</p>
                            </div>
                        </div>';
        }
        $response['tr'] = $tr;
        $response['header'] = 'Achiever List';
        $response['header2'] = 'Our Achiever';
        $this->load->view('achiever',$response);
    }

    public function tracking(){
        if($this->input->server("REQUEST_METHOD") == "POST"){
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('email','Email','trim|required');
            if($this->form_validation->run() != false){
                $checkEmail = $this->Main_model->get_single_record('tbl_users',['email' => $data['email']],'email');
                if(!empty($checkEmail)){
                    $response['data'] = $this->Main_model->get_records('tbl_online_payment',['email' => $data['email']],'*');
                    foreach($response['data'] as $key => $d){
                        $response['data'][$key]['details'] = $this->Main_model->get_single_record('tbl_order_details',['order_id' => $d['orderId']],'*');
                    }
                }else{
                    $this->session->set_flashdata('message','Please enter valid Email Addresss');
                }
            }
        }
        $response['header'] = 'Track Orders';
        $this->load->view('trackInvoice',$response);
    }

    public function orderHistory(){
        if(is_logged_in()){
            $response['data'] = $this->Main_model->get_records('tbl_online_payment',['email' => $this->session->userdata['user_id']],'*');
            foreach($response['data'] as $key => $d){
                $response['data'][$key]['details'] = $this->Main_model->get_single_record('tbl_order_details',['order_id' => $d['orderId']],'*');
            }
            $response['header'] = 'All Orders Details';
            $this->load->view('trackInvoice',$response);
        }else{
            redirect('Site/Main/login');
        }
    }

    public function login() {
        redirect('Site/Main/MainLogin');
    }
    public function MainLogin() {
        // die('Site Under Maintainance');
        $response['message'] = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $user = $this->Main_model->get_single_record('tbl_users', array('email' => $data['user_id'], 'password' => $data['password']), 'id,user_id,role,name,email,paid_status,disabled');
            if (!empty($user)) {
                if ($user['disabled'] == 0) {
                    $this->session->set_userdata('user_id', $user['email']);
                    $this->session->set_userdata('role','U');
                    redirect('Site/Main/');
                } else {
                    $response['message'] = 'This Account Is Blocked Please Contact to Administrator';
                }
            } else {
                $response['message'] = 'Invalid Credentials';
            }
        }
        $this->load->view('main_login', $response);
    }

    public function logout() {
        $this->session->unset_userdata(array('user_id', 'role'));
        redirect('Site/Main');
    }

    public function check_sponser() {
        $response = array();
        $response['success'] = 0;
        $user_id = $this->input->post('sponser_id');
        $sponser = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id,last_left,last_right,name');
        if (!empty($sponser)) {
            $response['message'] = 'Sponser Found';
            $response['success'] = 1;
            $response['sponser'] = $sponser;
        } else {
            $response['message'] = 'Sponser Not Found';
        }

        echo json_encode($response);
    }

    public function mail() {
        $this->email->from('info@gnisoftsolutions.com', 'Kush');
        $this->email->to('349kuldeep@gmail.com');
//        $this->email->cc('another@another-example.com');
//        $this->email->bcc('them@their-example.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        if (!$this->email->send()) {
            // Generate error
        }
    }

}
