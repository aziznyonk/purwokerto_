<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CustModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->bill = $this->load->database('bill', true);
    }

    function findDetail($data = [])
    {
        $result = $this->bill
            ->select(
                'cust.nosamw, 
                cust.nama, 
                cust.desa, 
                cust.kecamatan, 
                pegawai.Nama AS zona_baca, 
                cust.tgl_pas, 
                mlokasi.nm_lokasi AS cabang, 
                cust.dia_met, 
                cust.tgl_spk, 
                cust.urjlwp AS golongan'
            )
            ->from('cust')
            ->join('pegawai', 'cust.ptgs_met = pegawai.NIK')
            ->join('mlokasi', 'LEFT(cust.nosamw,2) = mlokasi.kd_lokasi')
            ->where_in('nosamw', $data)
            ->get();
        return $result->result();
    }
}
