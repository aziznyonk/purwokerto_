<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tekanan_model extends CI_Model
{
	function tekananListing($offset, $rows)
	{
		$result = (object)[];
		$this->db->select('*');
		$this->db->from('manometer');
		$this->db->limit($offset, $rows);
		$query = $this->db->get();
		$r = $query->result();
		$result->rows = [];
		foreach ($r as $d) {
			$koordinat = json_decode($d->latlng)[0]->geometry;
			$d->koordinat = '<a href="#" onClick="openModal(' . $koordinat[0] . ',' . $koordinat[1] . ',' . $d->tekanan . ')" data-toggle="modal" data-target="#myModal">' . $koordinat[0] . ',' . $koordinat[1] . '</a>';
			// $d->foto = '<img class="zoom" src="' . $d->path . '" style="width:50px;height:50px;">';
			// $a_edit = '<a href="' . base_url() . 'pipa/edit_pipa/' . $d->ID . '" class="btn btn-small"><i class="icon fa fa-pencil" title="edit"></i></a>';
			$a_edit = '<a href="#" onClick="edit(' . $d->ID . ')" data-toggle="modal" data-target="#editModal"><i class="icon fa fa-pencil" title="edit"></i></a>';
			$a_delete = '<a onclick="hapus(' . $d->ID . ')" class="btn btn-small text-danger"><i class="icon fa fa-trash" title="delete"></i></a>';
			$d->action = $a_edit . $a_delete;
			array_push($result->rows, $d);
		}
		$result->total = $this->db->count_all('pelanggan_pwt');
		return $result;
	}

	function tekananDetail($ID)
	{
		$result = $this->db->get_where('manometer', ['ID' => $ID])->row();
		return $result;
	}

	function update($data, $where)
	{
		$this->db->trans_start();
		$this->db->update('manometer', $data, $where);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return ["code" => 201, "message" => "Data berhasil di Update"];
		}
		return ["code" => 204, "message" => "Data GAGAL di Update"];
	}

	function delete($ID)
	{
		$this->db->trans_start();
		$this->db->delete('manometer', ['ID' => $ID]);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return ["code" => 201, "message" => "Data berhasil dihapus"];
		}
		return ["code" => 204, "message" => "Gagal menghapus Data!"];
	}

	function pipaRencanaListing()
	{
		$this->db->select('*');
		$this->db->from('pipa_rencana');
		$query = $this->db->get();

		$result = $query->result();

		return $result;
	}
	function pipaListing_details($id)
	{
		$this->db->select('*');
		$this->db->from('pipa');
		$this->db->where('ID', $id);
		$query = $this->db->get();

		$result = $query->result();

		return $result;
	}
	function pipaRencanaListing_details($id)
	{
		$this->db->select('*');
		$this->db->from('pipa_rencana');
		$this->db->where('ID', $id);
		$query = $this->db->get();

		$result = $query->result();

		return $result;
	}
	function pipaListing_save($id)
	{
		$data = array(
			'gid__2' 		=> $this->input->post('gid__2'),
			'lokasi' 		=> $this->input->post('lokasi'),
			'cabang' 		=> $this->input->post('cabang'),
			'panjang' 		=> $this->input->post('panjang'),
			'diameter' 		=> $this->input->post('diameter'),
			'statuspipa' 	=> $this->input->post('statuspipa'),
			'id_manometer' 	=> $this->input->post('id_manometer'),
			'latlng'			=> $this->input->post('latlng')
		);
		$this->db->where('ID', $id);
		$this->db->update('pipa', $data);
	}
	function pipaRencanaListing_save($id)
	{
		$data = array(
			'gid__2' 		=> $this->input->post('gid__2'),
			'lokasi' 		=> $this->input->post('lokasi'),
			'cabang' 		=> $this->input->post('cabang'),
			'panjang' 		=> $this->input->post('panjang'),
			'diameter' 		=> $this->input->post('diameter'),
			'statuspipa' 	=> $this->input->post('statuspipa'),
			'id_manometer' 	=> $this->input->post('id_manometer'),
			'latlng'			=> $this->input->post('latlng')
		);
		$this->db->where('ID', $id);
		$this->db->update('pipa_rencana', $data);
	}
	function pipaListing_delete($ID)
	{
		$this->db->where('ID', $ID);
		$this->db->delete('pipa');
	}
	function pipaRencanaListing_delete($ID)
	{
		$this->db->where('ID', $ID);
		$this->db->delete('pipa_rencana');
	}
}
