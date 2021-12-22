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

    public function Tekanan($username = null, $tahun = null, $bulan = null)
    {
        if ($username == null or $tahun == null or $bulan == null) {
            echo "Something Wrong Broo!!!";
            return;
        }
        $this->load->library('parser');
        $result = (object)[];
        $data = $this->Tekanan_model->Report($username, $tahun, $bulan);
        $result->nama = $data->user->nama;
        $result->cabang = $data->user->org_name;
        $result->manometer = $data->manometer;
        $result->data = $data->data;
        $result->tahun = $tahun;
        $result->bulan = getBulan($bulan);
        $this->parser->parse('Report/r_tekanan', (array)$result);
    }
}
