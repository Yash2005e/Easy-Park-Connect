<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Fetch all slots (JSON)
    public function get_slots() {
        $slots = $this->db->get('parking_slots')->result_array();
        echo json_encode($slots);
    }

    // Update single slot
    public function update_slot($id, $status) {
        $this->db->where('id', $id);
        $this->db->update('parking_slots', ['status' => $status]);
        echo json_encode(['success' => true]);
    }
}
