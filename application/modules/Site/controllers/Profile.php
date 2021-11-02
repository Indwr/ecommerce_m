<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('site'));
    }

    public function index(){
        if(is_logged_in()){
            $users = $this->Main_model->get_single_record('tbl_users',['email' => $this->session->userdata['user_id']],'name,phone,password');
            $response['editFrom'] = '<div class="form-group">
                                        <label >Name</label>
                                        <input type="text" name="name" value="'.$users['name'].'" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="'.$users['phone'].'" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>';
            $response['passwordFrom'] = '<div class="form-group">
                                        <label>Current Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" name="npassword" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="cpassword" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>';
            $response['header'] = 'Profile Management';
            $this->load->view('form',$response);
        }else{
            redirect('Site/Main/login');
        }
    }

    public function editProfile(){
        if(is_logged_in()){
            if($this->input->server('REQUEST_METHOD') == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('name','Name','trim|required');
                $this->form_validation->set_rules('phone','Phone','trim|required');
                if($this->form_validation->run() != false){
                    $res = $this->Main_model->update('tbl_users',['email' => $this->session->userdata['user_id']],['name' => $data['name'],'phone' => $data['phone']]);
                    if($res){
                        $this->session->set_flashdata('message','Details are updated successfully');
                        redirect('Site/Profile');
                    }else{
                        $this->session->set_flashdata('message','error while updating details');
                        redirect('Site/Profile');
                    }
                }
            }
            redirect('Site/Profile');
        }else{
            redirect('Site/Main/login');
        }
    }

    public function changePassword(){
        if(is_logged_in()){
            if($this->input->server('REQUEST_METHOD') == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('password','Current Password','trim|required');
                $this->form_validation->set_rules('npassword','New Password','trim|required');
                $this->form_validation->set_rules('cpassword','Confirm Password','trim|required');
                if($this->form_validation->run() != false){
                    $checkPassword = $this->Main_model->get_single_record('tbl_users',['email' => $this->session->userdata['user_id']],'password');
                    if($checkPassword['password'] == $data['password']){
                        if($data['npassword'] == $data['cpassword']){
                            $res = $this->Main_model->update('tbl_users',['email' => $this->session->userdata['user_id']],['password' => $data['npassword']]);
                            if($res){
                                $this->session->set_flashdata('message1','Password changed successfully');
                                redirect('Site/Profile');
                            }else{
                                $this->session->set_flashdata('message1','error while changing password');
                                redirect('Site/Profile');
                            }
                        }else{
                            $this->session->set_flashdata('message1','New Password and Confirm Password not matched');
                            redirect('Site/Profile');
                        }
                    }else{
                        $this->session->set_flashdata('message1','Old Password is not matched');
                        redirect('Site/Profile');
                    }
                }else{
                    $this->session->set_flashdata('message1',validation_errors());
                    redirect('Site/Profile');
                }
            }
            redirect('Site/Profile');
        }else{
            redirect('Site/Main/login');
        }
    }
}

?>