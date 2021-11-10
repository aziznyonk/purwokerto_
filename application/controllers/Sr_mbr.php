<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/BaseController.php';


class Sr_mbr extends BaseController
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mbr_model');
		$this->isLoggedIn();
	}
	public function index()
	{
		if ($this->isAdmin() == TRUE) {
			$this->loadThis();
		} else {
			$this->global['title'] = 'MBR';
			$this->loadViews('sr_mbr/sr_mbr', $this->global, [], null);
		}
	}

	public function getDataPelMbr()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
		$offset = ($page - 1) * $rows;
		$penginput = isset($_POST['penginput']) ? $_POST['penginput'] : null;
		$nama = isset($_POST['nama']) ? $_POST['nama'] : null;
		$surv = isset($_POST['surv']) ? $_POST['surv'] : null;

		$this->global['title'] = 'Pelanggan';
		echo json_encode($this->mbr_model->mbrListing($offset, $rows, $penginput, $nama, $surv));
	}

	public function getDataPelId()
	{
		$id = isset($_POST['id']) ? intval($_POST['id']) : null;
		echo json_encode($this->mbr_model->findByID($id));
	}

	public function update_pelanggan()
	{
		$ID = $_POST['ID'];
		$nama = isset($_POST['nama']) ? $_POST['nama'] : "";
		$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : "";
		$almt_dipasang = isset($_POST['almt_dipasang']) ? $_POST['almt_dipasang'] : "";
		$ktp = isset($_POST['ktp']) ? $_POST['ktp'] : "";
		$telfon = isset($_POST['telfon']) ? $_POST['telfon'] : "";
		$daya_listrik = isset($_POST['daya_listrik']) ? $_POST['daya_listrik'] : "";
		$rt_biasa = isset($_POST['rt_biasa']) ? $_POST['rt_biasa'] : "";
		$pekerjaan = isset($_POST['pekerjaan']) ? $_POST['pekerjaan'] : "";
		$jml_penghuni = isset($_POST['jml_penghuni']) ? $_POST['jml_penghuni'] : "";
		$smber_skrg = isset($_POST['smber_skrg']) ? $_POST['smber_skrg'] : "";
		$jarak = isset($_POST['jarak']) ? $_POST['jarak'] : "";
		$lebar_jln = isset($_POST['lebar_jln']) ? $_POST['lebar_jln'] : "";
		$jaringan_distri = isset($_POST['jaringan_distri']) ? $_POST['jaringan_distri'] : "";
		$latlng = isset($_POST['latlng']) ? $_POST['latlng'] : "";
		$username = isset($_POST['username']) ? $_POST['username'] : "";
		$ID_ = isset($_POST['ID_']) ? $_POST['ID_'] : "";

		$data = [
			'nama' => $nama,
			'alamat' => $alamat,
			'almt_dipasang' => $almt_dipasang,
			'ktp' => $ktp,
			'telfon' => $telfon,
			'daya_listrik' => $daya_listrik,
			'rt_biasa' => $rt_biasa,
			'pekerjaan' => $pekerjaan,
			'jml_penghuni' => $jml_penghuni,
			'smber_skrg' => $smber_skrg,
			'jarak' => $jarak,
			'lebar_jln' => $lebar_jln,
			'jaringan_distri' => $jaringan_distri,
			'latlng' => $latlng,
			'username' => $username,
			'ID_' => $ID_,
		];

		$where = [
			'ID' => $ID
		];
		$upd = $this->mbr_model->update_pelanggan($data, $where);
		echo json_encode($upd);
	}

	public function edit_mbr()
	{
		$id = $this->uri->segment(3);
		if ($this->isAdmin() == TRUE) {
			$this->loadThis();
		} else {
			$this->global['title'] = 'MBR';
			$data['mbrRecords'] = $this->mbr_model->mbrListing_edit($id);
			$data['echo'] = null;
			$this->loadViews('sr_mbr/sr_mbr_edit', $this->global, $data, null);
		}
	}
	public function save_mbr()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('ID_', 'ID_', 'trim|required|numeric');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('tipe', 'Tipe', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$id = $this->input->post('ID');
			$this->global['title'] = 'MBR';
			$data['echo'] = "Form Kosong";
			$data['mbrRecords'] = $this->mbr_model->mbrListing_edit($id);
			$this->loadViews('sr_mbr/sr_mbr_edit', $this->global, $data, null);
		} else {
			$id = $this->input->post('ID');
			$q = $this->mbr_model->mbrListing_save($id);
			if ($q) {
				$data['echo'] = "Edit Gagal ";
			} else {
				$data['echo'] = "Edit Berhasil";
			}
			$data['mbrRecords'] = $this->mbr_model->mbrListing_edit($id);
			$this->global['title'] = 'MBR';
			$this->loadViews('sr_mbr/sr_mbr_edit', $this->global, $data, null);
		}
	}
	public function delete_mbr()
	{
		$id = $this->input->post("ID");
		$result = $this->mbr_model->mbrListing_delete($id);
		if ($result == true) {
			$data['result'] = $result;
		} else {
			$data['result'] = false;
		}
		echo json_encode($result);
	}
}
