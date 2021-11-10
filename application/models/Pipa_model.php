<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pipa_model extends CI_Model
{
	function pipaListing()
	{
		$this->db->select('*');
        $this->db->from('pipa');
        $query = $this->db->get();

        $result = $query->result();

        return $result;
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
?>