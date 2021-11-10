<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Db_model extends CI_Model{
		
		public function __construct() {
			parent::__construct();
			$this->eo = $this->load->database("eo", TRUE);
			$this->bill = $this->load->database("bill", TRUE);
		}
		
		/*LOGIN Model*/
		function loginMe($username, $password){
			$this->eo->select('BaseTbl.user_id as ID, BaseTbl.user_login as username, BaseTbl.p_gis as password');
			$this->eo->from('sys_user as BaseTbl');
			$this->eo->where('BaseTbl.user_login', $username);
			$query = $this->eo->get();
			
			$admin = $query->row();
			
			if(!empty($admin)){
				if($password===$admin->password){
					return $admin;
					} else {
					return array();
				}
				} else {
				return array();
			}
		}
		/*
			function loginMe($username, $password){
			$this->db->select('BaseTbl.ID, BaseTbl.nama, BaseTbl.username, BaseTbl.password, BaseTbl.id_role');
			$this->db->from('user as BaseTbl');
			$this->db->where('BaseTbl.username', $username);
			$query = $this->db->get();
			
			$admin = $query->row();
			
			if(!empty($admin)){
            if($password===$admin->password){
			return $admin;
            } else {
			return array();
            }
			} else {
            return array();
			}
		}*/
		
		/* SR MBR Model*/
		function insertSr_Mbr($sr_mbrInfo)
		{
			$this->db->trans_start();
			$this->db->insert('sr_mbr', $sr_mbrInfo);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			
			return $insert_id;
		}
		function getAllSr_mbr()
		{
			$this->db->select('*');
			$this->db->from('sr_mbr');
			$query = $this->db->get();
			$data  = array();
			foreach($query->result_object() as $row)
			{
				$datas  = array();
				$datas['ID']            = $row->ID;
				$datas['ID_']           = $row->ID_;
				$datas['usernmae']      =$row->username;
				$datas['nama']          =$row->nama;
				$datas['alamat']        =$row->alamat;
				$datas['almt_dipasang'] =$row->almt_dipasang;
				$datas['latlng']        =$row->latlng;
				$datas['ktp']           =$row->ktp;
				$datas['telfon']        =$row->telfon;
				$datas['daya_listrik']  =$row->daya_listrik;
				$datas['rt_biasa']      =$row->rt_biasa;
				$datas['pekerjaan']     =$row->pekerjaan;
				$datas['jml_penghuni']  =$row->jml_penghuni;
				$datas['smber_skrg']    =$row->smber_skrg;
				$datas['jarak']         =$row->jarak;
				$datas['lebar_jln']     =$row->lebar_jln;
				$datas['jaringan_distri']=$row->jaringan_distri;
				$datas['foto']          = base_url().'application/uploads/sr_mbr/'.$row->foto;
				array_push($data, $datas);
			}
			
			return $data;
		}
		function getCountAllSr_mbr()
		{
			$this->db->select('*');
			$this->db->from('sr_mbr');
			$query = $this->db->get();
			$data = count($query->result());
			
			return $data;
		}
		function getCountAllSr_mbrByUser()
		{
			$this->db->select('*');
			$this->db->from('sr_mbr');
			$query = $this->db->get();
			$data = count($query->result());
			
			return $data;
		}
		function getOneSr_mbrByID($ID_)
		{
			$this->db->select('*');
			$this->db->from('sr_mbr');
			$this->db->where('ID_',$ID_);
			$query = $this->db->get();
			$data = $query->result();
			
			return $data;
		}
		function searchSr_mbr($search)
		{
			$this->db->select('*');
			$this->db->from('sr_mbr');
			$this->db->like('ID_', $search);
			$this->db->or_like('nama', $search);
			$query = $this->db->get();
			$data   = array();
			foreach($query->result_object() as $row)
			{
				$datas  = array();
				$datas['ID']            = $row->ID;
				$datas['ID_']           = $row->ID_;
				$datas['usernmae']      =$row->username;
				$datas['nama']          =$row->nama;
				$datas['alamat']        =$row->alamat;
				$datas['almt_dipasang'] =$row->almt_dipasang;
				$datas['latlng']        =$row->latlng;
				$datas['ktp']           =$row->ktp;
				$datas['telfon']        =$row->telfon;
				$datas['daya_listrik']  =$row->daya_listrik;
				$datas['rt_biasa']      =$row->rt_biasa;
				$datas['pekerjaan']     =$row->pekerjaan;
				$datas['jml_penghuni']  =$row->jml_penghuni;
				$datas['smber_skrg']    =$row->smber_skrg;
				$datas['jarak']         =$row->jarak;
				$datas['lebar_jln']     =$row->lebar_jln;
				$datas['jaringan_distri']=$row->jaringan_distri;
				$datas['foto']          = base_url().'application/uploads/sr_mbr/'.$row->foto;
				array_push($data, $datas);
			}
			return $data;
		}
		
		/*Pipa*/
		function getAllPipa(){
			$this->db->select('BaseTbl.ID, BaseTbl.id_, BaseTbl.latlng, BaseTbl.panjang, BaseTbl.diameter, BaseTbl.bahan, BaseTbl.kedalamanp, BaseTbl.keterangan ');
			$this->db->from('pipa_rencana as BaseTbl');
			$query = $this->db->get();
			
			$result = $query->result();
			
			return $result;
		}
		function insertPipaDetails($pipaDetails)
		{
			$this->db->trans_start();
			$this->db->insert('pipa_rencana', $pipaDetails);
			$rows =  $this->db->affected_rows();
			$this->db->trans_complete();
			if($rows>0){
				return $rows;
				}else{
				return empty($rows);
			}
		}
		
		/*Koor Pelanggan*/
		function insertK_Pelanggan($k_pelangganInfo)
		{
			$this->db->trans_start();
			$this->db->insert('pelanggan_pwt', $k_pelangganInfo);
			$rows = $this->db->affected_rows();
			$this->db->trans_complete();
			
			if($rows>0){
				return $rows;
				}else{
				return empty($rows);
			}
		}
		function updateK_Pelanggan($k_pelangganInfo, $nomor_pela)
		{
			$this->db->trans_start();
			$this->db->where('nomor_pela', $nomor_pela);
			$this->db->update('pelanggan_pwt', $k_pelangganInfo);
			$rows = $this->db->affected_rows();
			$this->db->trans_complete();
			
			if($rows>0){
				return $rows;
				}else{
				return empty($rows);
			}
		}
		
		
		function update_Mbr($k_pelangganInfo, $nomor_pela)
		{
			$this->db->trans_start();
			$this->db->where('ID_', $nomor_pela);
			$this->db->update('sr_mbr', $k_pelangganInfo);
			$rows = $this->db->affected_rows();
			$this->db->trans_complete();
			
			if($rows>0){
				return $rows;
				}else{
				return empty($rows);
			}
		}
		
		//pengawas_model
		function updateK_Pengawas($k_pengawasInfo, $noWm){
			$this->db->trans_start();
			$this->db->where('noWm_', $noWm);
			$this->db->update('pengawas_sr', $k_pengawasInfo);
			$rows = $this->db->affected_rows();
			$this->db->trans_complete();
			
			if($rows>0){
				return $rows;
				}else{
				return empty($rows);
			}
		}
		function insertK_Pengawas($k_pengawasInfo)
		{
			$this->db->trans_start();
			$this->db->insert('pengawas_sr', $k_pengawasInfo);
			$rows = $this->db->affected_rows();
			$this->db->trans_complete();
			
			if($rows>0){
				return $rows;
				}else{
				return empty($rows);
			}
		}
		
		function getOneManometerByID($kode){
			$date =  date('Y-m');
			$this->db->select('*');
			$this->db->from('manometer');
			$this->db->where('id_manometer',$kode);
			$this->db->like('tgl_baca_s', '$date', 'Self'); 
			$query = $this->db->get();
			$data = $query->result();
			
			return $data;
		}
		
		// input Manometer
		function insertK_Manometer($k_manometerInfo)
		{
			$this->db->trans_start();
			$this->db->insert('manometer', $k_manometerInfo);
			$rows = $this->db->affected_rows();
			$this->db->trans_complete();
			
			if($rows>0){
				return $rows;
				}else{
				return empty($rows);
			}
		}
		function updateK_Manometer($k_manometerInfo, $id_manometer)
		{
			$date =  date('Y-m');
			$this->db->trans_start();
			$this->db->where('id_manometer', $id_manometer);
			$this->db->like('tgl_baca_s', '$date', 'Self'); 
			$this->db->update('manometer', $k_manometerInfo);
			$rows = $this->db->affected_rows();
			$this->db->trans_complete();
			
			if($rows>0){
				return $rows;
				}else{
				return empty($rows);
			}
		}
		
		
		function getOnePengawasByID($noWm)
		{
			$this->db->select('*');
			$this->db->from('pengawas_sr');
			$this->db->where('noWm_',$noWm);
			$query = $this->db->get();
			$data = $query->result();
			
			return $data;
		}
		
		function searchPengawas($search){
			$this->bill = $this->load->database("bill", TRUE);
			$this->bill->select('*,0 as lati,0 as longi');
			$this->bill->from('cust');
			$this->bill->where('nosamw',$search);
			$query = $this->bill->get();
			$result = $query->result();
			
			return $result;
		}
		
		
		function getOnePelangganByID($nomor_pela)
		{
			$this->db->select('*');
			$this->db->from('pelanggan_pwt');
			$this->db->where('nomor_pela',$nomor_pela);
			$query = $this->db->get();
			$data = $query->result();
			
			return $data;
		}
		
		function getMbrPelangganByID($nomor_pela)
		{
			$this->db->select('*');
			$this->db->from('sr_mbr');
			$this->db->where('ID_',$nomor_pela);
			$query = $this->db->get();
			$data = $query->result();
			
			return $data;
		}
		
		function searchPelanggan($search){
			$this->bill = $this->load->database("bill", TRUE);
			$this->bill->select('*,0 as lati,0 as longi');
			$this->bill->from('cust');
			$this->bill->where('nosamw',$search);
			$query = $this->bill->get();
			$result = $query->result();
			
			return $result;
		}
		
		function getAllManometer($id_user)
		{
			$this->db->select('*');
			$this->db->from('tekanan_manometer');
			$this->db->where('id_', $id_user);
			$query 	= $this->db->get();
			$data 	= count($query->result());
			
			return $data;
		}
		function searchManometer($search)
		{
			$this->db->select('*');
			$this->db->from('manometer_2018');
			$this->db->where('id_manometer', $search);
			$query 	= $this->db->get();
			$data 	= $query->result();
			
			return $data;
		}
		
		function insertTekananManometer($tekanan_mano){
			$this->db->trans_start();
			$this->db->insert('tekanan_manometer', $tekanan_mano);
			$rows = $this->db->affected_rows();
			$this->db->trans_complete();
			
			if($rows>0){
				return $rows;
				}else{
				return empty($rows);
			}
		}
		
		function getAllMeterinduk($id_user){
			$this->db->select('*');
			$this->db->from('debit_flourmeter');
			$this->db->like('id_', $id_user, 'before');
			$query 	= $this->db->get();
			$data 	= count($query->result());
			
			return $data;
		}
		function searchMeterinduk($search)
		{
			$this->db->select('*');
			$this->db->from('meter_induk');
			$this->db->where('kode_asset', $search);
			$query 	= $this->db->get();
			$data 	= $query->result();
			
			return $data;
		}
		
		function insertDebitMeterinduk($debit_meterinduk){
			$this->db->trans_start();
			$this->db->insert('debit_flourmeter', $debit_meterinduk);
			$rows = $this->db->affected_rows();
			$this->db->trans_complete();
			
			if($rows>0){
				return $rows;
				}else{
				return empty($rows);
			}
		}
		
		function getNews(){
			$this->db->select('*');
			$this->db->from('news');
			$query 	= $this->db->get();
			$data 	= $query->result();
			
			return $data;
		}
		
		function getTekananMano($id_mano){
			$this->db->select('*');
			$this->db->from('tekanan_manometer');
			$this->db->where('kd_mano', $id_mano);
			$this->db->limit(100);
			$query 	= $this->db->get();
			$data 	= $query->result();
			
			return $data;
		}
		
		function getDebitMeter($id_meter){
			$this->db->select('*');
			$this->db->from('debit_flourmeter');
			$this->db->where('kd_meterinduk', $id_meter);
			$this->db->limit(100);
			$query 	= $this->db->get();
			$data 	= $query->result();
			
			return $data;
		}
		
		/*assets*/
		function getOneAssetByKode($kd_asset){
			$this->db->select('kd_asset');
			$this->db->from('asset');
			$this->db->where('kd_asset',$kd_asset);
			$query = $this->db->get();
			$data = $query->num_rows();
			
			return $data;
		}
		
		function insertAsset($assetInfo){
			$this->db->trans_start();
			$this->db->insert('asset', $assetInfo);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			
			return $insert_id;
		}
	}								