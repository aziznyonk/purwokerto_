<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/BaseController.php';

class Pela extends BaseController {
	function __construct(){
        parent::__construct();
        $this->load->model('mbr_model');
        $this->isLoggedIn();
    }
	public function index()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else{
			$this->global['title'] = 'Pelanggan';
			$data['pelangganRecords'] = $this->mbr_model->pelaListing();
			$data['echo'] = "";
			$this->loadViews('pelanggan/pela', $this->global, $data, null);

        }
    }
	public function edit_pelanggan()
    {
		$id = $this->uri->segment(3);
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else{
			$this->global['title'] = 'Pelanggan';
			$data['pelangganRecords'] = $this->mbr_model->pelaListing_edit($id);
			$data['echo'] = null;
			$this->loadViews('pelanggan/pelanggan_edit', $this->global, $data, null);

        }
    }
	public function save_pelanggan(){
		$this->load->library('form_validation');
		
        $this->form_validation->set_rules('ID_', 'ID_', 'trim|required|numeric');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('tipe', 'Tipe', 'trim|required');
		if($this->form_validation->run() == FALSE){
			$id = $this->input->post('ID');
			$this->global['title'] = 'Pelanggan';
			$data['echo'] = "Form Kosong";
			$data['pelangganRecords'] = $this->mbr_model->pelaListing_edit($id);
			$this->loadViews('pelanggan/pelanggan_edit', $this->global, $data, null);
		} else {
			$id = $this->input->post('ID');
			$q = $this->mbr_model->mbrListing_save($id);
			if($q){
				$data['echo'] = "Edit Gagal ";
			} else {
				$data['echo'] = "Edit Berhasil";
			}
			$data['mbrRecords'] = $this->mbr_model->pelaListing_edit($id);
			$this->global['title'] = 'Pelanggan';
			$this->loadViews('pelanggan/pelanggan_edit', $this->global, $data, null);
		}
	}
	public function delete_pelanggan ()
	{
		$id = $this->input->post("ID");
		$result = $this->mbr_model->pelaListing_delete($id);
		if($result == true){
            $data['result'] = $result;
        }else {
            $data['result'] = false;
        }
        echo json_encode($result);
	}
}