<?php

class Cabang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('CabangModel');
    }

    function index()
    {
        $res = $this->CabangModel->showAll();
        echo json_encode($res);
    }
}
