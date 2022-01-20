<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('CustModel');
    }

    /*Pelanngan Model*/
    function pelaListing($offset = null, $rows = null, $nopel = null, $nama = null, $alamat = null, $surv = null)
    {
        $result = (object)[];
        if ($nopel != null) $r = $this->pelaNoPel($nopel);
        elseif ($nama != null) $r = $this->pelaNama($offset, $rows, $nama);
        elseif ($alamat != null) $r = $this->pelaAlamat($offset, $rows, $alamat);
        elseif ($surv != null) $r = $this->pelaSurv($offset, $rows, $surv);
        else $r = $this->pelaDefault($offset, $rows);
        $result = $this->resultGenerator($r);
        return $result;
    }

    function pelaListing_edit($id)
    {
        $this->db->select('*');
        $this->db->from('pelanggan_pwt');
        $this->db->where('ID', $id);
        $query = $this->db->get();

        $r['rows'] = $query->result();
        $r['total'] = 1;
        $result = $this->resultGenerator($r);
        return $result;
    }

    function pelaListing_save($id)
    {
        $data = array(

            'nama'          => $this->input->post('nama'),
            'alamat'        => $this->input->post('alamat'),
            'nomor_pela'    => $this->input->post('nomor_pela'),
            'klasifikasi'   => $this->input->post('klasifikasi'),
            'cabang'        => $this->input->post('cabang'),
            'status'        => $this->input->post('status'),
            'latlng'        => $this->input->post('latlng')
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
        $r['rows'] = $query->result();
        $r['total'] = 1;
        $result = $this->resultGenerator($r);
        return $result['rows'];
    }

    function pelaDefault($offset, $rows)
    {
        $this->db->select(
            'ID, 
            id_survey, 
            nomor_pela, 
            nama, 
            alamat, 
            status, 
            klasifikasi, 
            dma, 
            golongan, 
            cabang, 
            zona_baca_, 
            keterangan, 
            username, 
            latlng,
            tgl_input'
        );
        $this->db->from('pelanggan_pwt');
        $this->db->limit($offset, $rows);
        $query = $this->db->get();
        $tot = $this->db->count_all('pelanggan_pwt');
        return ["rows" => $query->result(), "total" => $tot];
    }

    function pelaNoPel($nomor_pela)
    {
        $this->db->select(
            'ID, 
            id_survey, 
            nomor_pela, 
            nama, 
            alamat, 
            status, 
            klasifikasi, 
            dma, 
            golongan, 
            cabang, 
            zona_baca_, 
            keterangan, 
            username, 
            latlng,
            tgl_input'
        );
        $this->db->from('pelanggan_pwt');
        $this->db->where('nomor_pela', $nomor_pela);
        $query = $this->db->get();
        $result = $query->result();
        $tot = count($result);
        return ["rows" => $result, "total" => $tot];
    }

    function pelaNama($offset, $rows, $nama)
    {
        $this->db->select(
            'ID, 
            id_survey, 
            nomor_pela, 
            nama, 
            alamat, 
            status, 
            klasifikasi, 
            dma, 
            golongan, 
            cabang, 
            zona_baca_, 
            keterangan, 
            username, 
            latlng,
            tgl_input'
        );
        $this->db->from('pelanggan_pwt');
        $this->db->like('nama', $nama);
        $this->db->limit($offset, $rows);
        $query = $this->db->get();
        $result = $query->result();
        $tot = $this->db->select('COUNT(ID) AS total')->like('nama', $nama)->get('pelanggan_pwt')->result()[0]->total;
        return ["rows" => $result, "total" => $tot];
    }

    function pelaAlamat($offset, $rows, $alamat)
    {
        $this->db->select(
            'ID, 
            id_survey, 
            nomor_pela, 
            nama, 
            alamat, 
            status, 
            klasifikasi, 
            dma, 
            golongan, 
            cabang, 
            zona_baca_, 
            keterangan, 
            username, 
            latlng,
            tgl_input'
        );
        $this->db->from('pelanggan_pwt');
        $this->db->like('alamat', $alamat);
        $this->db->limit($offset, $rows);
        $query = $this->db->get();
        $result = $query->result();
        $tot = $this->db->select('COUNT(ID) AS total')->like('alamat', $alamat)->get('pelanggan_pwt')->result()[0]->total;
        return ["rows" => $result, "total" => $tot];
    }

    function pelaSurv($offset, $rows, $uname)
    {
        $this->db->select(
            'ID, 
            id_survey, 
            nomor_pela, 
            nama, 
            alamat, 
            status, 
            klasifikasi, 
            dma, 
            golongan, 
            cabang, 
            zona_baca_, 
            keterangan, 
            username, 
            latlng,
            tgl_input'
        );
        $this->db->from('pelanggan_pwt');
        $this->db->where('username', $uname);
        $this->db->limit($offset, $rows);
        $query = $this->db->get();
        $tot = count($this->db->where('username', $uname)->get('pelanggan_pwt')->row_array());
        return ["rows" => $query->result(), "total" => $tot];
    }

    private function resultGenerator($r)
    {
        $result = [];
        $arrNosamw = array_reduce($r['rows'], function ($rs, $a) {
            $rs[] = $a->nomor_pela;
            return $rs;
        }, []);

        $detail = $this->CustModel->findDetail($arrNosamw);
        $rows = array_reduce($r['rows'], function ($rs, $a) use ($detail) {
            $nosamw = $a->nomor_pela;
            $det = array_reduce($detail, function ($rs, $x) use ($nosamw) {
                if ($x->nosamw == $nosamw) $rs = $x;
                return $rs;
            }, (object)[]);

            $o = (object)[];
            if ($detail != null) {
                $o = $a;

                $o->desa_bill = $det->desa;
                $o->kecamatan = $det->kecamatan;
                $o->zona_baca = $det->zona_baca;
                $o->tgl_spk = $det->tgl_spk;
                $o->tgl_pas = $det->tgl_pas;
                $o->cabang = $det->cabang;
                $o->dma = $det->dia_met;
                $o->golongan = $det->golongan;
            }
            $rs[] = $a;
            return $rs;
        }, []);
        $result['rows'] = $rows;
        $result['total'] = $r['total'];
        return $result;
    }
}
