<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/BaseController.php';

class MasterTekanan extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MasterTekanan_model');
        $this->isLoggedIn();
    }

    public function index()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['title'] = 'Master Tekanan';
            $this->global['cusScript'] = '<script src="' . base_url() . 'assets/custom/js/masterTekanan.js"></script>';
            $this->loadViews('masterTekanan/manometer', $this->global, [], null);
        }
    }

    public function ListTekanan()
    {
        $res = $this->MasterTekanan_model->listTekanan();
        if (count((array)$res) == 0) {
            echo json_encode(["rows" => [], "total" => 0]);
            return;
        }
        echo json_encode($res);
    }

    public function Search($id)
    {
        $res = $this->MasterTekanan_model->find($id);
        echo json_encode($res);
    }

    public function Update($id = null)
    {
        $res = $this->MasterTekanan_model->update($id);
        echo json_encode($res);
    }
}
