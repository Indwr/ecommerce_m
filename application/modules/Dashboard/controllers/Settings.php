<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Shopping_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index() {
        if (is_logged_in()) {
            $response['products'] = $this->Shopping_model->get_product();
            $this->load->view('Shopping/products', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function idcard(){
    	if(is_logged_in()){
       		 $this->load->view('id_card');
       	}else{
       		redirect('Dashboard/User/login');
       	}	 
    }

    public function visitingcard(){
    	if(is_logged_in()){
	    	$data['data'] = $this->Shopping_model->get_single_record('tbl_users',array('user_id' => $this->session->userdata('user_id')),'*');
	    	$data['city'] = $this->Shopping_model->get_single_record('cities',array('id' => $data['data']['city']),'name');
	    	$data['state'] = $this->Shopping_model->get_single_record('states',array('id' => $data['data']['state']),'name');
	    	$data['country'] = $this->Shopping_model->get_single_record('countries',array('id' => $data['data']['country']),'name');
	    	
	         $this->load->view('visiting_card',$data);
	    }else{
	    	redirect('Dashboard/User/login');
	    }    
    }

    public function reward(){
        if(is_logged_in()){
	    	$data['user'] = $this->Shopping_model->get_single_record('tbl_users',array('user_id' => $this->session->userdata('user_id')),'leftPower,rightPower');
	        $this->load->view('rewardTable',$data);
	    }else{
	    	redirect('Dashboard/User/login');
	    }    
    }

    public function createAdvertisement(){
        if(is_logged_in()){
	    	if($this->input->server('REQUEST_METHOD') == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('name','Name','trim|required');
                $this->form_validation->set_rules('city','City','trim|required');
                $this->form_validation->set_rules('state','State','trim|required');
                if($this->form_validation->run() != false){
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name'] = 'idcard'.time();
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('userfile')) {
                        $this->session->set_flashdata('message', $this->upload->display_errors());
                    }else{
                        $fileData = array('upload_data' => $this->upload->data());
                        $userData = [
                            'user_id' => $this->session->userdata['user_id'],
                            'name' => $data['name'],
                            'city' => $data['city'],
                            'state' => $data['state'],
                            'image' => $fileData['upload_data']['file_name'],
                        ];
                        $res = $this->Shopping_model->add('tbl_visiting_cards',$userData);
                        if($res){
                            $this->session->set_flashdata('message','Request Submitted,Pending for approval');
                        }else{
                            $this->session->set_flashdata('message','Network error,Please try later');
                        }
                    }
                }
            }
	        $this->load->view('createIDCard');
	    }else{
	    	redirect('Dashboard/User/login');
	    }    
    }

    public function Advertisement(){
        if(is_logged_in()){
            $response['users'] = $this->Shopping_model->get_records('tbl_visiting_cards',['status' => 1],'*');
            $this->load->view('view_advertisement',$response);
        }else{
            redirect('Dashboard/User/login');
        }   
    }

    public function socialLink(){
        if(is_logged_in()){
            $response['links'] = $this->Shopping_model->get_records('tbl_social_link',[],'*');
            $response['header'] = 'Social Media Link';
            $this->load->view('view_links',$response);
        }else{
            redirect('Dashboard/User/login');
        }   
    }
}
