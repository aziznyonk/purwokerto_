<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/BaseController.php';


class User extends BaseController {
    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->isLoggedIn();
    }
    public function index()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else{
            $this->global['title'] = 'User';
            $data['userRecords'] = $this->user_model->userListing();
            $this->loadViews('user/user', $this->global, $data, null);
        }
    }
}