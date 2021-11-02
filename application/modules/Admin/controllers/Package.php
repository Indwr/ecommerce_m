<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
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

    public function category(){
        if(is_admin()){
            if($this->input->server('REQUEST_METHOD') == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('category','Category Name','trim|required');
                if($this->form_validation->run() != false){
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = 1024;
                    $config['file_name'] = 'category'.time();
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('image')) {
                        $this->session->set_flashdata('message',$this->upload->display_errors());
                    }else{
                        $fileData = array('upload_data' => $this->upload->data());
                        $formData = [
                            'category_name' => $data['category'],
                            'image' => $fileData['upload_data']['file_name'],
                        ];
                        $res = $this->Main_model->add('tbl_category',$formData);
                        if($res){
                            $this->session->set_flashdata('message','Category Created Successfully');
                            redirect('Admin/Package/category');
                        }else{
                            $this->session->set_flashdata('message','Error while creating category');
                        }
                    }
                }
            }
            $response['field'] = [
                '1' => ['label' => 'Category Name','name' => 'category','type' => 'text','placeholder' => 'Enter Category Name'],
                '2' => ['label' => 'Category Image','name' => 'image','type' => 'file','placeholder' => ''],
            ];

            $response['submit'] = 'Create Category';
            $response['header'] = 'Create Category';
            $response['tableRecord'] = $this->Main_model->get_records('tbl_category',[],'*');
            $response['thead'] = ['#','Category Name','Image','Date'];
            $response['tbody'] = ['category_name','image','created_at'];
            $this->load->view('form',$response);
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function create() {
        if (is_admin()) {
            $response = [];
            $response['products'] = $this->Main_model->get_records('tbl_products', array(), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
                $this->form_validation->set_rules('bv', 'BV', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('description', 'description', 'trim|required|xss_clean');
                $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
                $this->form_validation->set_rules('commision', 'Commision', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $q = $this->input->post('item_count');
                    $products = $this->input->post('product');
                    foreach ($products as $key => $p) {
                        $product[$key]['id'] = $p;
                        $product[$key]['quantity'] = $q[$key];
                    }
                    $packArr = array(
                        'title' => $data['title'],
                        'description' => $data['description'],
                        'price' => $data['price'],
                        'bv' => $data['bv'],
                        'products' => json_encode($product),
                        'commision' => $data['commision'],
                    );
                    $res = $this->Main_model->add('tbl_package', $packArr);
                    if ($res == TRUE) {
                        $this->session->set_flashdata('message', 'New Package Created Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Creating New Package Please Try Again ...');
                    }
                }
            }
            $this->load->view('create_package', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Edit($id) {
        if (is_admin()) {
            $response = [];
            $response['products'] = $this->Main_model->get_records('tbl_products', array(), '*');
            $response['package'] = $this->Main_model->get_single_record('tbl_package', array('id' => $id), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
//                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
//                $this->form_validation->set_rules('bv', 'BV', 'trim|required|numeric|xss_clean');
//                $this->form_validation->set_rules('description', 'description', 'trim|required|xss_clean');
//                $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
//                $this->form_validation->set_rules('commision', 'Commision', 'trim|required|xss_clean');
//                if ($this->form_validation->run() != FALSE) {
//                    pr($data);
//                    $products = implode(',', $data['product']);
                $q = $this->input->post('item_count');
                $products = $this->input->post('product');
                if (empty($product))
                    $product = array();
                else {
                    foreach ($products as $key => $p) {
                        $product[$key]['id'] = $p;
                        $product[$key]['quantity'] = $q[$key];
                    }
                }

                $packArr = array(
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'bv' => $data['bv'],
                    'products' => json_encode($product),
                    'commision' => $data['commision'],
                );
                $res = $this->Main_model->update('tbl_package', array('id' => $id), $packArr);
                if ($res) {
                    $this->session->set_flashdata('message', 'Package Updated Successfully');
                    $response['package'] = $this->Main_model->get_single_record('tbl_package', array('id' => $id), '*');
                } else {
                    $this->session->set_flashdata('message', 'Error While Updating  Package Please Try Again ...');
                }
//                }else{
//                    echo form_error();
//                    die('we are here');
//                }
            }

            $this->load->view('edit_package', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function addStock($id){
        if(is_admin()){
            if($this->input->server('REQUEST_METHOD') == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('price','Price','trim|required');
                $this->form_validation->set_rules('quantity','Quantity','trim|required');
                $this->form_validation->set_rules('batchNumber','Batch Number','trim|required');
                $this->form_validation->set_rules('buyer','Buyer name','trim|required');
                if($this->form_validation->run() != false){
                    $checkStock = $this->Main_model->get_single_record('tbl_products',['id' => $id],'quantity');
                    $formData = [
                        'quantity' => ($checkStock['quantity'] + $data['quantity']),
                        'batchNumber' => $data['batchNumber'],
                        'buyerName' => $data['buyer'],
                    ];
                    $res = $this->Main_model->update('tbl_products',['id' => $id],$formData);
                    $formData2 = [
                        'product_id' => $id,
                        'price' => $data['price'],
                        'quantity' => $data['quantity'],
                        'batchNumber' => $data['batchNumber'],
                        'buyerName' => $data['buyer'],
                    ];
                    $this->Main_model->add('tbl_stock_record',$formData2);
                    if($res){
                        $this->session->set_flashdata('message','Value updated Successfully');
                        redirect('Admin/Package/addStock/'.$id);
                    }else{
                        $this->session->set_flashdata('message','Error while updating value');
                    } 
                }
            }
           // $data = $this->Main_model->get_single_record('tbl_products',['id' => $id],'*');
            $response['field'] = [
                '1' => ['label' => 'Price','name' => 'price','type' => 'number','placeholder' => 'Enter Price' , 'id' => '','style' => '','value' => ''],
                '2' => ['label' => 'Quantity','name' => 'quantity','type' => 'number','placeholder' => 'Enter Quantity', 'id' => '','style' => '','value' => ''],
                '3' => ['label' => 'Batch Number','name' => 'batchNumber','type' => 'text','placeholder' => 'Enter Batch Number', 'id' => '','style' => '','value' => ''],
                '4' => ['label' => 'Buyer name','name' => 'buyer','type' => 'text','placeholder' => 'Enter Buyer Name', 'id' => '','style' => '','value' => ''],
            ];
            $response['submit'] = 'Update';
            $response['header'] = 'Add Stock';
            $this->load->view('form3',$response);
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function transferStock(){
        if(is_admin()){
            if($this->input->server('REQUEST_METHOD') == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id','User ID','trim|required');
                $this->form_validation->set_rules('quantity','Quantity','trim|required');
                $this->form_validation->set_rules('product','Select Product','trim|required');
                $this->form_validation->set_rules('tranxid','Transaction ID','trim|required');
                if($this->form_validation->run() != false){
                    $checkUser = $this->Main_model->get_single_record('tbl_franchise',['user_id' => $data['user_id']],'*');
                    if(!empty($checkUser)){
                        $checkProduct = $this->Main_model->get_single_record('tbl_franchise_products',['user_id' => $data['user_id'],'product_id' => $data['product']],'*');
                        $checkQuantity = $this->Main_model->get_single_record('tbl_products',['id' => $data['product']],'quantity');
                        if($checkQuantity['quantity'] >= $data['quantity']){
                            if(empty($checkProduct)){
                                $formData2 = [
                                    'user_id' => $data['user_id'],
                                    'product_id' => $data['product'],
                                    'quantity' => $data['quantity'],
                                    'tranxid' => $data['tranxid'],
                                ];
                                $res = $this->Main_model->add('tbl_franchise_products',$formData2);
                                $this->Main_model->update('tbl_products',['id' => $data['product']],['quantity' => ($checkQuantity['quantity'] - $data['quantity'])]);
                            }else{
                                $formData2 = [
                                    'quantity' => $data['quantity']+$checkProduct['quantity'],
                                    'tranxid' => ($data['tranxid'].','.$checkProduct['tranxid']),
                                ];
                                $res = $this->Main_model->update('tbl_franchise_products',['user_id' => $data['user_id'],'product_id' => $data['product']],$formData2);
                                $this->Main_model->update('tbl_products',['id' => $data['product']],['quantity' => ($checkQuantity['quantity'] - $data['quantity'])]);
                            }
                            if($res){
                                $this->session->set_flashdata('message','Stock Transfered Successfully');
                                redirect('Admin/Package/transferStock');
                            }else{
                                $this->session->set_flashdata('message','Error while Transferring stock');
                            }
                        }else{
                            $this->session->set_flashdata('message','Not enough stock to transfer');
                        } 
                    }else{
                        $this->session->set_flashdata('message','This User is not in Franchise');
                    }
                }
            }
            $response['data'] = $this->Main_model->get_records('tbl_products',[],'id,title,quantity');
            
            $response['header'] = 'Stock Transfer';
            $this->load->view('stock_transfer',$response);
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function upload_package_image() {
        if (is_admin()) {
            $response = array();
            $data = $_POST['image'];
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);

            $data = base64_decode($data);
            $imageName = 'pack' . time() . '.png';
            file_put_contents(APPPATH . '../uploads/' . $imageName, $data);
            $imageArray = array(
                'image' => $imageName,
            );
            $package_id = $this->input->post('package_id');
            $updres = $this->Main_model->update('tbl_package', array('id' => $package_id), $imageArray);
            $response['message'] = 'Image uploaed Succesffully';
            echo json_encode($response);
            exit();
        }
    }

    public function Products() {
        if (is_admin()) {
            $response['products'] = $this->Main_model->get_records('tbl_products', array(), '*');
            $this->load->view('products_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function ProductsRecord($id) {
        if (is_admin()) {
            $res['stockR'] = $this->Main_model->get_records('tbl_stock_record',['product_id' => $id], '*');
            foreach($res['stockR'] as $key1 => $sr){ 
                $res['stockR'][$key1]['product'] = $this->Main_model->get_single_record('tbl_products',['id' => $id], 'title');
            }
            $response['header'] = 'Stock Details';
            $response['thead'] = ['#','Product','Price','Stock','Batch Number','Buyer','Date'];
            $tbody = array();
            foreach($res['stockR'] as $key => $sr){ 
                $tbody[] = '<tr>
                                <td>'.($key+1).'</td>
                                <td>'.$sr['product']['title'].'</td>
                                <td>'.$sr['price'].'</td>
                                <td>'.$sr['quantity'].'</td>
                                <td>'.$sr['batchNumber'].'</td>
                                <td>'.$sr['buyerName'].'</td>
                                <td>'.$sr['created_at'].'</td>
                        </tr>'; 
            }
            $response['tbody'] = $tbody; 
            //pr($response,true);       
            $this->load->view('table', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function CreateProduct() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
                $this->form_validation->set_rules('bv', 'BV', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('mrp', 'MRP', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('dp', 'DP', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('type', 'Available In', 'trim|required|xss_clean');
                $this->form_validation->set_rules('discount', 'Discount', 'trim|required|xss_clean');
                //$this->form_validation->set_rules('sgst', 'SGST', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
                $this->form_validation->set_rules('category', 'Category', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $data = $this->security->xss_clean($this->input->post());
                    $productArr = array(
                        'category_id' => $data['category'],
                        'title' => $data['title'],
                        'bv' => $data['bv'],
                        'mrp' => $data['mrp'],
                        'dp' => $data['dp'],
                        'type' => $data['type'],
                        'status' => $data['vegtype'],
                        'category_type' => $data['category_type'],
                        'discount' => $data['discount'],
                        //'sgst' => $data['sgst'],
                        'description' => $data['description'],
                    );
                    $res = $this->Main_model->add('tbl_products', $productArr);
                    if ($res) {
                        $this->session->set_flashdata('message', 'New Product Created Successfully');
                        redirect('Admin/Package/EditProduct/' . $res);
                    } else {
                        $this->session->set_flashdata('message', 'Error While Creating New Product   Please Try Again ...');
                    }
                }
            }
            $response['category'] = $this->Main_model->get_records('tbl_category',[],'*');
            $this->load->view('create_product', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function EditProduct($id) {
        if (is_admin()) {
            $response = array();
            $response['product'] = $this->Main_model->get_single_record('tbl_products', array('id' => $id), '*');
            $response['product_images'] = $this->Main_model->get_records('tbl_product_images', array('product_id' => $id), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
                $this->form_validation->set_rules('type', 'Available In', 'trim|required|xss_clean');
                $this->form_validation->set_rules('mrp', 'MRP', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('discount', 'Discount', 'trim|required|xss_clean');
                // $this->form_validation->set_rules('retail_price', 'Retail Price', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('description', 'description', 'trim|required|xss_clean');
                $this->form_validation->set_rules('dp', 'DP', 'trim|required|xss_clean');
                $this->form_validation->set_rules('bv', 'BV', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $data = $this->security->xss_clean($this->input->post());
                    $productArr = array(
                        'title' => $data['title'],
                        'type' => $data['type'],
                        'mrp' => $data['mrp'],
                        'dp' => $data['dp'],
                        'bv' => $data['bv'],
                        'description' => $data['description'],
                        'status' => $data['vegtype'],
                        'category_type' => $data['category_type'],
                        'discount' => $data['discount'],
                        //'hsn' => $data['hsn'],
                    );
                    $res = $this->Main_model->update('tbl_products', array('id' => $id), $productArr);
                    if ($res) {
                        $this->session->set_flashdata('message', 'Product Updated Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Updating Product Please Try Again ...');
                    }
                }else{
                    $this->session->set_flashdata('message' , validation_errors());
                }
            }
            $response['product'] = $this->Main_model->get_single_record('tbl_products', array('id' => $id), '*');
            $response['category'] = $this->Main_model->get_single_record('tbl_category',['id' => $response['product']['category_id']],'category_name');

            $this->load->view('edit_product', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function upload_product_image($id) {
        if (is_admin()) {
            $response = array();
            $response['success'] = 0;
            $response['token_name'] = $this->security->get_csrf_token_name();
            $response['token_value'] = $this->security->get_csrf_hash();
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
            $config['file_name'] = 'payment_slip'.time();
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userfile')) {
                $response['message'] =  $this->upload->display_errors();
            }else{
                $fileData = array('upload_data' => $this->upload->data());
                $imageArray['product_id'] = $id;
                $imageArray['image'] = $fileData['upload_data']['file_name'];
                $updres = $this->Main_model->add('tbl_product_images', $imageArray);
                $response['message'] = 'Image uploaed Succesffully';
                $response['success'] = 1;
            }
            
            echo json_encode($response);
            exit();
        }
    }

    public function DeleteProduct($id) {
        if (is_admin()) {
            $product = $this->Main_model->get_single_record('tbl_products', array('id' => $id), '*');
            if (!empty($product)) {
                $res = $this->Main_model->delete('tbl_products', $id);
                if ($res) {
                    $this->session->set_flashdata('message', 'Product Deleted Successfully');
                } else {
                    $this->session->set_flashdata('message', 'Error While Deleting Product   Please Try Again ...');
                }
            } else {
                $this->session->set_flashdata('message', 'No Product Found');
            }
            redirect('Admin/Package/Products');
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function delete_product_image($product_id, $id) {
        if (is_admin()) {
            $product = $this->Main_model->get_single_record('tbl_product_images', array('id' => $id), '*');
            if (!empty($product)) {
//                PR('file://'.$_SERVER['DOCUMENT_ROOT'].$product['image']);
//                unlink('file://' . $_SERVER['DOCUMENT_ROOT'] . $product['image']);
//                unlink(APPPATH('uploads/' . $product['image']));
                $res = $this->Main_model->delete('tbl_product_images', $id);
                if ($res) {
                    $this->session->set_flashdata('message', 'Product Image Deleted Successfully');
                } else {
                    $this->session->set_flashdata('message', 'Error While Deleting Product image  Please Try Again ...');
                }
            } else {
                $this->session->set_flashdata('message', 'No Image Found');
            }
            redirect('Admin/Package/EditProduct/' . $product_id);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Tax() {
        if (is_admin()) {
            $response['tax'] = $this->Main_model->get_single_record('tbl_tax', array('id' => 1), '*');
            $this->form_validation->set_rules('tax', 'Tax', 'trim|required|numeric|xss_clean');
            if ($this->form_validation->run() != FALSE) {
                $data = $this->security->xss_clean($this->input->post());
                $res = $this->Main_model->update('tbl_tax', array('id' => 1), array('tax' => $data['tax']));
                if ($res) {
                    $this->session->set_flashdata('message', 'Tax Updated Successfully');
                    $response['tax'] = $this->Main_model->get_single_record('tbl_tax', array('id' => 1), '*');
                } else {
                    $this->session->set_flashdata('message', 'Error While Updating  Tax Please Try Again ...');
                }
            }
            $this->load->view('tax', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

}
