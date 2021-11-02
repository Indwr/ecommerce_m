<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index() {
        if (is_admin()) {
            $response = array();
            $response['tasks'] = $this->Main_model->get_records('tbl_task_links', array(), '*');
            $this->load->view('task_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function Create() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('link', 'Link', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $tasks = $this->Main_model->get_single_record('tbl_task_links', array(), 'ifnull(count(id),0)  as total_links');
                    if($tasks['total_links'] < 15){
                        $TaskData = array(
                            'link' => $data['link'],
                        );
                        $this->Main_model->add('tbl_task_links', $TaskData);
                        $this->session->set_flashdata('message', 'Task Created Successfully');
                    }else{
                        $this->session->set_flashdata('message', '15 Tasks Already Created');
                    }
                }
            }
            $this->load->view('create_task', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function Edit($task_id) {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('link', 'Link', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $updtask =  $updres = $this->Main_model->update('tbl_task_links', array('id' => $task_id), array('link' => $data['link']));
                    if ($updres == true) {
                        $this->session->set_flashdata('message', 'Task Updated Successfully');
                    }else{
                        $this->session->set_flashdata('message', 'Error while Updating Task');
                    }
                }
            }
            $response['task'] = $this->Main_model->get_single_record('tbl_task_links', array('id' => $task_id), '*');
            $this->load->view('edit_task', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function icardRequests($status = '') {
        if (is_admin()) {
            if($status == ''){
                $where = array();
            }else{
                $where = array('status' => $status);
            }
            $response['requests'] = $this->Main_model->get_records('tbl_visiting_cards', $where, '*');
            $this->load->view('card_request', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function update_request($status="",$id="") {
        if (is_admin()) {
            $check = $this->Main_model->get_single_record('tbl_visiting_cards',['id' => $id],'*');
            if(!empty($check)){
                if($check['status'] == 0){
                    $res = $this->Main_model->update('tbl_visiting_cards',['id' => $id],['status' => $status]);
                    if($res){
                        $this->session->set_flashdata('message','Request successfully processed');
                        redirect('Admin/Task/icardRequests/0');
                    }else{
                        $this->session->set_flashdata('message','Network error,Please try later');
                        redirect('Admin/Task/icardRequests/0');
                    }
                }else{
                    $this->session->set_flashdata('message','This is already approved');
                    redirect('Admin/Task/icardRequests/0');
                }
            }else{
                $this->session->set_flashdata('message','Record does not exists');
                redirect('Admin/Task/icardRequests/0');
            }
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function createAchiever(){
        if(is_admin()){
            if(is_admin()){
                if($this->input->server('REQUEST_METHOD') == "POST"){
                    $data = $this->security->xss_clean($this->input->post());
                    $this->form_validation->set_rules('user_id','User ID','trim|required');
                    if($this->form_validation->run() != false){
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = 40000;
                        $config['file_name'] = 'achiever'.time();
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('image')) {
                            $this->session->set_flashdata('message',$this->upload->display_errors());
                        }else{
                            $fileData = array('upload_data' => $this->upload->data());
                            $formData = [
                                'user_id' => $data['user_id'],
                                'image' => $fileData['upload_data']['file_name'],
                            ];
                            $res = $this->Main_model->add('tbl_achievers',$formData);
                            if($res){
                                $this->session->set_flashdata('message','Achiever Created Successfully');
                                redirect('Admin/Task/createAchiever');
                            }else{
                                $this->session->set_flashdata('message','Error while creating Achiever');
                            }
                        }
                    }
                }
                $response['field'] = [
                    '1' => ['label' => 'User ID','name' => 'user_id','type' => 'text','placeholder' => 'Enter User ID', 'id' => '','style' => ''],
                    '2' => ['label' => 'Achiever Image','name' => 'image','type' => 'file','placeholder' => '', 'id' => '','style' => ''],
                ];
                $response['submit'] = 'Create Achiever';
                $response['header'] = 'Create Achiever';
                $Record = $this->Main_model->get_records('tbl_achievers',[],'*');
                $tbody = array();
                foreach($Record as $key => $r){
                    $file = '<img src='.base_url("uploads/".$r['image']).'>';
                    $tbody[$key] = '<tr>
                                        <td>'.($key+1).'</td>
                                        <td>'.$r['user_id'].'</td>
                                        <td>'.$file.'</td>
                                        <td>'.$r['created_at'].'</td>
                                        <td><a href='.base_url("Admin/Task/deleteAchiever/".$r['id']).'>Delete</a></td>
                                    </tr>';
                }
                $response['thead'] = ['#','Achiever ID','Image','Date','Action'];
                $response['tbody'] = $tbody;
                $this->load->view('form2',$response);
            }else{
                redirect('Admin/Management/login');
            }
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function deleteAchiever($id){
        if(is_admin()){
            $this->Main_model->delete('tbl_achievers',$id);
            redirect('Admin/Task/createAchiever');
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function createImgVid(){
        if(is_admin()){
            if($this->input->server('REQUEST_METHOD') == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('fileType','File Type','trim|required');
                if($this->form_validation->run() != false){
                    if($data['fileType'] == 1){
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = 40000;
                        $config['file_name'] = 'imgvid'.time();
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('media')) {
                            $this->session->set_flashdata('message',$this->upload->display_errors());
                        }else{
                            $fileData = array('upload_data' => $this->upload->data());
                            $formData = [
                                'media' => $fileData['upload_data']['file_name'],
                                'status' => 1,
                            ];
                            $res = $this->Main_model->add('tbl_img_vid',$formData);
                            if($res){
                                $this->session->set_flashdata('message','Image added Successfully');
                                redirect('Admin/Task/createImgVid');
                            }else{
                                $this->session->set_flashdata('message','Error while adding Image');
                            }
                        }
                    }else{
                        $formData = [
                            'media' => $data['media'],
                            'status' => 2,
                        ];
                        $res = $this->Main_model->add('tbl_img_vid',$formData);
                        if($res){
                            $this->session->set_flashdata('message','Video uploaded Successfully');
                            redirect('Admin/Task/createImgVid');
                        }else{
                            $this->session->set_flashdata('message','Error while uploading Video');
                        }
                    }
                }
            }
            $response['field'] = [
                '1' => ['label' => 'File','name' => 'media','type' => 'file','placeholder' => '' , 'id' => 'file','style' => ''],
                '2' => ['label' => 'File','name' => 'media','type' => 'text','placeholder' => 'Paste Your Link', 'id' => 'link','style' => 'display:none']
            ];
            $response['select'] = '<div class="form-group">
                                    <label>File Type</label>
                                    <select name="fileType" class="form-control" onchange="loadDoc()" id="selectval">
                                        <option value="1">Image</option>
                                        <option value="2">Video</option>
                                    </select>
                                    </div>';
            $response['submit'] = 'Create';
            $response['header'] = 'Create File';
            $Record = $this->Main_model->get_records('tbl_img_vid',[],'*');
            $tbody = array();
            foreach($Record as $key => $r){
                if($r['status'] == 1){
                    $file = '<img src='.base_url("uploads/".$r['media']).'>';
                }elseif($r['status'] == 2){
                    $file = '<iframe src="https://www.youtube.com/embed/'.$r['media'].'"></iframe>';
                }
                $tbody[$key] = '<tr>
                                    <td>'.($key+1).'</td>
                                    <td>'.$file.'</td>
                                    <td>'.$r['created_at'].'</td>
                                    <td><a href='.base_url("Admin/Task/removefile/".$r['id']).'>Delete</a></td>
                                </tr>';
            }
            $response['thead'] = ['#','File','Date','Action'];
            $response['tbody'] = $tbody;
            $this->load->view('form2',$response);
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function removefile($id){
        if(is_admin()){
            $this->Main_model->delete('tbl_img_vid',$id);
            redirect('Admin/Task/createImgVid');
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function createFranchise(){
        if(is_admin()){
            if($this->input->server('REQUEST_METHOD') == 'POST'){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id','User ID','xss_clean|required|trim' );
                $this->form_validation->set_rules('franchise_type','Franchise Type','xss_clean|required|trim' );
                $this->form_validation->set_rules('name','Name','xss_clean|required|trim' );
                $this->form_validation->set_rules('address','Address','xss_clean|required|trim' );
                $this->form_validation->set_rules('city','City','xss_clean|required|trim' );
                $this->form_validation->set_rules('state','State','xss_clean|required|trim' );
                $this->form_validation->set_rules('code','Code','xss_clean|required|trim' );
                if($this->form_validation->run() != FALSE){
                    $checkUser = $this->Main_model->get_single_record('tbl_users',['user_id' => $data['user_id']],'*');
                    if(!empty($checkUser)){
                        $checkfranchise = $this->Main_model->get_single_record('tbl_franchise',['user_id' => $data['user_id']],'*');
                        if(empty($checkfranchise)){
                            $userData =[
                                'user_id' => $data['user_id'],
                                'franchise_type' => $data['franchise_type'],
                                'name' => $data['name'],
                                'address' => $data['address'], 
                                'city' => $data['city'],
                                'state' => $data['state'] ,
                                'code' => $data['code']
                            ];
                            $res = $this->Main_model->add('tbl_franchise',$userData);
                            if($res){
                                $this->session->set_flashdata('message','Franchise created successfully');
                            }else{
                                $this->session->set_flashdata('message','Error while creating Franchise');
                            }
                        }else{
                            $this->session->set_flashdata('message','This User ID already Franchise');
                        }
                    }else{
                        $this->session->set_flashdata('message','Please choose a valid User ID');
                    }
                }
            }

            $response['field'] = [
                '1' => ['label' => 'User ID','name' => 'user_id','type' => 'text','placeholder' => 'Enter User ID' , 'id' => '','style' => ''],
                '2' => ['label' => 'Franchise Type','name' => 'franchise_type','type' => 'text','placeholder' => 'Enter Franchise Type' , 'id' => '','style' => ''],
                '3' => ['label' => 'Name','name' => 'name','type' => 'text','placeholder' => 'Enter Your Name', 'id' => '','style' => ''],
                '4' => ['label' => 'Address','name' => 'address','type' => 'text','placeholder' => 'Enter Your Address', 'id' => '','style' => ''],
                '5' => ['label' => 'City','name' => 'city','type' => 'text','placeholder' => 'Enter Your City', 'id' => '','style' => ''],
                '6' => ['label' => 'State','name' => 'state','type' => 'text','placeholder' => 'Enter Your State', 'id' => '','style' => ''],
                '7' => ['label' => 'Code','name' => 'code','type' => 'text','placeholder' => 'Enter Your Pin Code', 'id' => '','style' => ''],
            ];
            $response['submit'] = 'Create';
            $response['header'] = 'Create Franchise';
            $Record = $this->Main_model->get_records('tbl_franchise',[],'*');
            $tbody = array();
            foreach($Record as $key => $r){
                $tbody[$key] = '<tr>
                                    <td>'.($key+1).'</td>
                                    <td>'.$r['user_id'].'</td>
                                    <td>'.$r['franchise_type'].'</td>
                                    <td>'.$r['name'].'</td>
                                    <td>'.$r['address'].'</td>
                                    <td>'.$r['city'].'</td>
                                    <td>'.$r['state'].'</td>
                                    <td>'.$r['code'].'</td>
                                    <td>'.$r['created_at'].'</td>
                                    <td><a href='.base_url("Admin/Task/deleteFranchise/".$r['id']).'>Delete</a></td>
                                </tr>';
            }
            $response['thead'] = ['#','User ID','Franchise Type','Name','Address','City','State','Code','Date','Action'];
            $response['tbody'] = $tbody;
            $this->load->view('form2',$response);
        }else{
            redirect('Admin/Management/login');
        }
    }
    
    public function deleteFranchise($id){
        if(is_admin()){
            $this->Main_model->delete('tbl_franchise',$id);
            redirect('Admin/Task/createFranchise');
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function sliderFirst(){
        if(is_admin()){
            if(is_admin()){
                if($this->input->server('REQUEST_METHOD') == "POST"){
                    $data = $this->security->xss_clean($this->input->post());
                    $this->form_validation->set_rules('fileType','File Type','trim|required');
                    if($this->form_validation->run() != false){
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = 40000;
                        $config['file_name'] = 'sliderF'.time();
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('image')) {
                            $this->session->set_flashdata('message',$this->upload->display_errors());
                        }else{
                            $fileData = array('upload_data' => $this->upload->data());
                            $formData = [
                                'image' => $fileData['upload_data']['file_name'],
                            ];
                            $res = $this->Main_model->add('tbl_slider_first',$formData);
                            if($res){
                                $this->session->set_flashdata('message','Image added Successfully');
                                redirect('Admin/Task/sliderFirst');
                            }else{
                                $this->session->set_flashdata('message','Error while adding Image');
                            }
                        }
                    }
                }
                $response['field'] = [
                    '1' => ['label' => 'File','name' => 'image','type' => 'file','placeholder' => '' , 'id' => '','style' => ''],
                ];
                $response['select'] = '<div class="form-group">
                                        <label>File Type</label>
                                        <select name="fileType" class="form-control">
                                            <option value="1">Image</option>
                                        </select>
                                        </div>';
                $response['submit'] = 'Upload';
                $response['header'] = 'Upload Slider First Image';
                $Record = $this->Main_model->get_records('tbl_slider_first',[],'*');
                $tbody = array();
                foreach($Record as $key => $r){
                    $file = '<img src='.base_url("uploads/".$r['image']).' height="200px" widht="200px">';
                    $tbody[$key] = '<tr>
                                        <td>'.($key+1).'</td>
                                        <td>'.$file.'</td>
                                        <td>'.$r['created_at'].'</td>
                                        <td><a href='.base_url("Admin/Task/deleteSliderFirst/".$r['id']).'>Delete</a></td>
                                    </tr>';
                }
                $response['thead'] = ['#','File','Date','Action'];
                $response['tbody'] = $tbody;
                $this->load->view('form2',$response);
            }else{
                redirect('Admin/Management/login');
            }
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function deleteSliderFirst($id){
        if(is_admin()){
            $this->Main_model->delete('tbl_slider_first',$id);
            redirect('Admin/Task/sliderFirst');
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function sliderSecond(){
        if(is_admin()){
            if(is_admin()){
                if($this->input->server('REQUEST_METHOD') == "POST"){
                    $data = $this->security->xss_clean($this->input->post());
                    $this->form_validation->set_rules('fileType','File Type','trim|required');
                    if($this->form_validation->run() != false){
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = 1024;
                        $config['file_name'] = 'sliderS'.time();
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('image')) {
                            $this->session->set_flashdata('message',$this->upload->display_errors());
                        }else{
                            $fileData = array('upload_data' => $this->upload->data());
                            $formData = [
                                'image' => $fileData['upload_data']['file_name'],
                            ];
                            $res = $this->Main_model->add('tbl_slider_second',$formData);
                            if($res){
                                $this->session->set_flashdata('message','Image added Successfully');
                                redirect('Admin/Task/sliderSecond');
                            }else{
                                $this->session->set_flashdata('message','Error while adding Image');
                            }
                        }
                    }
                }
                $response['field'] = [
                    '1' => ['label' => 'File','name' => 'image','type' => 'file','placeholder' => '' , 'id' => '','style' => ''],
                ];
                $response['select'] = '<div class="form-group">
                                        <label>File Type</label>
                                        <select name="fileType" class="form-control">
                                            <option value="1">Image</option>
                                        </select>
                                        </div>';
                $response['submit'] = 'Upload';
                $response['header'] = 'Upload Slider Middel Image';
                $Record = $this->Main_model->get_records('tbl_slider_second',[],'*');
                $tbody = array();
                foreach($Record as $key => $r){
                    $file = '<img src='.base_url("uploads/".$r['image']).' height="200px" widht="200px">';
                    $tbody[$key] = '<tr>
                                        <td>'.($key+1).'</td>
                                        <td>'.$file.'</td>
                                        <td>'.$r['created_at'].'</td>
                                        <td><a href='.base_url("Admin/Task/deleteSliderSecond/".$r['id']).'>Delete</a></td>
                                    </tr>';
                }
                $response['thead'] = ['#','File','Date','Action'];
                $response['tbody'] = $tbody;
                $this->load->view('form2',$response);
            }else{
                redirect('Admin/Management/login');
            }
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function deleteSliderSecond($id){
        if(is_admin()){
            $this->Main_model->delete('tbl_slider_second',$id);
            redirect('Admin/Task/sliderSecond');
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function socialLinks(){
        if(is_admin()){
            if(is_admin()){
                if($this->input->server('REQUEST_METHOD') == "POST"){
                    $data = $this->security->xss_clean($this->input->post());
                    $this->form_validation->set_rules('link','Link','trim|required');
                    $this->form_validation->set_rules('title','Title','trim|required');
                    if($this->form_validation->run() != false){                        
                        $formData = [
                            'title' => $data['title'],
                            'link' => $data['link'],
                        ];
                        $res = $this->Main_model->add('tbl_social_link',$formData);
                        if($res){
                            $this->session->set_flashdata('message','Link added Successfully');
                            redirect('Admin/Task/socialLinks');
                        }else{
                            $this->session->set_flashdata('message','Error while adding link');
                        }
                    }
                }
                $response['field'] = [
                    '1' => ['label' => 'Title','name' => 'title','type' => 'text','placeholder' => 'Enter Title' , 'id' => '','style' => ''],
                    '2' => ['label' => 'Link','name' => 'link','type' => 'link','placeholder' => 'Enter Link' , 'id' => '','style' => ''],
                ];
                $response['submit'] = 'Add Link';
                $response['header'] = 'Update Social Links';
                $Record = $this->Main_model->get_records('tbl_social_link',[],'*');
                $tbody = array();
                foreach($Record as $key => $r){
                    $tbody[$key] = '<tr>
                                        <td>'.($key+1).'</td>
                                        <td>'.$r['title'].'</td>
                                        <td>'.$r['link'].'</td>
                                        <td>'.$r['created_at'].'</td>
                                        <td><a href='.base_url("Admin/Task/removeSocialLinks/".$r['id']).'>Delete</a></td>
                                    </tr>';
                }
                $response['thead'] = ['#','Title','Links','Date','Action'];
                $response['tbody'] = $tbody;
                $this->load->view('form2',$response);
            }else{
                redirect('Admin/Management/login');
            }
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function removeSocialLinks($id){
        if(is_admin()){
            $this->Main_model->delete('tbl_social_link',$id);
            redirect('Admin/Task/socialLinks');
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function uploadPDF(){
        if(is_admin()){
            if(is_admin()){
                if($this->input->server('REQUEST_METHOD') == "POST"){
                    $data = $this->security->xss_clean($this->input->post());
                    $this->form_validation->set_rules('phone','Phone','trim|required');
                    $this->form_validation->set_rules('email','Email','trim|required');
                    $this->form_validation->set_rules('content','Content','trim|required');
                    if($this->form_validation->run() != false){
                        if($_FILES['image']['error'] == 0){
                            $config['upload_path'] = './uploads/';
                            $config['allowed_types'] = 'pdf';
                            $config['max_size'] = 1024;
                            $config['file_name'] = 'pdf'.time();
                            $this->load->library('upload', $config);
                            if (!$this->upload->do_upload('image')) {
                                $this->session->set_flashdata('message',$this->upload->display_errors());
                            }else{
                                $fileData = array('upload_data' => $this->upload->data());
                                $formData = [
                                    'pdf' => $fileData['upload_data']['file_name'],
                                    'phone' => $data['phone'],
                                    'email' => $data['email'],
                                    'content' => $data['content'],
                                    'news' => $data['news'],
                                    'company_profile' => $data['company_profile'],
                                    'bank_details' => $data['bank_details'],
                                    'legal' => $data['legal'],
                                ];
                                $res = $this->Main_model->update('tbl_site_content',['id' => '1'],$formData);
                                if($res){
                                    $this->session->set_flashdata('message','Data Updated Successfully');
                                    redirect('Admin/Task/uploadPDF');
                                }else{
                                    $this->session->set_flashdata('message','Error while updating data');
                                }
                            }
                        }else{
                            $formData = [
                                'phone' => $data['phone'],
                                'email' => $data['email'],
                                'content' => $data['content'],
                                'news' => $data['news'],
                                'company_profile' => $data['company_profile'],
                                'bank_details' => $data['bank_details'],
                                'legal' => $data['legal'],
                            ];
                            $res = $this->Main_model->update('tbl_site_content',['id' => '1'],$formData);
                            if($res){
                                $this->session->set_flashdata('message','Data Updated Successfully');
                                redirect('Admin/Task/uploadPDF');
                            }else{
                                $this->session->set_flashdata('message','Error while updating data');
                            }
                        }
                    }
                }
                $Record = $this->Main_model->get_single_record('tbl_site_content',['id' => '1'],'*');

                $response['field'] = [
                    '1' => ['label' => 'File','name' => 'image','type' => 'file','placeholder' => '' , 'id' => '','style' => '' , 'value' => ''],
                    '2' => ['label' => 'Phone','name' => 'phone','type' => 'text','placeholder' => 'Enter Phone Number' , 'id' => '','style' => '','value' => $Record['phone']],
                    '3' => ['label' => 'Email','name' => 'email','type' => 'email','placeholder' => 'Enter Email Address' , 'id' => '','style' => '', 'value' => $Record['email']],
                ];
                $response['textarea'] = '<label>Content</label><textarea id="long_desc" class="form-control" style="border: 1px solid black;" name="content">'.$Record['content'].'</textarea>';
                $response['textarea1'] = '<label>News</label><textarea id="long_desc1" class="form-control" style="border: 1px solid black;" name="news">'.$Record['news'].'</textarea>';
                $response['textarea2'] = '<label>Company Profile</label><textarea id="long_desc2" class="form-control" style="border: 1px solid black;" name="company_profile">'.$Record['company_profile'].'</textarea>';
                $response['textarea3'] = '<label>Bank Details</label><textarea id="long_desc3" class="form-control" style="border: 1px solid black;" name="bank_details">'.$Record['bank_details'].'</textarea>';
                $response['textarea4'] = '<label>Legal</label><textarea id="long_desc4" class="form-control" style="border: 1px solid black;" name="legal">'.$Record['legal'].'</textarea>';
                $response['submit'] = 'Update';
                $response['header'] = 'Site Management';
                
                $tbody = array();
                //foreach($Record as $key => $r){
                    if(!empty($Record['pdf'])){
                        $file = '<iframe src='.base_url("uploads/".$Record['pdf']).' height="200px" widht="200px"></iframe>';
                    }else{
                        $file = 'No Pdf Uploaded';
                    }
                    $tbody[] = '<tr>
                                        <td>1</td>
                                        <td>'.$file.'</td>
                                        <td>'.$Record['phone'].'</td>
                                        <td>'.$Record['email'].'</td>
                                    </tr>';
                //}
                $response['thead'] = ['#','PDF','Phone','Email'];
                $response['tbody'] = $tbody;
                $this->load->view('form2',$response);
            }else{
                redirect('Admin/Management/login');
            }
        }else{
            redirect('Admin/Management/login');
        }
    }

}