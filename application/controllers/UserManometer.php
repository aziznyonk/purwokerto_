<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/BaseController.php';

class UserManometer extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('tekanan_model');
        $this->load->model('Pipa_model');
    }

    public function index()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data = (object)[];
            $this->global['title'] = 'Manometer';
            $this->global['cusScript'] = '<script src="' . base_url() . 'assets/custom/js/tekanan.js"></script>';
            $this->global['mapScript'] = '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhp3-zMM6Z1-NM8FBefecBjnRQBIv08_8&v=weekly" async></script>';
            $data->petugas = $this->tekanan_model->getListPetugas();
            $this->loadViewsUser('manometer/tekanan', $this->global, $data);
        }
    }
}
