<?php
class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

	public function index(){
        $this->form_validation->set_rules('username','username','required');
        $this->form_validation->set_rules('password','password','required');
        if($this->form_validation->run()){
            $data = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
            ];
            if($this->datawork->check_data('admin',$data)){
                $this->session->set_userdata('admin',$_POST['username']);
                // set flash to trigger admin post-login effect once
                $this->session->set_flashdata('just_logged_in_admin', 'Welcome Admin');
                redirect('admin/index');
            }
            else{
                $this->session->set_flashdata("error","<div class='alert alert-danger'><i class='fas fa-times text-danger'></i>&nbsp; Oops! Incorrect Username or Password</div>");
                redirect("home/index");
            }
        }
		else{
            $this->load->view('home/index');
        }
	}
}
