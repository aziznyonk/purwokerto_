<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tekanan_model extends CI_Model
{
	function tekananListing($tgl, $offset, $rows, $sort = null,  $idMano = null, $petugas = null)
	{
		if ($idMano != null) return $this->resultGenerator(
			$this->cariMano($tgl, $offset, $rows, $sort,  $idMano)
		);
		if ($petugas != null) return $this->resultGenerator(
			$this->cariPetugas($tgl, $offset, $rows, $sort, $petugas)
		);
		else return $this->resultGenerator(
			$this->cariDefault($tgl, $offset, $rows, $sort,)
		);
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

	function cariDefault($tgl, $offset, $rows, $sort)
	{
		$result = (object)[];
		if ($tgl != null) $this->db->where('DATE(manometer.tgl_baca_s)', $tgl);
		if ($sort) $this->db->order_by($sort['sort'], $sort['order']);
		$r = $this->db
			->select('
				manometer.ID as ID, 
				manometer.id_manometer as id_manometer, 
				manometer.nama_manometer as nama_manometer, 
				manometer.lokasi as lokasi, 
				manometer.latlng as latlng, 
				manometer.username as username, 
				manometer.kondisi as kondisi, 
				manometer.tekanan as tekanan, 
				manometer.keterangan as keterangan, 
				manometer.tgl_baca_s as tgl_baca_s, 
				v_pegawai.nama as nama
			')
			->from('manometer')
			->join('v_pegawai', 'manometer.username = v_pegawai.nipam', 'INNER')
			->limit($offset, $rows)
			->get()
			->result();
		// echo $this->db->last_query();
		$result = (object) [];
		$result->rows = $r;
		if ($tgl != null) $this->db->where('DATE(manometer.tgl_baca_s)', $tgl);
		$this->db->select('count(manometer.ID) as total')->from('manometer');
		$result->total = $this->db->get()->result()[0]->total;
		return $result;
	}

	function cariMano($tgl, $offset, $rows, $sort, $idMano)
	{
		$result = (object)[];
		if ($sort) $this->db->order_by($sort['sort'], $sort['order']);
		if ($tgl != null) $this->db->where('DATE(manometer.tgl_baca_s)', $tgl);
		$r = $this->db
			->select('
				manometer.ID as ID, 
				manometer.id_manometer as id_manometer, 
				manometer.nama_manometer as nama_manometer, 
				manometer.lokasi as lokasi, 
				manometer.latlng as latlng, 
				manometer.username as username, 
				manometer.kondisi as kondisi, 
				manometer.tekanan as tekanan, 
				manometer.keterangan as keterangan, 
				manometer.tgl_baca_s as tgl_baca_s, 
				v_pegawai.nama as nama
			')
			->from('manometer')
			->join('v_pegawai', 'manometer.username = v_pegawai.nipam', 'INNER')
			->where('manometer.id_manometer', $idMano)
			->limit($offset, $rows)
			->get()
			->result();
		// echo $this->db->last_query();
		$result = (object) [];
		$result->rows = $r;
		if ($tgl != null) $this->db->where('DATE(manometer.tgl_baca_s)', $tgl);
		$this->db
			->select('count(manometer.ID) as total')
			->from('manometer')
			->where('manometer.id_manometer', $idMano);
		$result->total = $this->db->get()->result()[0]->total;
		return $result;
	}

	function cariPetugas($tgl, $offset, $rows, $sort, $petugas)
	{
		$result = (object)[];
		if ($sort) $this->db->order_by($sort['sort'], $sort['order']);
		if ($tgl != null) $this->db->where('DATE(manometer.tgl_baca_s)', $tgl);
		$this->db
			->select('
				manometer.ID as ID, 
				manometer.id_manometer as id_manometer, 
				manometer.nama_manometer as nama_manometer, 
				manometer.lokasi as lokasi, 
				manometer.latlng as latlng, 
				manometer.username as username, 
				manometer.kondisi as kondisi, 
				manometer.tekanan as tekanan, 
				manometer.keterangan as keterangan, 
				manometer.tgl_baca_s as tgl_baca_s, 
				v_pegawai.nama as nama
			')
			->from('manometer')
			->join('v_pegawai', 'manometer.username = v_pegawai.nipam', 'INNER')
			->like('v_pegawai.nama', $petugas)
			->limit($offset, $rows);
		$query = $this->db->get();
		$r = $query->result();
		$result = (object) [];
		$result->rows = $r;
		if ($tgl != null) $this->db->where('DATE(manometer.tgl_baca_s)', $tgl);
		$this->db
			->select('
				count(manometer.ID) as total
			')
			->from('manometer')
			->join('v_pegawai', 'manometer.username = v_pegawai.nipam', 'INNER')
			->like('v_pegawai.nama', $petugas);
		$result->total = $this->db->get()->result()[0]->total;
		return $result;
	}

	public function report($username, $tahun, $bulan)
	{
		$result = (object)[];
		$result->user = $this->db
			->select(
				"v_pegawai.nipam, 
				v_pegawai.nama"
			)
			->from("v_pegawai")
			->where("nipam", $username)
			->get()
			->row();
		$result->data = $this->db
			->select(
				"manometer.id_manometer, 
				manometer.nama_manometer, 
				DAY(manometer.tgl_baca_s) as tgl, 
				manometer.tekanan"
			)
			->from('manometer')
			->where(
				[
					'username' => $username,
					'YEAR(tgl_baca_s)' => $tahun,
					'MONTH(tgl_baca_s)' => $bulan
				]
			)
			->order_by('tgl_baca_s', 'asc')
			->get()
			->result();
		$reduce = (array)array_reduce($result->data, function (array $result, object $data) {
			if (!isset($result[$data->id_manometer])) $result[$data->id_manometer] = [];
			$result[$data->id_manometer] = $data;
			return $result;
		}, []);
		sort($reduce);
		$result->manometer = $reduce;
		return $result;
	}
}
