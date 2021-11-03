<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Kml_model extends CI_Model
{
	function pelaListing()
    {
        $this->db->select('*');
        $this->db->from('pelanggan_pwt');
        $query = $this->db->get();
        $result = $query->result_array();
		return $result;
    }
	function mbrListing()
    {
        $this->db->select('*');
        $this->db->from('sr_mbr');
        //$this->db->limit('25');
        $query = $this->db->get();
        $result = $query->result_array();
		return $result;
    }
	function pipaListing()
    {
        $this->db->select('*');
        $this->db->from('pipa_rencana');
		$query = $this->db->get();
        $result = $query->result_array();
		
		return $result;
    }
}
?>