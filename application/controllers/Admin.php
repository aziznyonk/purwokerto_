<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/BaseController.php';


class Admin extends BaseController {
    function __construct(){
        parent::__construct();
        $this->load->model('admin_model');
        $this->isLoggedIn();
    }
    public function index()
    {
        $this->global['title'] = 'Administrator';
        $data['adminRecords'] = $this->admin_model->adminListing();
        $this->loadViews('administrator/admin', $this->global, $data, null);

        /*if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else{

        }*/
    }
}