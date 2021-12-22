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

	function __construct()
	{
		parent::__construct();
	}

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
		$result->rows = $r;
		if ($this->tgl != null) $this->db->where('DATE(manometer.tgl_baca_s)', $this->tgl);
		$this->db->select('count(manometer.ID) as total')->from('manometer');
		$result->total = $this->db->get()->result()[0]->total;
		return $result;
	}

	function cari($cari)
	{
		$result = (object)[];
		$username = $this->result_generator('where', 'manometer.username', $cari);
		$total_username = $this->result_total('where', 'manometer.username', $cari);
		$nama = $this->result_generator('like', 'v_pegawai.nama', $cari);
		$total_nama = $this->result_total('like', 'v_pegawai.nama', $cari);
		$id_manometer = $this->result_generator('where', 'manometer.id_manometer', $cari);
		$total_id_manometer = $this->result_total('where', 'manometer.id_manometer', $cari);
		$nama_manometer = $this->result_generator('like', 'manometer.nama_manometer', $cari);
		$total_nama_manometer = $this->result_total('like', 'manometer.nama_manometer', $cari);
		$lokasi = $this->result_generator('like', 'manometer.lokasi', $cari);
		$total_lokasi = $this->result_total('like', 'manometer.lokasi', $cari);
		if ($username) {
			$result->rows = $username;
			$result->total = $total_username;
		}
		if ($nama) {
			$result->rows = $nama;
			$result->total = $total_nama;
		}
		if ($id_manometer) {
			$result->rows = $id_manometer;
			$result->total = $total_id_manometer;
		}
		if ($nama_manometer) {
			$result->rows = $nama_manometer;
			$result->total = $total_nama_manometer;
		}
		if ($lokasi) {
			$result->rows = $lokasi;
			$result->total = $total_lokasi;
		}
		return $result;
	}

	function result_generator($method, $field, $value)
	{
		if ($this->sort) $this->db->order_by($this->sort, $this->order);
		if ($this->tgl) $this->db->where('DATE(manometer.tgl_baca_s)', $this->tgl);
		if ($method == "where") $this->db->where($field, $value);
		else $this->db->like($field, $value);
		$this->db
			->select(
				"manometer.ID as ID, 
				manometer.id_manometer as id_manometer, 
				manometer.nama_manometer as nama_manometer, 
				manometer.lokasi as lokasi, 
				manometer.latlng as latlng, 
				manometer.username as username, 
				manometer.kondisi as kondisi, 
				manometer.tekanan as tekanan, 
				manometer.keterangan as keterangan, 
				manometer.tgl_baca_s as tgl_baca_s, 
				v_pegawai.nama as nama"
			)
			->from("manometer")
			->join('v_pegawai', 'manometer.username = v_pegawai.nipam')
			->limit($this->rows, $this->pos);
		$result = $this->db->get()->result();
		return $result;
	}

	function result_total($method, $field, $value)
	{
		if ($this->tgl) $this->db->where('DATE(manometer.tgl_baca_s)', $this->tgl);
		if ($method == "where") $this->db->where($field, $value);
		else $this->db->like($field, $value);
		$this->db
			->select('count(manometer.ID) as total')
			->from("manometer")
			->join($this->join, $this->joinVpegawai, 'INNER');
		$result = $this->db
			->get()
			->result()[0]
			->total;
		return $result;
	}

	public function Report($username, $tahun, $bulan)
	{
		$result = (object)[];
		$result->user = $this->findUserReport($username);
		$result->manometer = $this->findListManoReport($username, $tahun, $bulan);
		$result->data = $this->findManoReport($username, $tahun, $bulan);
		return $result;
	}

	function findUserReport($username)
	{
		return $this->db
			->select(
				"v_bagian.nipam, 
			v_bagian.nama, 
			v_bagian.org_name"
			)
			->from("v_bagian")
			->where('nipam', $username)
			->get()
			->row();
	}

	function findListManoReport($username, $tahun, $bulan)
	{
		$where = [
			'manometer.username' => $username,
			'YEAR(manometer.tgl_baca_s)' => $tahun,
			'MONTH(manometer.tgl_baca_s)' => $bulan
		];
		$order = "manometer.tgl_baca_s ASC, manometer.nama_manometer ASC";

		return $this->db
			->select(
				"manometer.id_manometer, 
				manometer.nama_manometer,
				manometer.lokasi"
			)
			->from('manometer')
			->where($where)
			->group_by("manometer.id_manometer")
			->order_by($order)
			->get()
			->result();
	}

	function findManoReport($username, $tahun, $bulan)
	{
		$where = [
			'manometer.username' => $username,
			'YEAR(manometer.tgl_baca_s)' => $tahun,
			'MONTH(manometer.tgl_baca_s)' => $bulan
		];
		$order = "manometer.tgl_baca_s ASC, manometer.nama_manometer ASC";

		return $this->db
			->select(
				"manometer.id_manometer, 
				manometer.nama_manometer, 
				manometer.lokasi, 
				manometer.tgl_baca_s,
				DAY(manometer.tgl_baca_s) as tgl,
				manometer.tekanan"
			)
			->from('manometer')
			->where($where)
			->order_by($order)
			->get()
			->result();
	}

	public function getListPetugas()
	{
		return $this->db
			->select("manometer.username, v_pegawai.nama")
			->from("manometer")
			->join("v_pegawai", "manometer.username = v_pegawai.nipam")
			->group_by("manometer.username")
			->order_by("v_pegawai.nama")
			->get()
			->result();
	}
}
