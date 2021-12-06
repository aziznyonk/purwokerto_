<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/BaseController.php';

class Report extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tekanan_model');
        $this->load->helper('bulan_helper');
    }

    public function Tekanan($username, $tahun, $bulan)
    {
        $data = $this->Tekanan_model->report($username, $tahun, $bulan);
        $data->tahun = $tahun;
        $data->bulan = getBulan($bulan);
        $this->load->view('Report/r_tekanan', $data);
    }
}
