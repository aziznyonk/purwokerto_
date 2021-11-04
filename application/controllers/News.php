<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/BaseController.php';

class News extends BaseController 
{
	function __construct(){
        parent::__construct();
        $this->load->model('news_model');
        $this->isLoggedIn();
    }
	public function index()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else{
			$this->global['title'] = 'Hot News';
			$data['newsRecords'] = $this->news_model->newsListing();
			$this->loadViews('news/news', $this->global, $data, null);

        }
    }
	public function details_news()
	{
		$id = $this->uri->segment(3);
		if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else{
			$this->global['title'] 	= 'Hot News';
			$data['newsRecords'] 	= $this->news_model->newsListing_details($id);
			$this->loadViews('news/news_details', $this->global, $data, null);

        }
	}
	public function edit_news()
	{
		$id = $this->uri->segment(3);
		if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else{
			$this->global['title'] 	= 'Hot News';
			$data['echo']			= "none";
			$data['ech']			= "none";
			$data['newsRecords'] 	= $this->news_model->newsListing_details($id);
			$this->loadViews('news/news_edit', $this->global, $data, null);

        }
	}
	public function save_news()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
		$this->form_validation->set_rules('tgl_input', 'Tgl_input', 'trim|required');
        $this->form_validation->set_rules('isiBerita', 'IsiBerita', 'trim|required');
		
		if($this->form_validation->run() == FALSE){
			$id = $this->input->post('id');
			$this->global['title'] 	= 'Hot News';
			$data['echo']			= "block";
			$data['ech']			= "none";
			$data['pipaRecords'] 	= $this->news_model->newsListing_details($id);
			$this->loadViews('news/news_edit', $this->global, $data, null);
		}else{
			$id = $this->input->post('id');
			$result = $this->news_model->newsListing_save($id);
			if($result){
				$data['echo']			= "block";
				$data['ech']			= "none";
			} else {
				$data['echo']			= "none";
				$data['ech']			= "block";
			}	
			$this->global['title'] 	= 'Hot News';
			$data['newsRecords'] 	= $this->news_model->newsListing_details($id);
			$this->loadViews('news/news_edit', $this->global, $data, null);
		}
	}
}
?>