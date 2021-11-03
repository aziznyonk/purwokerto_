<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('login_model');
    }

	public function index(){
        $this->isLoggedIn();
	}

	public function  isLoggedIn (){
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $data ['title'] = "Login";
            $this->load->view('login', $data);
        }
        else
        {
            redirect('index.php/dashboard');
        }
    }

    public function loginMe(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required|max_length[32]|min_length[5]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]|min_length[4]');

        if($this->form_validation->run() == FALSE){
            $this->index();
        }else{
            $username = strtolower($this->security->xss_clean($this->input->post('username')));
            $password = $this->input->post('password');

            $result = $this->login_model->loginMe($username, md5($password));

            if(!empty($result)){
                $sessionArray = array('ID'=>$result->ID, 'nama'=>$result->nama, 'username'=>$result->username, 'role'=>$result->role, 'isLoggedIn' => TRUE);
                $this->session->set_userdata($sessionArray);
                redirect('index.php/dashboard');

            }else {
                $this->session->set_flashdata('error', 'Email or Password mismatch');
                echo "Salah result : "+$result;

            }
        }
    }

}
