<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/BaseController.php';

class UserAdd extends BaseController {

    function __construct()
    {
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
            $data['userRole'] = $this->user_model->getUserRoles();
            $this->loadViews('user/addUser', $this->global, $data, null);

        }
    }
    public function insertOneUser()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('fullname','Fullname','trim|required|max_length[50]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Cpassword','trim|required|matches[password]|max_length[20]');
        $this->form_validation->set_rules('role','Role','trim|required|numeric');
        $this->form_validation->set_rules('address','Address','trim|required|max_length[255]');

        if($this->form_validation->run() == FALSE)
        {
            $name = strtolower($this->input->post('fullname'));
            $username = strtolower($this->input->post('username'));
            $password = $this->input->post('password');
            $roleId = $this->input->post('role');
            $status = $this->input->post('status');
            $address = $this->input->post('address');

            $userInfo = array('nama'=> $name, 'username'=>$username, 'password'=>md5($password), 'id_role'=>$roleId,
                'status'=>$status,'alamat'=>$address);
            $data['data'] = $userInfo;
            $data['status'] = 'failed';
            $data['message'] = 'input user is invalid';
            echo json_encode($data);
            $this->index();
        }
        else
        {
            $name = strtolower($this->input->post('fullname'));
            $username = strtolower($this->input->post('username'));
            $password = $this->input->post('password');
            $roleId = $this->input->post('role');
            $status = $this->input->post('status');
            $address = $this->input->post('address');

            $userInfo = array('nama'=> $name, 'username'=>$username, 'password'=>md5($password), 'id_role'=>$roleId,
                'status'=>$status,'alamat'=>$address);

            $this->load->model('user_model');
            $result = $this->user_model->addNewUser($userInfo);

            if($result > 0)
            {
                $this->session->set_flashdata('success', 'New User created successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'User creation failed');
            }
            $data['data'] = $userInfo;
            $data['status'] = 'success';
            $data['message'] = 'input user is success';
            redirect('index.php/user');
        }
    }

    public function add50User()
    {
        for($c=1; $c<=35; $c++){
            $name = 'survey Admin PDAM';
            $username = 'survey'.$c;
            $password = 'sig'.$c;
            $roleId = 3;
            $address = 'Admin PDAM';
            $status = 'active';

            $userInfo = array('nama'=> $name, 'username'=>$username,'password'=>md5($password), 'id_role'=>$roleId, 'status'=>$status,
                'alamat'=>$address);

            if($c==1){
                $userInfo['ID'] = 1;
            }

            $this->load->model('user_model');
            $this->user_model->addNewUser($userInfo);
            echo $c;
        }
    }
}
