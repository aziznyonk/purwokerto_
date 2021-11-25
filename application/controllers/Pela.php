<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/BaseController.php';

class Pela extends BaseController
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Pelanggan_model');
		$this->isLoggedIn();
	}
	public function index()
	{
		if ($this->isAdmin() == TRUE) {
			$this->loadThis();
		} else {
			$this->global['title'] = 'Pelanggan';
			$this->loadViews('pelanggan/pela', $this->global, [], null);
		}
	}

	public function getDataPel()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
		$offset = ($page - 1) * $rows;
		$nopel = isset($_POST['nopel']) ? $_POST['nopel'] : null;
		$nama = isset($_POST['nama']) ? $_POST['nama'] : null;
		$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : null;
		$surv = isset($_POST['surv']) ? $_POST['surv'] : null;

		$this->global['title'] = 'Pelanggan';
		echo json_encode($this->Pelanggan_model->pelaListing($rows, $offset, $nopel, $nama,  $alamat, $surv));
	}

	public function getDataPelId()
	{
		$id = isset($_POST['id']) ? intval($_POST['id']) : null;
		echo json_encode($this->Pelanggan_model->pelaId($id));
	}

	public function update_pelanggan($id)
	{
		print_r($_POST);
	}

	public function edit_pelanggan()
	{
		$id = $this->uri->segment(3);
		if ($this->isAdmin() == TRUE) {
			$this->loadThis();
		} else {
			$this->global['title'] = 'Pelanggan';
			$data['pelangganRecords'] = $this->Pelanggan_model->pelaListing_edit($id);
			$data['echo'] = null;
			$this->loadViews('pelanggan/pelanggan_edit', $this->global, $data, null);
		}
	}
	public function save_pelanggan()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('ID', 'ID', 'trim|required|numeric');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('status', 'status', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode(["code" => 204, "message" => "Gagal Menyimpan Data!!!"]);
		} else {
			$id = $this->input->post('ID');
			$q = $this->Pelanggan_model->pelaListing_save($id);
			$data['mbrRecords'] = $this->Pelanggan_model->pelaListing_edit($id);
			echo json_encode(["code" => 201, "message" => "Data Berhasil diubah"]);
		}
	}

	public function delete_pelanggan()
	{
		$id = $this->input->post("ID");
		$result = $this->Pelanggan_model->pelaListing_delete($id);
		if ($result == true) {
			$data['result'] = $result;
		} else {
			$data['result'] = false;
		}
		echo json_encode($result);
	}
}
