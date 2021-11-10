<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';


class Dashboard extends BaseController {
    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->isLoggedIn();
    }
    public function index()
    {
        $this->global['title'] = 'Dashboard';
        $this->loadViews('dashboard', $this->global, null, null);
    }
}