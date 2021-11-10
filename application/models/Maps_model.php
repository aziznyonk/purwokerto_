<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Maps_model extends CI_Model
{
	function getMapTekanan()
	{
		$hari = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('manometer');
		$this->db->join('v_pegawai', 'manometer.username= v_pegawai.nipam');
		// $this->db->like('tgl_baca_s', $hari);
		$this->db->order_by('ID', 'desc');
		$query = $this->db->get();
		$result = $query->result_object();
		return $result;
	}

	function getMapManometer()
	{
		$this->db->select('*');
		$this->db->from('manometer_2018');
		$this->db->group_by('id_manometer');
		$query = $this->db->get();
		$result = $query->result_object();
		return $result;
	}

	function getMapMeter()
	{
		$this->db->select('*');
		$this->db->from('meter_induk');
		$query = $this->db->get();

		$result = $query->result_object();
		return $result;
	}
	function getMapVelve()
	{
		$this->db->select('*');
		$this->db->from('valve');
		$query = $this->db->get();

		$result = $query->result_object();
		return $result;
	}
	function getMapDop()
	{
		$this->db->select('*');
		$this->db->from('dop');
		$query = $this->db->get();

		$result = $query->result_object();
		return $result;
	}
	function getMapFhydrant()
	{
		$this->db->select('*');
		$this->db->from('firehydrant');
		$query = $this->db->get();

		$result = $query->result_object();
		return $result;
	}
	function getMapGiboult()
	{
		$this->db->select('*');
		$this->db->from('giboult');
		$query = $this->db->get();

		$result = $query->result_object();
		return $result;
	}
	function getMapJembatan()
	{
		$this->db->select('*');
		$this->db->from('jembatan_pipa');
		$query = $this->db->get();

		$result = $query->result_object();
		return $result;
	}
	function getMapKnie()
	{
		$this->db->select('*');
		$this->db->from('knie');
		$query = $this->db->get();

		$result = $query->result_object();
		return $result;
	}

	function getMapPompa()
	{
		$this->db->select('*');
		$this->db->from('pompa');
		$query = $this->db->get();

		$result = $query->result_object();
		return $result;
	}

	function getMapTee()
	{
		$this->db->select('*');
		$this->db->from('tee');
		$query = $this->db->get();

		$result = $query->result_object();
		return $result;
	}
	function getMapPelanggan()
	{
		$this->db->select('*');
		$this->db->from('pelanggan_pwt');
		$query = $this->db->get();

		$result = $query->result_object();
		return $result;
	}
	function getOnePelanggan($search)
	{
		$this->db->select('*');
		$this->db->from('pelanggan_pwt');
		$this->db->where('nomor_pela', $search);
		$query = $this->db->get();

		$result = $query->result_object();
		return $result;
	}
	function getMapPelangganMBR()
	{
		$this->db->select('*');
		$this->db->from('sr_mbr');
		$query = $this->db->get();

		$result = $query->result_object();
		return $result;
	}
	function getOnePelangganMBR($search)
	{
		$this->db->select('*');
		$this->db->from('sr_mbr');
		$this->db->where('ID_', $search);
		$query = $this->db->get();

		$result = $query->result_object();
		return $result;
	}
	/*pipa*/
	function getPipaMaps()
	{
		$this->db->select('*');
		$this->db->from('pipa');
		$query  = $this->db->get();

		$result = $query->result_object();
		return $result;
	}
	function getPipaRencanaMaps()
	{
		$this->db->select('*');
		$this->db->from('pipa_rencana');
		$query  = $this->db->get();

		$result = $query->result_object();
		return $result;
	}

	/*Tekanan Map*/
	function getTekananPipaMap()
	{
		$query  = $this->db->query('SELECT * FROM `pipa` JOIN tekanan_manometer ON pipa.kd_manometer = tekanan_manometer.kd_mano AND tekanan_manometer.id = (SELECT MAX(id) from tekanan_manometer where kd_mano = pipa.kd_manometer)');

		$result = $query->result_object();
		return $result;
	}
	function getMapSumDebit()
	{
		$query  = $this->db->query('SELECT kd_meterinduk, SUM(debit) AS debit FROM `debit_flourmeter`');;

		$result = $query->row();
		return $result;
	}
}
