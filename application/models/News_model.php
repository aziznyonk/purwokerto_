<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model
{
	function newsListing()
	{
		$this->db->select('*');
        $this->db->from('news');
        $query = $this->db->get();

        $result = $query->result();

        return $result;
	}
	function newsListing_details($id)
	{
		$this->db->select('*');
        $this->db->from('news');
		$this->db->where('ID', $id);
        $query = $this->db->get();

        $result = $query->result();

        return $result;
	}
	function newsListing_save($id)
	{
		$data = array(
		   'judul' 		=> $this->input->post('judul'),
		   'tgl_input' 		=> $this->input->post('tgl_input'),
		   'isiBerita' 		=> $this->input->post('isiBerita')	
		);
		$this->db->where('id', $id);
		$this->db->update('news', $data); 
	}
}
?>