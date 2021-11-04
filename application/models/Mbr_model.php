<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mbr_model extends CI_Model
{
	/*MBR Model*/
	function mbrListing($offset, $rows)
	{
		$result = (object)[];
		$this->db->select('*');
		$this->db->from('sr_mbr');
		$this->db->limit($offset, $rows);
		$query = $this->db->get();
		$r = $query->result();
		$result->rows = [];
		foreach ($r as $d) {
			$d->action = '<a href="' . base_url() . 'sr_mbr/edit_mbr/' . $d->ID_ . '" class="btn btn-small"><i class="icon fa fa-pencil" title="edit"></i></a>'
				. '<a onclick="deleteFunction(' . $d->ID_ . ')" class="btn btn-small text-danger"><i class="icon fa fa-trash" title="delete"></i></a>';
			array_push($result->rows, $d);
		}
		$result->total = $this->db->count_all('pelanggan_pwt');
		return $result;
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
			'ID_'			=> $this->input->post('ID_'),
			'nama' 			=> $this->input->post('nama'),
			'alamat' 		=> $this->input->post('alamat'),
			'almt_dipasang'	=> $this->input->post('almt_dipasang'),
			'telfon'			=> $this->input->post('telfon'),
			'ktp' 			=> $this->input->post('ktp'),
			'rt_biasa' 		=> $this->input->post('tipe'),
			'daya_listrik'	=> $this->input->post('daya'),
			'pekerjaan' 		=> $this->input->post('pekerjaan'),
			'jml_penghuni' 	=> $this->input->post('penghuni'),
			'smber_skrg'		=> $this->input->post('smber_skrg'),
			'jarak'			=> $this->input->post('jarak'),
			'lebar_jln'		=> $this->input->post('lebar_jln'),
			'jaringan_distri' => $this->input->post('jaringan_distri')
		);
		$this->db->where('ID', $id);
		$this->db->update('sr_mbr', $data);
	}
	function mbrListing_delete($ID)
	{
		$this->db->where('ID', $ID);
		$this->db->delete('sr_mbr');
	}
	/*Pelanngan Model*/
	function pelaListing($offset, $rows)
	{
		$result = (object)[];
		$this->db->select('ID, id_survey, nomor_pela, nama, alamat, status, klasifikasi, dma, golongan, cabang, zona_baca_, keterangan, username, tgl_input');
		$this->db->from('pelanggan_pwt');
		$this->db->limit($offset, $rows);
		$query = $this->db->get();
		$r = $query->result();
		$result->rows = [];
		foreach ($r as $d) {
			$d->action = '<a href="' . base_url() . 'pela/edit_pelanggan/' . $d->ID . '" class="btn btn-small"><i class="icon fa fa-pencil" title="edit"></i></a>'
				. '<a onclick="deleteFunction(' . $d->ID . ')" class="btn btn-small text-danger"><i class="icon fa fa-trash" title="delete"></i></a>';
			array_push($result->rows, $d);
		}
		$result->total = $this->db->count_all('pelanggan_pwt');
		return $result;
	}
	function pelaListing_edit($id)
	{
		$this->db->select('*');
		$this->db->from('pelanggan_pwt');
		$this->db->where('ID', $id);
		$query = $this->db->get();

		$result = $query->result();

		return $result;
	}
	function pelaListing_save($id)
	{
		$data = array(

			'nama' 			=> $this->input->post('nama'),
			'alamat' 		=> $this->input->post('alamat'),
			'nomor_pela' 	=> $this->input->post('nomor_pela'),
			'klasifikasi' 	=> $this->input->post('klasifikasi'),
			'cabang' 		=> $this->input->post('cabang'),
			'status' 		=> $this->input->post('status'),
			'latlng'			=> $this->input->post('latlng')
		);
		$this->db->where('ID', $id);
		$this->db->update('pelanggan_pwt', $data);
	}
	function pelaListing_delete($ID)
	{
		$this->db->where('ID', $ID);
		$this->db->delete('pelanggan_pwt');
	}
}
