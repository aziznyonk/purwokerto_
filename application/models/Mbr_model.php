<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mbr_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('CustModel');
	}

	/*MBR Model*/
	function mbrListing($rows, $offset, $penginput, $nama, $alamat, $surv)
	{
		$result = (object)[];
		if ($penginput != null) $r = $this->mbrPenginput($offset, $rows, $penginput);
		elseif ($nama != null) $r = $this->mbrNama($offset, $rows, $nama);
		elseif ($alamat != null) $r = $this->mbrAlamat($offset, $rows, $alamat);
		elseif ($surv != null) $r = $this->mbrSurv($offset, $rows, $surv);
		else $r = $this->mbrDefault($offset, $rows);
		return $r;
	}

	function mbrListing_edit($id)
	{
		$this->db->select('*');
		$this->db->from('sr_mbr');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		$result = $query->result();

		return $result;
	}

	function mbrListing_save($id)
	{
		$data = array(
			'ID_'				=> $this->input->post('ID_'),
			'nama'				=> $this->input->post('nama'),
			'alamat'			=> $this->input->post('alamat'),
			'almt_dipasang'		=> $this->input->post('almt_dipasang'),
			'telfon'			=> $this->input->post('telfon'),
			'ktp'				=> $this->input->post('ktp'),
			'rt_biasa'			=> $this->input->post('tipe'),
			'daya_listrik'		=> $this->input->post('daya'),
			'pekerjaan'			=> $this->input->post('pekerjaan'),
			'jml_penghuni'		=> $this->input->post('penghuni'),
			'smber_skrg'		=> $this->input->post('smber_skrg'),
			'jarak'				=> $this->input->post('jarak'),
			'lebar_jln'			=> $this->input->post('lebar_jln'),
			'jaringan_distri'	=> $this->input->post('jaringan_distri')
		);
		$this->db->where('ID', $id);
		$this->db->update('sr_mbr', $data);
	}

	public function findById($ID)
	{
		return $this->db
			->from('sr_mbr')
			->where('ID', $ID)
			->get()
			->result();
	}

	public function update_pelanggan($data, $where)
	{
		if ($where['ID'] == '') {
			return [
				'code' => 204,
				'message' => 'Gagal Menyimpan Data!'
			];
		}

		$this->db->trans_start();
		$this->db->update('sr_mbr', $data, $where);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return [
				'code' => 201,
				'message' => 'Data berhasil diupdate!'
			];
		} else {
			return [
				'code' => 204,
				'message' => 'Gagal Menyimpan Data!'
			];
		}
	}

	function mbrListing_delete($ID)
	{
		$this->db->where('ID', $ID);
		$this->db->delete('sr_mbr');
	}

	function mbrDefault($offset, $rows)
	{
		$data['rows'] = $this->db
			->from('sr_mbr')
			->limit($offset, $rows)
			->get()
			->result();
		$data['total'] = $this->db->count_all('sr_mbr');
		return $data;
	}

	function mbrPenginput($offset, $rows, $penginput)
	{
		$data['rows'] = $this->db
			->from('sr_mbr')
			->where('username', $penginput)
			->limit($offset, $rows)
			->get()
			->result();
		$data['total'] = $this->db->select('COUNT(ID) AS total')->where('username', $penginput)->get('sr_mbr')->result()[0]->total;
		return $data;
	}

	function mbrNama($offset, $rows, $nama)
	{
		$data['rows'] = $this->db
			->from('sr_mbr')
			->like('nama', $nama)
			->limit($offset, $rows)
			->get()
			->result();
		$data['total'] = $this->db->select('COUNT(ID) AS total')->like('nama', $nama)->get('sr_mbr')->result()[0]->total;
		return $data;
	}

	function mbrAlamat($offset, $rows, $alamat)
	{
		$data['rows'] = $this->db
			->from('sr_mbr')
			->like('alamat', $alamat)
			->limit($offset, $rows)
			->get()
			->result();
		$data['total'] = $this->db->select('COUNT(ID) AS total')->like('alamat', $alamat)->get('sr_mbr')->result()[0]->total;
		return $data;
	}

	function mbrSurv($offset, $rows, $surv)
	{
		$data['rows'] = $this->db
			->from('sr_mbr')
			->where('ID_', $surv)
			->limit($offset, $rows)
			->get()
			->result();
		$data['total'] = $this->db->select('COUNT(ID) AS total')->where('ID_', $surv)->get('sr_mbr')->result()[0]->total;
		return $data;
	}
}
