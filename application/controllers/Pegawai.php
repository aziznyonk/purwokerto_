<?php

class Pegawai extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('PegawaiModel');
    }

    public function cari($org_code = null)
    {
        if ($org_code == null) return;
        $res = $this->PegawaiModel->cari($org_code);
        echo json_encode($res);
    }
}
