<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_customer');
    }

    public function index() {
        $data['customers'] = $this->Model_customer->get_all();
        
        $this->load->view('customer_index', $data);
    }

    public function add() {
        $this->load->view('backend/customer/add');
    }

    public function store() {
        $data = [
            'nama' => $this->input->post('nama'),
            'telepon' => $this->input->post('telepon'),
            'rekening' => $this->input->post('rekening'),
            'nama_bank' => $this->input->post('nama_bank'),
            'nama_paket' => $this->input->post('nama_paket'),
            'jumlah_tagihan' => $this->input->post('jumlah_tagihan')
        ];
        $this->Model_customer->insert($data);
        redirect('customer');
    }

    public function edit($id) {
        $data['customer'] = $this->Model_customer->get_by_id($id);
        $this->load->view('edit', $data);
    }

    public function update($id) {
        $data = [
            'nama' => $this->input->post('nama'),
            'telepon' => $this->input->post('telepon'),
            'rekening' => $this->input->post('rekening'),
            'nama_bank' => $this->input->post('nama_bank'),
            'nama_paket' => $this->input->post('nama_paket'),
            'jumlah_tagihan' => $this->input->post('jumlah_tagihan')
        ];
        $this->Model_customer->update($id, $data);
        redirect('customer');
    }

    public function delete($id) {
        $this->Model_customer->delete($id);
        redirect('customer');
    }
}
