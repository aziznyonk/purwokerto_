<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tekanan_model extends CI_Model
{
	protected $select = "manometer.ID as ID, 
						manometer.id_manometer as id_manometer, 
						manometer.nama_manometer as nama_manometer, 
						manometer.lokasi as lokasi, 
						manometer.latlng as latlng, 
						manometer.username as username, 
						manometer.kondisi as kondisi, 
						manometer.tekanan as tekanan, 
						manometer.keterangan as keterangan, 
						manometer.tgl_baca_s as tgl_baca_s, 
						v_pegawai.nama as nama";
	protected $table = "manometer";
	protected $join = "v_pegawai";
	protected $joinVpegawai = "manometer.username = v_pegawai.nipam";

	protected $rows = null;
	protected $page = null;
	protected $pos = null;
	protected $sort = null;
	protected $order = null;
	protected $cari = null;
	protected $tgl = null;

	function tekananListing()
	{
		$body = (object) $this->input->post();
		$body = (object)$this->input->post();
		$this->rows = $body->rows;
		$this->page = $body->page;
		$this->pos = ($this->page - 1) * $this->rows;
		$this->sort = isset($body->sort) ? $body->sort : null;
		$this->order = isset($body->order) ? $body->order : null;
		$this->tgl = isset($body->tgl) ? $body->tgl : null;

		if (isset($body->cari)) return $this->cari($body->cari);
		return $this->cariDefault();
	}

	function resultGenerator($r)
	{
		$result = (object)[];
		$result->total = $r->total;
		$result->rows = [];
		foreach ($r->rows as $d) {
			$koordinat = json_decode($d->latlng)[0]->geometry;
			$d->koordinat = '<a href="#" onClick="openModal(' . $koordinat[0] . ',' . $koordinat[1] . ',' . $d->tekanan . ')" data-toggle="modal" data-target="#myModal">' . $koordinat[0] . ',' . $koordinat[1] . '</a>';
			// $d->foto = '<img class="zoom" src="' . $d->path . '" style="width:50px;height:50px;">';
			// $a_edit = '<a href="' . base_url() . 'pipa/edit_pipa/' . $d->ID . '" class="btn btn-small"><i class="icon fa fa-pencil" title="edit"></i></a>';
			$a_edit = '<a href="#" onClick="edit(' . $d->ID . ')" data-toggle="modal" data-target="#editModal"><i class="icon fa fa-pencil" title="edit"></i></a>';
			$a_delete = '<a onclick="hapus(' . $d->ID . ')" class="btn btn-small text-danger"><i class="icon fa fa-trash" title="delete"></i></a>';
			$d->action = $a_edit . $a_delete;
			array_push($result->rows, $d);
		}
		return $r;
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

	function cariDefault()
	{
		$result = (object)[];
		if ($this->tgl != null) $this->db->where('DATE(manometer.tgl_baca_s)', $this->tgl);
		if ($this->sort) $this->db->order_by($this->sort, $this->order);
		$r = $this->db
			->select($this->select)
			->from($this->table)
			->join($this->join, $this->joinVpegawai, 'INNER')
			->order_by('manometer.tgl_baca_s', 'DESC')
			->limit($this->rows, $this->pos)
			->get()
			->result();
		$result = (object) [];
		$result->rows = $r;
		if ($this->tgl != null) $this->db->where('DATE(manometer.tgl_baca_s)', $this->tgl);
		$this->db->select('count(manometer.ID) as total')->from('manometer');
		$result->total = $this->db->get()->result()[0]->total;
		return $result;
	}

	function cari($cari)
	{
		$result = (object)[];
		if ($this->tgl != null) $this->db->where('DATE(manometer.tgl_baca_s)', $this->tgl);
		if ($this->sort) $this->db->order_by($this->sort, $this->order);
		$r = $this->db
			->select($this->select)
			->from($this->table)
			->join($this->join, $this->joinVpegawai, 'INNER')
			->where('manometer.id_manometer', $cari)
			->or_where('manometer.username', $cari)
			->or_like('v_pegawai.nama', $cari)
			->or_like('manometer.nama_manometer', $cari)
			->or_like('manometer.lokasi', $cari)
			->limit($this->rows, $this->pos)
			->get()
			->result();
		// echo $this->db->last_query();
		$result = (object) [];
		$result->rows = $r;
		if ($this->tgl != null) $this->db->where('DATE(manometer.tgl_baca_s)', $this->tgl);
		$this->db
			->select('count(manometer.ID) as total')
			->from($this->table)
			->join($this->join, $this->joinVpegawai, 'INNER')
			->where('manometer.id_manometer', $cari)
			->or_where('manometer.username', $cari)
			->or_like('v_pegawai.nama', $cari)
			->or_like('manometer.nama_manometer', $cari)
			->or_like('manometer.lokasi', $cari);
		$result->total = $this->db->get()->result()[0]->total;
		return $result;
	}
}
