<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
{
    /*Pelanngan Model*/
    function pelaListing($offset = null, $rows = null, $nopel = null, $nama = null, $surv = null)
    {
        $result = (object)[];
        if ($nopel != null) $r = $this->pelaNoPel($nopel);
        elseif ($nama != null) $r = $this->pelaNama($nama);
        elseif ($surv != null) $r = $this->pelaSurv($offset, $rows, $surv);
        else $r = $this->pelaDefault($offset, $rows);
        $result->rows = [];
        foreach ($r['data'] as $d) {
            $d->action = '<a href="#" data-toggle="modal" data-target="#editModal" onclick=editData(' . $d->ID . ') class="btn btn-small"><i class="icon fa fa-pencil" title="edit"></i></a>'
                . '<a onclick="deleteFunction(' . $d->ID . ')" class="btn btn-small text-danger"><i class="icon fa fa-trash" title="delete"></i></a>';
            array_push($result->rows, $d);
        }
        $result->total = $r['tot'];
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

            'nama'             => $this->input->post('nama'),
            'alamat'         => $this->input->post('alamat'),
            'nomor_pela'     => $this->input->post('nomor_pela'),
            'klasifikasi'     => $this->input->post('klasifikasi'),
            'cabang'         => $this->input->post('cabang'),
            'status'         => $this->input->post('status'),
            'latlng'            => $this->input->post('latlng')
        );
        $this->db->where('ID', $id);
        $this->db->update('pelanggan_pwt', $data);
    }

    function pelaListing_delete($ID)
    {
        $this->db->where('ID', $ID);
        $this->db->delete('pelanggan_pwt');
    }

    function pelaId($id)
    {
        $this->db->from('pelanggan_pwt');
        $this->db->where('ID', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function pelaDefault($offset, $rows)
    {
        $this->db->select('ID, id_survey, nomor_pela, nama, alamat, status, klasifikasi, dma, golongan, cabang, zona_baca_, keterangan, username, tgl_input');
        $this->db->from('pelanggan_pwt');
        $this->db->limit($offset, $rows);
        $query = $this->db->get();
        $tot = $this->db->count_all('pelanggan_pwt');
        return ["data" => $query->result(), "tot" => $tot];
    }

    function pelaNoPel($nomor_pela)
    {
        $this->db->select('ID, id_survey, nomor_pela, nama, alamat, status, klasifikasi, dma, golongan, cabang, zona_baca_, keterangan, username, tgl_input');
        $this->db->from('pelanggan_pwt');
        $this->db->where('nomor_pela', $nomor_pela);
        $query = $this->db->get();
        $result = $query->result();
        $tot = count($result);
        return ["data" => $result, "tot" => $tot];
    }

    function pelaNama($nama)
    {
        $this->db->select('ID, id_survey, nomor_pela, nama, alamat, status, klasifikasi, dma, golongan, cabang, zona_baca_, keterangan, username, tgl_input');
        $this->db->from('pelanggan_pwt');
        $this->db->like('nama', $nama);
        $query = $this->db->get();
        $result = $query->result();
        $tot = count($result);
        return ["data" => $result, "tot" => $tot];
    }

    function pelaSurv($offset, $rows, $uname)
    {
        $this->db->select('ID, id_survey, nomor_pela, nama, alamat, status, klasifikasi, dma, golongan, cabang, zona_baca_, keterangan, username, tgl_input');
        $this->db->from('pelanggan_pwt');
        $this->db->where('username', $uname);
        $this->db->limit($offset, $rows);
        $query = $this->db->get();
        $tot = count($this->db->where('username', $uname)->get('pelanggan_pwt')->row_array());
        return ["data" => $query->result(), "tot" => $tot];
    }
}
