<?php defined('BASEPATH') or exit('No direct script access allowed');

class BaseController extends CI_Controller
{
    protected $role = '';
    protected $vendorId = '';
    protected $name = '';
    protected $username = '';
    protected $global = array();

    public function response($data = NULL)
    {
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(
                json_encode(
                    $data,
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
                )
            )
            ->_display();
        exit();
    }

    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            redirect('index.php/login');
        } else {
            $this->role     = $this->session->userdata('role');
            $this->Id       = $this->session->userdata('ID');
            $this->name     = $this->session->userdata('nama');
            $this->username = $this->session->userdata('username');

            $this->global['name'] = $this->name;
            $this->global['role'] = $this->role;
            $this->global['username'] = $this->username;
        }
    }
    function isAdmin()
    {
        if ($this->role == "Super Admin") {
            return true;
        } else {
            return false;
        }
    }
    function logout()
    {
        $this->session->sess_destroy();

        $data['title'] = 'Login';
        redirect('index.php/login', $data);
    }
    function loadThis()
    {
        $this->global['title'] = '404';

        $this->load->view('tamplate/header', $this->global);
        $this->load->view('404');
        $this->load->view('tamplate/footer');
    }
    function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL)
    {

        $this->load->view('tamplate/header', $headerInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('tamplate/footer', $footerInfo);
    }
    
    function loadViewsUser($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL)
    {

        $this->load->view('tamplate/userHeader', $headerInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('tamplate/userFooter', $footerInfo);
    }
}
