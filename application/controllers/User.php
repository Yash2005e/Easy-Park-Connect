<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Datawork');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(['url', 'form']);
    }

    public function login() {
        if($this->session->userdata('user_logged_in')) {
            redirect('user/map');
        }
        $this->load->view('user/login');
    }

    public function register() {
        $this->load->view('user/register');
    }

    public function do_register() {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if($this->form_validation->run() === FALSE) {
            $this->load->view('user/register');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            );

            if($this->Datawork->insert_user($data)) {
                $this->session->set_flashdata('success', 'Registration successful! Please login.');
                redirect('user/login');
            } else {
                $this->session->set_flashdata('error', 'Registration failed! Please try again.');
                redirect('user/register');
            }
        }
    }

    public function auth() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Datawork->check_user_login($username, $password);

        if($user) {
            $session_data = array(
                'user_logged_in' => true,
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_username' => $user->username
            );
            $this->session->set_userdata($session_data);
            // flash flag to trigger post-login sound/visual once on next page
            $this->session->set_flashdata('just_logged_in_user', 'Welcome ' . $user->name);
            redirect('user/map');
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('user/login');
        }
    }


    public function parking_map()
{
    $this->load->view('user/map');
}


    public function map() {
        if(!$this->session->userdata('user_logged_in')) {
            redirect('user/login');
        }
        
        // Load parking data from database
        $this->load->model('Datawork');
        $data['parking_areas'] = $this->datawork->calling_data('category');
        $data['vehicles'] = $this->datawork->calling_data('add_vehicle');
        
        $this->load->view('user/map', $data);
    }

    public function logout() {
        $this->session->unset_userdata('user_logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_username');
        redirect('user/login');
    }
}