<?php
class Admin Extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin')){
			redirect('home/index');
		}
        else{
            $data['test'] = $this->datawork->calling_data('add_vehicle');
            foreach ($data['test'] as $t){
                $date_on_record = date_create($t->arrival_time);
                $date_now = date_create(date('y-m-d'));
                $days = date_diff($date_on_record,$date_now);
                if($days->format("%a")>=31){
                    $this->datawork->delete_data('add_vehicle',['id'=>$t->id]);
                }
            }
        }
	}
    public function logout(){
		$this->session->unset_userdata('admin');
		redirect('home/index');
	}
    
    public function index(){
        $data['user'] = $this->datawork->calling_data('admin');
        $data['add_vehicle'] = $this->datawork->calling_data('add_vehicle');
        $this->load->view('admin/dashboard',$data);
    }
    public function category(){
        $this->form_validation->set_rules('parking_area_no','parking_area_no','required');
        $this->form_validation->set_rules('vehicle_type','vehicle_type','required');
        $this->form_validation->set_rules('parking_charge','parking_charge','required');
        $this->form_validation->set_rules('vehicle_limit','vehicle_limit','required');
        if($this->form_validation->run()){
            $data = [
                'parking_area_no' => $_POST['parking_area_no'],
                'vehicle_type' => $_POST['vehicle_type'],
                'parking_charge' => $_POST['parking_charge'],
                'vehicle_limit' => $_POST['vehicle_limit'],
            ];
            $this->datawork->insert_data('category',$data);
                $this->session->set_flashdata('success',"Category Data has been added successfully.");
                redirect('admin/category');
        }
        else{
            $data['category'] = $this->datawork->calling_data('category');
            $data['categoryy'] = $this->datawork->calling_data('category',['status'=>1]);
            $data['user'] = $this->datawork->calling_data('admin');
            $this->load->view('admin/category',$data);
        }
    }
    function status($action=NULL,$id=NULL,$status=NULL){
        if($action=="status_active"){
            $this->datawork->update_data('category',['status'=>$status+=1],['cat_id'=>$id]);
                $this->session->set_flashdata('success',"Category Data has been activated successfully.");

            redirect('admin/category');
        }
        elseif($action=="status_deactivate"){
            $this->datawork->update_data('category',['status'=>$status-=0],['cat_id'=>$id]);
                $this->session->set_flashdata('success',"Category Data has been deactivated successfully.");

            redirect('admin/category');
        }
    }
    public function delete($action=NULL,$id=NULL){
        if($action=="category"){
            $this->datawork->delete_data('category',['cat_id'=>$id]);
                $this->session->set_flashdata('success',"Category Data has been deleted successfully.");
                redirect('admin/category');
        }
    }
    public function edit($action=NULL,$id=NULL){
        if($action=="edit_category"){
            $this->form_validation->set_rules('parking_area_no','parking_area_no','required');
            $this->form_validation->set_rules('vehicle_type','vehicle_type','required');
            $this->form_validation->set_rules('parking_charge','parking_charge','required');
            $this->form_validation->set_rules('vehicle_limit','vehicle_limit','required');
            if($this->form_validation->run()){
                $data = [
                    'parking_area_no'=>$_POST['parking_area_no'],
                    'vehicle_type'=>$_POST['vehicle_type'],
                    'parking_charge'=>$_POST['parking_charge'],
                    'vehicle_limit'=>$_POST['vehicle_limit'],
                ];
                $this->datawork->update_data('category',$data,['cat_id'=>$id]);
                $this->session->set_flashdata('success',"Category Data has been updated.");
                redirect('admin/category');
            }
            $data['category'] = $this->datawork->calling_data('category',['cat_id'=>$id]);
            $this->load->view('admin/edit_category',$data);
        }
    }
    public function add_vehicle(){
        $this->form_validation->set_rules('vehicle_number','vehicle_number','required');
        $this->form_validation->set_rules('vehicle_type','vehicle_type','required');
        $this->form_validation->set_rules('parking_area_number','parking_area_number','required');
        $this->form_validation->set_rules('parking_charge','parking_charge','required');
        if($this->form_validation->run()){
            $data = [
                'vehicle_no' => $_POST['vehicle_number'],
                'vehicle_type' => $_POST['vehicle_type'],
                'parking_area_no' => $_POST['parking_area_number'],
                'parking_charge' => $_POST['parking_charge'],
            ];
            $this->datawork->insert_data('add_vehicle',$data);
                $this->session->set_flashdata('success',"Vehicle Data has been added successfully.");
                redirect('admin/add_vehicle');
        }
        else{            
            $data['parking_area_no'] = $this->datawork->calling_data('category',['status'=>1]);
            $data['category'] = $this->datawork->calling_data('category',['status'=>1]);
            $data['add_vehicle'] = $this->datawork->calling_data('add_vehicle',['status'=>0],['id'=>'DESC']);
            $data['user'] = $this->datawork->calling_data('admin');
            $this->load->view('admin/add_vehicle',$data);
        }
    }
    public function receipt($id=NULL){
        $data['receipt'] = $this->datawork->calling_data('add_vehicle',['id'=>$id]);
        $this->load->view('admin/receipt',$data);
    }
    public function manage_vehicle(){
        if(isset($_GET['find'])){
            $search = $_GET['search'];
            $data['manage_vehicle'] = $this->datawork->search_data('add_vehicle',['vehicle_no'=>$search]);
            $data['user'] = $this->datawork->calling_data('admin');
            $this->load->view('admin/manage_vehicle',$data);
        }
        else{
            $data['manage_vehicle'] = $this->datawork->calling_data('add_vehicle');
            $data['user'] = $this->datawork->calling_data('admin');
            $this->load->view('admin/manage_vehicle',$data);
        }
    }
    function vehicle_outgoing($id=NULL,$status=NULL){
        $this->datawork->update_data('add_vehicle',['status'=>$status+=1],['id'=>$id]);
                $this->session->set_flashdata('success',"Vehicle Data has been updated successfully.");
                redirect('admin/manage_vehicle');
    }
    public function reports(){
        $data['add_vehicle'] = $this->datawork->calling_data('add_vehicle');
        $data['user'] = $this->datawork->calling_data('admin');
        $this->load->view('admin/reports',$data);
    }

    public function reports_generate(){
        $filter_by = $this->input->get('filter_by');
        $query = $this->input->get('query');
        
        // Get filtered vehicle data
        if ($filter_by === 'vehicle_no') {
            $data['vehicles'] = $this->datawork->search_data('add_vehicle', ['vehicle_no' => $query]);
        } else if ($filter_by === 'vehicle_name') {
            $data['vehicles'] = $this->datawork->search_data('add_vehicle', ['vehicle_type' => $query]);
        } else if ($filter_by === 'slot_no') {
            $data['vehicles'] = $this->datawork->search_data('add_vehicle', ['parking_area_no' => $query]);
        } else if ($filter_by === 'booking_no') {
            $data['vehicles'] = $this->datawork->search_data('add_vehicle', ['id' => $query]);
        }

        // Get current admin info
        $admin_username = $this->session->userdata('admin');
        $current_admin = $this->datawork->calling_data('admin', ['username' => $admin_username]);

        $data['filter_by'] = $filter_by;
        $data['query'] = $query;
        $data['generation_date'] = date('Y-m-d H:i:s');
        $data['current_admin'] = $current_admin[0];
        $data['report_filename'] = 'vehicle_report_' . date('Y-m-d_H-i-s') . '.pdf';
        
        // Load the report view
        $this->load->view('admin/report_template', $data);
    }
    public function search(){
        if(isset($_GET['find'])){
            $search = $_GET['search'];
            $data['vehicle_details'] = $this->datawork->search_data('add_vehicle',['vehicle_no'=>$search,'id'=>$search]);
            $data['user'] = $this->datawork->calling_data('admin');
            $data['search'] = $search;
            $this->load->view('admin/search',$data);
        }
        else{
            $data['user'] = $this->datawork->calling_data('admin');
            $this->load->view('admin/search',$data);
        }
    }
    public function registration() {
        // Check if user has super_admin role
        $admin_data = $this->datawork->calling_data('admin', ['username' => $this->session->userdata('admin')]);
        if (!$admin_data || $admin_data[0]->admin_role !== 'super_admin') {
            $this->session->set_flashdata('error', 'Only Super Admins can register new admins');
            redirect('admin/index');
        }
        
        $data['user'] = $this->datawork->calling_data('admin');
        $this->load->view('admin/registration', $data);
    }

    public function register_admin() {
        // Check if user has super_admin role
        $admin_data = $this->datawork->calling_data('admin', ['username' => $this->session->userdata('admin')]);
        if (!$admin_data || $admin_data[0]->admin_role !== 'super_admin') {
            $this->session->set_flashdata('error', 'Only Super Admins can register new admins');
            redirect('admin/index');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[admin.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[admin.email]');
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('admin_role', 'Admin Role', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'email' => $this->input->post('email'),
                'full_name' => $this->input->post('full_name'),
                'admin_role' => $this->input->post('admin_role'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->datawork->insert_data('admin', $data)) {
                $this->session->set_flashdata('success', 'New admin registered successfully');
                redirect('admin/registration');
            } else {
                $this->session->set_flashdata('error', 'Failed to register new admin');
                redirect('admin/registration');
            }
        } else {
            $data['user'] = $this->datawork->calling_data('admin');
            $this->load->view('admin/registration', $data);
        }
    }

    public function download_report() {
        $filter_by = $this->input->get('filter_by');
        $query = $this->input->get('query');
        
        // Get filtered vehicle data
        if ($filter_by === 'vehicle_no') {
            $data['vehicles'] = $this->datawork->search_data('add_vehicle', ['vehicle_no' => $query]);
        } else if ($filter_by === 'vehicle_name') {
            $data['vehicles'] = $this->datawork->search_data('add_vehicle', ['vehicle_type' => $query]);
        } else if ($filter_by === 'slot_no') {
            $data['vehicles'] = $this->datawork->search_data('add_vehicle', ['parking_area_no' => $query]);
        } else if ($filter_by === 'booking_no') {
            $data['vehicles'] = $this->datawork->search_data('add_vehicle', ['id' => $query]);
        }

        // Get current admin info
        $admin_username = $this->session->userdata('admin');
        $current_admin = $this->datawork->calling_data('admin', ['username' => $admin_username]);

        $data['filter_by'] = $filter_by;
        $data['query'] = $query;
        $data['generation_date'] = date('Y-m-d H:i:s');
        $data['current_admin'] = $current_admin[0];
        
        // Generate PDF filename
        $filename = 'vehicle_report_' . date('Y-m-d_H-i-s') . '.csv';
        
        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        // Create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');
        
        // Add UTF-8 BOM for proper Excel display of special characters
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // Add report header info
        
        fputcsv($output, ['Smart Parking Management System - Vehicle Report']);
        fputcsv($output, ['Report Type:', ucwords(str_replace('_', ' ', $filter_by)) . ' Report']);
        fputcsv($output, ['Search Value:', $query]);
        fputcsv($output, ['Generated On:', date('F j, Y g:i A', strtotime($generation_date))]);
        fputcsv($output, ['Generated By:', $current_admin->username]);
        fputcsv($output, []); // Empty line for spacing
        
        // Add CSV header
        fputcsv($output, [
            'Booking No',
            'Vehicle No',
            'Vehicle Type',
            'Parking Area',
            'Arrival Time',
            'Status',
            'Parking Charge (₹)'
        ]);
        
        // Add data rows
        $total_charge = 0;
        if (!empty($data['vehicles'])) {
            foreach ($data['vehicles'] as $vehicle) {
                $total_charge += $vehicle->parking_charge;
                fputcsv($output, [
                    $vehicle->id,
                    $vehicle->vehicle_no,
                    ucfirst($vehicle->vehicle_type),
                    $vehicle->parking_area_no,
                    date('M j, Y g:i A', strtotime($vehicle->arrival_time)),
                    ($vehicle->status == 0 ? 'Currently Parked' : 'Left'),
                    number_format($vehicle->parking_charge, 2)
                ]);
            }
        }
        
        // Add summary
        fputcsv($output, []); // Empty line for spacing
        fputcsv($output, ['Total Records:', count($data['vehicles'])]);
        fputcsv($output, ['Total Charges:', '₹' . number_format($total_charge, 2)]);
        
        fclose($output);
        exit();
    }

    public function setting(){
//        if($action=='change_username'){
//            $this->form_validation->set_rules('new_username','new_username','required');
//            $this->form_validation->set_rules('password','password','required');
//            if($this->form_validation->run()){
//                if($this->datawork->check_data('admin',['password'=>$_POST['password']])){
//                    $this->datawork->update_data('admin',['username'=>$_POST['new_username']],['username'=>$_SESSION['admin']]);
//                    redirect('admin/setting');
//                }
//                else{
//                    $this->session->set_flashdata("message","<div class='alert alert-danger'><i class='fas fa-times-circle'></i>&nbsp; <b>Incorrect password, please try again...</b></div>");
//                }
//            }
//        }
        
        
        $this->form_validation->set_rules('current_password','current_password','required');
        $this->form_validation->set_rules('new_password','new_password','required');
        $this->form_validation->set_rules('reenter_password','reenter_password','required');
        if($this->form_validation->run()){
            if($this->datawork->check_data('admin',['password'=>$_POST['current_password']])){
                if($_POST['new_password']==$_POST['reenter_password']){
                    $this->datawork->update_data('admin',['password'=>$_POST['new_password']],['username'=>$_SESSION['admin']]);
                    $this->session->set_flashdata("success","Your password is successfully changed.");
                    redirect('admin/setting');
                }
                else{
                    $this->session->set_flashdata("error","Your password does not match with confirm password, please try again.");
                }
            }
            else{
                $this->session->set_flashdata("error","Your password does not match with current password, please try again.");
            }
        }
        $data['user'] = $this->datawork->calling_data('admin');
        $this->load->view('admin/setting',$data);
    }
    
}
?>