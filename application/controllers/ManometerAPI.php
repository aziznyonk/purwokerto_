<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManometerAPI extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('tekanan_model');
		$this->load->model('Pipa_model');
	}

	public function getDataTekanan()
	{
		$result = $this->tekanan_model->tekananListing();
		if (count((array)$result) == 0) {
			echo json_encode(["rows" => [], "total" => 0]);
			return;
		}
		echo json_encode($result);
	}

	public function getDetailTekanan($ID)
	{
		$res = $this->tekanan_model->tekananDetail($ID);
		echo json_encode($res);
	}

	//getting map view
	public function getMap($lat, $long)
	{
		$data['lat'] = $lat;
		$data['long'] = $long;
		$this->load->view('manometer/maps', $data);
	}
}
