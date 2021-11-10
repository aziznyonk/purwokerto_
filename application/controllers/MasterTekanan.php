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
            $this->loadViews('manometer/tekanan', $this->global, [], null);
        }
    }
}
