<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/BaseController.php';

class Manometer extends BaseController
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('tekanan_model');
		$this->isLoggedIn();
	}

	public function index()
	{
		if ($this->isAdmin() == TRUE) {
			$this->loadThis();
		} else {
			$this->global['title'] = 'Manometer';
			$this->loadViews('manometer/tekanan', $this->global, [], null);
		}
	}

	public function getDataTekanan()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
		$offset = ($page - 1) * $rows;

		$this->global['title'] = 'Tekanan';
		echo json_encode($this->tekanan_model->tekananListing($rows, $offset));
	}

	public function pipaRencana()
	{
		if ($this->isAdmin() == TRUE) {
			$this->loadThis();
		} else {
			$this->global['title'] = 'Pipa Rencana';
			$data['pipaRecords'] = $this->tekanan_model->pipaRencanaListing();
			$this->loadViews('pipa/pipaRencana', $this->global, $data, null);
		}
	}
	public function details_pipa()
	{
		$id = $this->uri->segment(3);
		if ($this->isAdmin() == TRUE) {
			$this->loadThis();
		} else {
			$this->global['title'] 	= 'Pipa';
			$data['pipa']			= 'Pipa';
			$data['pipaRecords'] 	= $this->tekanan_model->pipaListing_details($id);
			$this->loadViews('pipa/pipa_details', $this->global, $data, null);
		}
	}
	public function details_pipaRencana()
	{
		$id = $this->uri->segment(3);
		if ($this->isAdmin() == TRUE) {
			$this->loadThis();
		} else {
			$this->global['title'] 	= 'Pipa Rencana';
			$data['pipa']			= 'Pipa Rencana';
			$data['pipaRecords'] 	= $this->tekanan_model->pipaRencanaListing_details($id);
			$this->loadViews('pipa/pipa_details', $this->global, $data, null);
		}
	}
	public function edit_pipa()
	{
		$id = $this->uri->segment(3);
		if ($this->isAdmin() == TRUE) {
			$this->loadThis();
		} else {
			$this->global['title'] 	= 'Pipa';
			$data['echo']			= null;
			$data['pipaRecords'] 	= $this->tekanan_model->pipaListing_details($id);
			$this->loadViews('pipa/pipa_edit', $this->global, $data, null);
		}
	}
	public function edit_pipaRencana()
	{
		$id = $this->uri->segment(3);
		if ($this->isAdmin() == TRUE) {
			$this->loadThis();
		} else {
			$this->global['title'] 	= 'Pipa Rencana';
			$data['echo']			= null;
			$data['pipaRecords'] 	= $this->tekanan_model->pipaRencanaListing_details($id);
			$this->loadViews('pipa/pipaRencana_edit', $this->global, $data, null);
		}
	}
	public function save_pipa()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required');
		$this->form_validation->set_rules('cabang', 'Cabang', 'trim|required');
		$this->form_validation->set_rules('panjang', 'Panjang', 'trim|required');
		$this->form_validation->set_rules('diameter', 'Diameter', 'trim|required');
		$this->form_validation->set_rules('gid__2', 'Gid__2', 'trim|required');
		$this->form_validation->set_rules('latlng', 'Latlng', 'trim|required');
		$this->form_validation->set_rules('id_manometer', 'Id_manometer', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$id = $this->input->post('ID');
			$this->global['title'] 	= 'Pipa';
			$data['echo']			= "Form Kosong";
			$data['pipaRecords'] 	= $this->tekanan_model->pipaListing_details($id);
			$this->loadViews('pipa/pipa_edit', $this->global, $data, null);
		} else {
			$id = $this->input->post('ID');
			$result = $this->tekanan_model->pipaRencanaListing_save($id);
			if ($result) {
				$data['echo'] = "Edit Gagal ";
			} else {
				$data['echo'] = "Edit Berhasil";
			}
			$this->global['title'] 	= 'Pipa Rencana';
			$data['pipaRecords'] 	= $this->tekanan_model->pipaRencanaListing_details($id);
			$this->loadViews('pipa/pipa_edit', $this->global, $data, null);
		}
	}
	public function save_pipaRencana()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required');
		$this->form_validation->set_rules('cabang', 'Cabang', 'trim|required');
		$this->form_validation->set_rules('panjang', 'Panjang', 'trim|required');
		$this->form_validation->set_rules('diameter', 'Diameter', 'trim|required');
		$this->form_validation->set_rules('gid__2', 'Gid__2', 'trim|required');
		$this->form_validation->set_rules('latlng', 'Latlng', 'trim|required');
		$this->form_validation->set_rules('id_manometer', 'Id_manometer', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$id = $this->input->post('ID');
			$this->global['title'] 	= 'Pipa Rencana';
			$data['echo']			= "Form Kosong";
			$data['pipaRecords'] 	= $this->tekanan_model->pipaRencanaListing_details($id);
			$this->loadViews('pipa/pipa_edit', $this->global, $data, null);
		} else {
			$id = $this->input->post('ID');
			$result = $this->tekanan_model->pipaRencanaListing_save($id);
			if ($result) {
				$data['echo'] = "Edit Gagal ";
			} else {
				$data['echo'] = "Edit Berhasil";
			}
			$this->global['title'] 	= 'Pipa Rencana';
			$data['pipaRecords'] 	= $this->tekanan_model->pipaRencanaListing_details($id);
			$this->loadViews('pipa/pipa_edit', $this->global, $data, null);
		}
	}
	public function delete_pipa()
	{
		$id = $this->input->post("ID");
		$result = $this->mbr_model->pipaListing_delete($id);
		if ($result == true) {
			$data['result'] = $result;
		} else {
			$data['result'] = false;
		}
		echo json_encode($result);
	}

	public function delete_pipaRencana()
	{
		$id = $this->input->post("ID");
		$result = $this->mbr_model->pipaRencanaListing_delete($id);
		if ($result == true) {
			$data['result'] = $result;
		} else {
			$data['result'] = false;
		}
		echo json_encode($result);
	}

	//getting map view
	public function getMap($lat, $long)
	{
		$data['lat'] = $lat;
		$data['long'] = $long;
		$this->load->view('manometer/maps', $data);
	}
}
