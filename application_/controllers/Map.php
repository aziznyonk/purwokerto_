<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Map extends CI_Controller {
		public function index() {
			$this->load->library('googlemaps');
			$config['center'] = '-7.431391, 109.247833';
			$config['zoom'] = '11';
			$config['cluster'] = TRUE;
			$config['averageCenter'] = TRUE;
			$config['styles'] = array(
            array("name"=>"No Businesses", "definition"=>array(
			array("featureType"=>"poi.business", "elementType"=>"labels", "stylers"=>array(array("visibility"=>"off")))
            ))
			);
			$this->googlemaps->initialize($config);
			
			$data['map'] = $this->googlemaps->create_map();
			$data['title'] = 'Web GIS';
			$this->load->view('maps', $data);
		}
		
		public function mapTekanan(){
			header("Content-Type: application/json; charset=UTF-8");
			$this->load->model('maps_model');
			$result = $this->maps_model->getMapTekanan();
			if (!empty($result)){
				$marker = array();
				foreach ($result as $row){
					$datas = array();
					$datas['nomor_pela']    = 'Tekanan';
					$datas['content']       = '<div class="info_content">
					<table class="table">
					<tr>
					<td><h4>Data Tekanan</h4></td>
					</tr>
					<tr>
					<tr>
					<td>Tanggal Baca</td>
					<td>: '.$row->tgl_baca_s.'</td>
					</tr>
					<td>Kode Manometer</td>
					<td>: '.$row->id_manometer.'</td>
					</tr>
					<tr>
					<td>Nama Assest</td>
					<td>: '.$row->nama_manometer.'</td>
					</tr>
					<tr>
					<td>Lokasi</td>
					<td>: '.$row->lokasi.'</td>
					</tr>
					<tr>
					<td>Tekanan</td>
					<td>: '.$row->tekanan.'</td>
					</tr>
					<tr>
					<td>Kondisi</td>
					<td>: '.$row->kondisi.'</td>
					</tr>
					<tr>
					<td>Petugas</td>
					<td>: '.$row->nama.'</td>
					</tr>
					<tr>
					<td>Keterangan</td>
					<td>: '.$row->keterangan.'</td>
					</tr>
					<td>Foto</td>
					<td><img src='.$row->path.' alt="" border=3 height=200 width=200></img></td>
					</tr>
					</table>
					</div>';
					$pres                   = $row->tekanan;
					$datap               	= json_decode($pres, true);
					
					$latlng                 = $row->latlng;
					$dataa                  = json_decode($latlng, true);
					
					$datas['lat']           = (float) $dataa[0]['geometry'][0];
					$datas['lng']           = (float) $dataa[0]['geometry'][1];
					
					$datas['pres']           = $datap;
					
					array_push($marker, $datas);
				}
				}else{
				$marker = null;
			}
			echo json_encode($marker);
		}
		
		public function mapManometer(){
			header("Content-Type: application/json; charset=UTF-8");
			$this->load->model('maps_model');
			
			$result = $this->maps_model->getMapManometer();
			
			if (!empty($result)){
				$marker = array();
				foreach ($result as $row){
					$datas = array();
					$datas['nomor_pela']    = 'Manometer';
					$datas['content']       = '<div class="info_content">
					<table class="table">
					<tr>
					<td><h4>Data Manometer</h4></td>
					</tr>
					<tr>
					<td>Kode Manometer</td>
					<td>: '.$row->id_manometer.'</td>
					</tr>
					
					<tr>
					<td>Nama Assest</td>
					<td>: '.$row->nama_manometer.'</td>
					</tr>
					<tr>
					<td>Cabang</td>
					<td>: '.$row->cabang.'</td>
					</tr>
					<tr>
					<td>Spam</td>
					<td>: '.$row->spam.'</td>
					</tr>
					<tr>
					<td>Koneksi</td>
					<td>: '.$row->koneksi_pipa.'</td>
					</tr>
					<tr>
					<td>Lokasi</td>
					<td>: '.$row->lokasi.'</td>
					</tr>
					<tr>
					<td>Petugas</td>
					<td>: '.$row->penanggung_jawab.'</td>
					</tr>
					
					</table>
					</div>';
					$pres                   = $row->nama_manometer;
					$datap               = json_decode($pres, true);
					
					$latlng                 = $row->latlng;
					$dataa       			= json_decode($latlng, true);
					
					$datas['lat']       	= (float) $dataa[0]['geometry'][0];
					$datas['lng']       	= (float) $dataa[0]['geometry'][1];
					
					$datas['pres']           = $datap;
					
					array_push($marker, $datas);
				}
				}else{
				$marker = null;
			}
			echo json_encode($marker);
		}
		
		public  function mapMeter(){
			header("Content-Type: application/json; charset=UTF-8");
			$this->load->model('maps_model');
			
			$result = $this->maps_model->getMapMeter();
			
			if (!empty($result)){
				$marker = array();
				foreach ($result as $row){
					$datas = array();
					$datas['nomor_pela']    = 'Meter Induk';
					$datas['content']       = '<div class="info_content">
					<table class="table">
					<tr>
					<td><h4>Meter Induk</h4></td>
					</tr>
					<tr>
					<td>Kode Assest</td>
					<td>: '.$row->kode_asset.'</td>
					</tr>
					<tr>
					<td>Merek</td>
					<td>: '.$row->merk.'</td>
					</tr>
					<tr>
					<td>Tanggal Pasang</td>
					<td>: '.$row->tgl_pasang.'</td>
					</tr>
					<tr>
					<td>Kondisi</td>
					<td>: '.$row->kondisi.'</td>
					</tr>
					<tr>
					<td>Keterangan</td>
					<td>: '.$row->keterangan.'</td>
					</tr>
					</table></div>';
					$latlng                 = $row->latlng;
					$dataa       			= json_decode($latlng, true);
					$datas['lat']       	= (float) $dataa[0]['geometry'][0];
					$datas['lng']       	= (float) $dataa[0]['geometry'][1];
					
					array_push($marker, $datas);
				}
				}else{
				$marker = null;
			}
			echo json_encode($marker);
		}
		public  function mapVelve()
		{
			header("Content-Type: application/json; charset=UTF-8");
			$this->load->model('maps_model');
			
			$result = $this->maps_model->getMapVelve();
			
			if (!empty($result)){
				$marker = array();
				foreach ($result as $row){
					$datas = array();
					$datas['nomor_pela']    = 'Valve';
					$datas['content']       = '<div class="info_content">
					<table class="table">
					<tr>
					<td><h4>Valve</h4></td>
					</tr>
					<tr>
					<td>Kode Assest</td>
					<td>: '.$row->kodeasset.'</td>
					</tr>
					<tr>
					<td>Jenis</td>
					<td>: '.$row->jenis.'</td>
					</tr>
					<tr>
					<td>Merek</td>
					<td>: '.$row->merk.'</td>
					</tr>
					<tr>
					<td>Diameter</td>
					<td>: '.$row->diameter.'</td>
					</tr>
					<tr>
					<td>Tanggal Pasang</td>
					<td>: '.$row->tanggalpas.'</td>
					</tr>
					<tr>
					<td>Kondisi</td>
					<td>: '.$row->kondisi.'</td>
					</tr>
					<tr>
					<td>Keterangan</td>
					<td>: '.$row->keterangan.'</td>
					</tr>
					</table></div>';
					$latlng                 = $row->latlng;
					$dataa       			= json_decode($latlng, true);
					$datas['lat']       	= (float) $dataa[0]['geometry'][0];
					$datas['lng']       	= (float) $dataa[0]['geometry'][1];
					
					array_push($marker, $datas);
				}
				}else{
				$marker = null;
			}
			echo json_encode($marker);
		}
		public  function mapPelanggan()
		{
			header("Content-Type: application/json; charset=UTF-8");
			$this->load->model('maps_model');
			
			$result = $this->maps_model->getMapPelanggan();
			
			if (!empty($result)){
				$marker = array();
				foreach ($result as $row){
					$datas = array();
					$datas['nomor_pela']    = $row->nomor_pela;
					$datas['content']       = '<div class="info_content">
					<p>
					<img src="http://103.25.210.61:81/purwokerto/application/uploads/pelanggan/'.$row->foto.'" height="350" width="350">
					</p>
					<table class="table">
					<tr>
					<td><b>Nomor Pelanggan</b></td>
					<td>: '.$row->nomor_pela.'</td>
					</tr>
					<tr>
					<td><b>Nama</b></td>
					<td>: '.$row->nama.'</td>
					</tr>
					<tr>
					<td><b>Alamat</b></td>
					<td>: '.$row->alamat.'</td>
					</tr>
					<tr>
					<td><b>Golongan</b></td>
					<td>: '.$row->golongan.'</td>
					</tr>
					<tr>
					<td><b>Status</b></td>
					<td>: '.$row->status.'</td>
					</tr>
					<tr>
					<td><b>Cabang</b></td>
					<td>: '.$row->cabang.'</td>
					</tr>
					<tr>
					<td><b>Zona Baca</b></td>
					<td>: '.$row->zona_baca_.'</td>
					</tr>
					<tr>
					<td><b>Klasifikasi</b></td>
					<td>: '.$row->klasifikasi.'</td>
					</tr>
					<tr>
					<td><b>ID Survey</b></td>
					<td> : '.$row->id_.'</td>
					</tr>
					</table>
					</div>';
					$latlng                 = $row->latlng;
					$dataa       			= json_decode($latlng, true);
					$datas['lat']       	= (float) $dataa[0]['geometry'][0];
					$datas['lng']       	= (float) $dataa[0]['geometry'][1];
					
					array_push($marker, $datas);
				}
				}else{
				$marker = null;
			}
			echo json_encode($marker);
		}
		public  function mapMbr()
		{
			header("Content-Type: application/json; charset=UTF-8");
			$this->load->model('maps_model');
			
			$result = $this->maps_model->getMapPelangganMBR();
			
			if (!empty($result)){
				$marker = array();
				$base   = base_url();
				foreach ($result as $row){
					$datas = array();
					$datas['nomor_pela']    = 'Pelanggan MBR';
					$datas['content']       = '<div class="info_content">
					<p>
					<img src="http://103.25.210.61:81/purwokerto/application/uploads/sr_mbr/'.$row->foto.'" height="350" width="350">
					</p>
					<table class="table">
					<tr>
					<td><h4>Pelanggan MBR</h4></td>
					</tr>
					<tr>
					<td>Nama</td>
					<td>: '.$row->nama.'</td>
					</tr>
					<tr>
					<td>Alamat</td>
					<td>: '.$row->alamat.'</td>
					</tr>
					<tr>
					<td>KTP</td>
					<td>: '.$row->ktp.'</td>
					</tr>
					<tr>
					<td>Nomor Telfon</td>
					<td>: '.$row->telfon.'</td>
					</tr>
					<tr>
					<td>Daya Listrik</td>
					<td>: '.$row->daya_listrik.'</td>
					</tr>
					<tr>
					<td>Tipe</td>
					<td>: '.$row->rt_biasa.'</td>
					</tr>
					<tr>
					<td>Pekerjaan</td>
					<td>: '.$row->pekerjaan.'</td>
					</tr>
					<tr>
					<td>ID Survey</td>
					<td>: '.$row->ID_.'</td>
					</tr>
					<tr>
					<td>Alamat Dipasang </td>
					<td>: '.$row->almt_dipasang.'</td>
					</tr>
					</table></div>';
					$latlng                 = $row->latlng;
					$dataa       			= explode(",", $latlng);
					$datas['lat']       	= (float)$dataa[0];
					$datas['lng']       	= (float)$dataa[1];
					
					array_push($marker, $datas);
				}
				}else{
				$marker = null;
			}
			echo json_encode($marker);
		}
		public function mapPipa()
		{
			header("Content-Type: application/json; charset=UTF-8");
			$this->load->model('maps_model');
			
			$result = $this->maps_model->getPipaMaps();
			
			if(!empty($result)){
				$polyline = array();
				foreach ($result as $row){
					$datas = array();
					$lines = array();                 
					$datas['lines']             = array();
					$datas['content']           = '<div class="info_content">
					<table class="table">
					<tr>
					<td><h4>'.$row->gid__2.'</h4></td>
					</tr>
					<tr>
					<td>Kode Asset</td>
					<td>: '.$row->kodeasset.'</td>
					</tr>
					<tr>
					<td>Cabang</td>
					<td>:'.$row->cabang.'</td>
					</tr>
					<tr>
					<td>Lokasi</td>
					<td>:'.$row->lokasi.'</td>
					</tr>
					<tr>
					<td>Diameter</td>
					<td>: '.$row->diameter.'</td>
					</tr>
					<tr>
					<td>Panjang</td>
					<td>: '.$row->panjang.'</td>
					</tr>
					<tr>
					<td>Bahan</td>
					<td>: '.$row->bahan.'</td>
					</tr>
					<tr>
					<td>Kedalaman</td>
					<td>: '.$row->kedalamanp.'</td>
					</tr>
					<tr>
					<td>Elevasi</td>
					<td>: '.$row->elevasi.'</td>
					</tr>
					<tr>
					<td>Status</td>
					<td>: '.$row->statuspipa.'</td>
					</tr>
					<tr>
					<td>Jenis Jaringan</td>
					<td>: '.$row->jenisjarin.'</td>
					</tr>
					<tr>
					<td>Tanggal Input</td>
					<td>: '.$row->tglinput.'</td>
					</tr>
					<tr>
					<td>Tanggal Perbaikan</td>
					<td>: '.$row->tanggalper.'</td>
					</tr>
					<tr>
					<td>No. SPK</td>
					<td>: '.$row->nospk.'</td>
					</tr>
					<tr>
					<td>Kode Manometer</td>
					<td>: '.$row->kd_manometer.'</td>
					</tr>
					<tr>
					<td>Keterangan</td>
					<td>: '.$row->keterangan.'</td>
					</tr>
					</table></div>';
					$latlng                     = $row->latlng;
					$dataa       			    = json_decode($latlng, true);
					$count                      = count($dataa[0]['geometry']);
					for($i=0; $i<$count; $i++){
						$lines['lat']       	= (float) $dataa[0]['geometry'][$i][0];
						$lines['lng']       	= (float) $dataa[0]['geometry'][$i][1];
						array_push($datas['lines'], $lines);
					}
					$datas['diameter']          = $row->diameter;
					array_push($polyline, $datas);
				}
				}else{
				$polyline = null;
			}
			echo json_encode($polyline);
		}
		public function mapPipaRencana()
		{
			header("Content-Type: application/json; charset=UTF-8");
			$this->load->model('maps_model');
			
			$result = $this->maps_model->getPipaRencanaMaps();
			
			if(!empty($result)){
				$polyline = array();
				foreach ($result as $row){
					$datas = array();
					$lines = array();
					$datas['lines'] = array();
					$datas['content']           = '<div class="info_content">
					<table class="table">
					<tr>
					<td><h4>'.$row->gid__2.'</h4></td>
					</tr>
					<tr>
					<td>Cabang</td>
					<td>: '.$row->cabang.'</td>
					</tr>
					<tr>
					<td>Lokasi</td>
					<td>: '.$row->lokasi.'</td>
					</tr>
					<tr>
					<td>Diameter</td>
					<td>: '.$row->diameter.'</td>
					</tr>
					<tr>
					<td>Panjang</td>
					<td>: '.$row->panjang.'</td>
					</tr>
					<tr>
					<td>Keterangan</td>
					<td>: '.$row->keterangan.'</td>
					</tr>
					<tr>
					<td></td>
					<td></td>
					</tr>
					</table></div>';
					$latlng                     = $row->latlng;
					$dataa       			    = json_decode($latlng, true);
					$count                      = count($dataa[0]['geometry']);
					for($i=0; $i<$count; $i++){
						$lines['lat']       	= (float) $dataa[0]['geometry'][$i][0];
						$lines['lng']       	= (float) $dataa[0]['geometry'][$i][1];
						array_push($datas['lines'], $lines);
					}
					$datas['diameter']          = $row->diameter;
					array_push($polyline, $datas);
				}
				}else{
				$polyline = null;
			}
			echo json_encode($polyline);
		}
		public function mapSearchPelanggan()
		{
			header("Content-Type: application/json; charset=UTF-8");
			$this->load->model('maps_model');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('search', 'Search', 'trim|required|numeric');
			$this->form_validation->set_rules('search', 'Search', 'trim|required');
			
			$marker = array();
			if($this->form_validation->run() == FALSE) {
				$marker = null;
				}else{
				$search = $this->input->post('search');
				$option = $this->input->post('option');
				
				switch ($option){
					case "pelanggan"        : {
						$result = $this->maps_model->getOnePelanggan($search);
						if (!empty($result)){
							foreach ($result as $row){
								$datas = array();
								$datas['nomor_pela']    = $row->nomor_pela;
								$datas['content']       = '<div class="info_content">
								<p>
								<img src="http://103.25.210.61:81/purwokerto/application/uploads/pelanggan/'.$row->foto.'" height="350" width="350">
								</p>
								<table>
								<tr>
								<td><b>Nomor Pelanggan</b></td>
								<td>: '.$row->nomor_pela.'</td>
								</tr>
								<tr>
								<td><b>Nama</b></td>
								<td>: '.$row->nama.'</td>
								</tr>
								<tr>
								<td><b>Alamat</b></td>
								<td>: '.$row->alamat.'</td>
								</tr>
								<tr>
								<td><b>Golongan</b></td>
								<td>: '.$row->golongan.'</td>
								</tr>
								<tr>
								<td><b>Status</b></td>
								<td>: '.$row->status.'</td>
								</tr>
								<tr>
								<td><b>Cabang</b></td>
								<td>: '.$row->cabang.'</td>
								</tr>
								<tr>
								<td><b>Zona Baca</b></td>
								<td>: '.$row->zona_baca_.'</td>
								</tr>
								<tr>
								<td><b>Klasifikasi</b></td>
								<td>: '.$row->klasifikasi.'</td>
								</tr>
								<tr>
								<td><b>ID Survey</b></td>
								<td> : '.$row->id_.'</td>
								</tr>
								</table>
								</div>';
								$latlng                 = $row->latlng;
								$dataa       			= json_decode($latlng, true);
								$datas['lat']       	= (float) $dataa[0]['geometry'][0];
								$datas['lng']       	= (float) $dataa[0]['geometry'][1];
								
								array_push($marker, $datas);
							}
							}else{
							$marker = null;
						}
						break;
					}
					case "pelanggan_mbr"    : {
						$result = $this->maps_model->getOnePelangganMBR($search);
						if (!empty($result)){
							foreach ($result as $row){
								$datas = array();
								$datas['nomor_pela']    = 'Pelanggan MBR';
								$datas['content']       = '<div class="info_content">
								<p>
								<img src="http://103.25.210.61:81/purwokerto/application/uploads/sr_mbr/'.$row->foto.'" height="350" width="350">
								</p>
								<table class="table">
								<tr>
								<td><h4>Pelanggan MBR</h4></td>
								</tr>
								<tr>
								<td>Nama</td>
								<td>: '.$row->nama.'</td>
								</tr>
								<tr>
								<td>Alamat</td>
								<td>: '.$row->alamat.'</td>
								</tr>
								<tr>
								<td>KTP</td>
								<td>: '.$row->ktp.'</td>
								</tr>
								<tr>
								<td>Nomor Telfon</td>
								<td>: '.$row->telfon.'</td>
								</tr>
								<tr>
								<td>Daya Listrik</td>
								<td>: '.$row->daya_listrik.'</td>
								</tr>
								<tr>
								<td>Tipe</td>
								<td>: '.$row->rt_biasa.'</td>
								</tr>
								<tr>
								<td>Pekerjaan</td>
								<td>: '.$row->pekerjaan.'</td>
								</tr>
								<tr>
								<td>ID Survey</td>
								<td>: '.$row->ID_.'</td>
								</tr>
								<tr>
								<td>Alamat Dipasang </td>
								<td>: '.$row->almt_dipasang.'</td>
								</tr>
								<tr>
								<td></td>
								<td></td>
								</tr>
								<tr>
								<td></td>
								<td></td>
								</tr>
								</table></div>';
								$latlng                 = $row->latlng;
								$dataa       			= explode(',', $latlng);
								$datas['lat']       	= (float) $dataa[0];
								$datas['lng']       	= (float) $dataa[1];
								
								array_push($marker, $datas);
							}
							}else{
							$marker = null;
						}
						break;
					}
					default: $marker = null;break;
				}
			}
			echo json_encode($marker);
		}
		public function mapDop()
		{
			header("Content-Type: application/json; charset=UTF-8");
			$this->load->model('maps_model');
			
			$result = $this->maps_model->getMapDop();
			
			if (!empty($result)){
				$marker = array();
				foreach ($result as $row){
					$datas = array();
					$datas['nomor_pela']    = 'DOP';
					$datas['content']       = '<div class="info_content">
					<table class="table">
					<tr>
					<td><h4>DOP</h4></td>
					</tr>
					<tr>
					<td>ID DOP</td>
					<td>: '.$row->id_.'</td>
					</tr>
					<tr>
					<td>Jenis</td>
					<td>: '.$row->jenis.'</td>
					</tr>
					<tr>
					<td>Tanggal Pasang</td>
					<td>: '.$row->tanggalpas.'</td>
					</tr>
					<tr>
					<td>Diameter</td>
					<td>: '.$row->diameter.'</td>
					</tr>
					<tr>
					<td>Keterangan</td>
					<td>: '.$row->keterangan.'</td>
					</tr>
					<tr>
					<td>Petugas Input</td>
					<td>: '.$row->petugas_in.'</td>
					</tr>
					<tr>
					<td>Tanggal Input</td>
					<td>: '.$row->tgl_input.'</td>
					</tr>
					</table></div>';
					$latlng                 = $row->latlng;
					$dataa       			= json_decode($latlng, true);
					$datas['lat']       	= (float) $dataa[0]['geometry'][0];
					$datas['lng']       	= (float) $dataa[0]['geometry'][1];
					
					array_push($marker, $datas);
				}
				}else{
				$marker = null;
			}
			echo json_encode($marker);
		}
		public function mapFhydrant()
		{
			header("Content-Type: application/json; charset=UTF-8");
			$this->load->model('maps_model');
			
			$result = $this->maps_model->getMapFhydrant();
			
			if (!empty($result)){
				$marker = array();
				foreach ($result as $row){
					$datas = array();
					$datas['nomor_pela']    = 'Fire Hydrant';
					$datas['content']       = '<div class="info_content">
					<table class="table">
					<tr>
					<td><h4>Fire Hydrant</h4></td>
					</tr>
					<tr>
					<td>Kode Assest</td>
					<td>: '.$row->kode_asset.'</td>
					</tr>
					<tr>
					<td>Kode Fire Hydrant</td>
					<td>: '.$row->kode_fireh.'</td>
					</tr>
					<tr>
					<td>Merek</td>
					<td>: '.$row->merk.'</td>
					</tr>
					<tr>
					<td>Tipe</td>
					<td>: '.$row->tipe.'</td>
					</tr>
					<tr>
					<td>Diameter</td>
					<td>: '.$row->diameter.'</td>
					</tr>
					<tr>
					<td>Lokasi</td>
					<td>: '.$row->lokasi.'</td>
					</tr>
					<tr>
					<td>Kondisi</td>
					<td>: '.$row->kondisi.'</td>
					</tr>
					<tr>
					<td>Tanggal Pasang</td>
					<td>: '.$row->tgl_pasang.'</td>
					</tr>
					<tr>
					<td>Keterangan</td>
					<td>: '.$row->keterangan.'</td>
					</tr>
					</table></div>';
					$latlng                 = $row->latlng;
					$dataa       			= json_decode($latlng, true);
					$datas['lat']       	= (float) $dataa[0]['geometry'][0];
					$datas['lng']       	= (float) $dataa[0]['geometry'][1];
					
					array_push($marker, $datas);
				}
				}else{
				$marker = null;
			}
			echo json_encode($marker);
		}
		public function mapGiboult()
		{
			header("Content-Type: application/json; charset=UTF-8");
			$this->load->model('maps_model');
			
			$result = $this->maps_model->getMapGiboult();
			
			if (!empty($result)){
				$marker = array();
				foreach ($result as $row){
					$datas = array();
					$datas['nomor_pela']    = 'Giboult';
					$datas['content']       = '<div class="info_content">
					<table class="table">
					<tr>
					<td><h4>Giboult</h4></td>
					</tr>
					<tr>
					<td>Kode Assest</td>
					<td>: '.$row->kodeasset.'</td>
					</tr>
					<tr>
					<td>Jenis</td>
					<td>: '.$row->jenis.'</td>
					</tr>
					<tr>
					<td>Tanggal Pasang</td>
					<td>: '.$row->tanggalpas.'</td>
					</tr>
					<tr>
					<td>Diameter</td>
					<td>: '.$row->diameter.'</td>
					</tr>
					<tr>
					<td>Keterangan</td>
					<td>: '.$row->keterangan.'</td>
					</tr>
					<tr>
					<td>Petugas Input</td>
					<td>: '.$row->petugas_in.'</td>
					</tr>
					<tr>
					<td>Tanggal Input</td>
					<td>: '.$row->tgl_input.'</td>
					</tr>
					</table></div>';
					$latlng                 = $row->latlng;
					$dataa       			= json_decode($latlng, true);
					$datas['lat']       	= (float) $dataa[0]['geometry'][0];
					$datas['lng']       	= (float) $dataa[0]['geometry'][1];
					
					array_push($marker, $datas);
				}
				}else{
				$marker = null;
			}
			echo json_encode($marker);
		}
		public function mapJembatan()
		{
			header("Content-Type: application/json; charset=UTF-8");
			$this->load->model('maps_model');
			
			$result = $this->maps_model->getMapJembatan();
			
			if (!empty($result)){
				$marker = array();
				foreach ($result as $row){
					$datas = array();
					$datas['nomor_pela']    = 'Jembatan Pipa';
					$datas['content']       = '<div class="info_content">
					<table class="table">
					<tr>
					<td><h4>Jembatan Pipa</h4></td>
					</tr>
					<tr>
					<td>Kode Assest</td>
					<td>: '.$row->kodeasset.'</td>
					</tr>
					<tr>
					<td>GID</td>
					<td>: '.$row->gid__2.'</td>
					</tr>
					<tr>
					<td>Jenis Konsol</td>
					<td>: '.$row->jenis_kons.'</td>
					</tr>
					<tr>
					<td>Tanggal Pasang</td>
					<td>: '.$row->tgl_pasang.'</td>
					</tr>
					<tr>
					<td>Tanggal Perwatan</td>
					<td>: '.$row->tgl_perawa.'</td>
					</tr>
					<tr>
					<td>Diameter</td>
					<td>: '.$row->diameter.'</td>
					</tr>
					<tr>
					<td>Lokasi</td>
					<td>: '.$row->lokasi.'</td>
					</tr>
					<tr>
					<td>Keterangan</td>
					<td>: '.$row->keterangan.'</td>
					</tr>
					<tr>
					<td>Petugas Input</td>
					<td>: '.$row->petugas_in.'</td>
					</tr>
					<tr>
					<td>Tanggal Input</td>
					<td>: '.$row->tgl_input.'</td>
					</tr>
					</table></div>';
					$latlng                 = $row->latlng;
					$dataa       			= json_decode($latlng, true);
					$datas['lat']       	= (float) $dataa[0]['geometry'][0];
					$datas['lng']       	= (float) $dataa[0]['geometry'][1];
					
					array_push($marker, $datas);
				}
				}else{
				$marker = null;
			}
			echo json_encode($marker);
		}
		public function mapKnie()
		{
			header("Content-Type: application/json; charset=UTF-8");
			$this->load->model('maps_model');
			
			$result = $this->maps_model->getMapKnie();
			
			if (!empty($result)){
				$marker = array();
				foreach ($result as $row){
					$datas = array();
					$datas['nomor_pela']    = 'Knie';
					$datas['content']       = '<div class="info_content">
					<table class="table">
					<tr>
					<td><h4>Knie</h4></td>
					</tr>
					<tr>
					<td>Kode Assest</td>
					<td>: '.$row->kodeasset.'</td>
					</tr>
					<tr>
					<td>Jenis</td>
					<td>: '.$row->jenis.'</td>
					</tr>
					<tr>
					<td>Tanggal Pasang</td>
					<td>: '.$row->tgl_pasang.'</td>
					</tr>
					<tr>
					<td>Diameter</td>
					<td>: '.$row->diameter.'</td>
					</tr>
					<tr>
					<td>Keterangan</td>
					<td>: '.$row->keterangan.'</td>
					</tr>
					</table></div>';
					$latlng                 = $row->latlng;
					$dataa       			= json_decode($latlng, true);
					$datas['lat']       	= (float) $dataa[0]['geometry'][0];
					$datas['lng']       	= (float) $dataa[0]['geometry'][1];
					
					array_push($marker, $datas);
				}
				}else{
				$marker = null;
			}
			echo json_encode($marker);
		}
		public function mapPompa()
		{
			header("Content-Type: application/json; charset=UTF-8");
			$this->load->model('maps_model');
			
			$result = $this->maps_model->getMapPompa();
			
			if (!empty($result)){
				$marker = array();
				foreach ($result as $row){
					$datas = array();
					$datas['nomor_pela']    = 'Pompa';
					$datas['content']       = '<div class="info_content">
					<table class="table">
					<tr>
					<td><h4>Pompa</h4></td>
					</tr>
					<tr>
					<td>Kode Assest</td>
					<td>: '.$row->kode_asset.'</td>
					</tr>
					<tr>
					<td>Jenis</td>
					<td>: '.$row->jenis.'</td>
					</tr>
					<tr>
					<td>Merek</td>
					<td>: '.$row->merk.'</td>
					</tr>
					<tr>
					<td>Tanggal Pasang</td>
					<td>: '.$row->tgl_pasang.'</td>
					</tr>
					<tr>
					<td>Kapasitas</td>
					<td>: '.$row->kapasitas_.'</td>
					</tr>
					<tr>
					<td>Daya</td>
					<td>: '.$row->daya_kwh.'</td>
					</tr>
					<tr>
					<td>Sumber Daya</td>
					<td>: '.$row->sumber_day.'</td>
					</tr>
					<tr>
					<td>Phase</td>
					<td>: '.$row->phase.'</td>
					</tr>
					<tr>
					<td>Kondisi</td>
					<td>: '.$row->kondisi.'</td>
					</tr>
					<tr>
					<td>Keterangan</td>
					<td>: '.$row->keterangan.'</td>
					</tr>
					</table></div>';
					$latlng                 = $row->latlng;
					$dataa       			= json_decode($latlng, true);
					$datas['lat']       	= (float) $dataa[0]['geometry'][0];
					$datas['lng']       	= (float) $dataa[0]['geometry'][1];
					
					array_push($marker, $datas);
				}
				}else{
				$marker = null;
			}
			echo json_encode($marker);
		}
		public function mapTee()
		{
			header("Content-Type: application/json; charset=UTF-8");
			$this->load->model('maps_model');
			
			$result = $this->maps_model->getMapTee();
			
			if (!empty($result)){
				$marker = array();
				foreach ($result as $row){
					$datas = array();
					$datas['nomor_pela']    = 'Tee';
					$datas['content']       = '<div class="info_content">
					<table class="table">
					<tr>
					<td><h4>Tee</h4></td>
					</tr>
					<tr>
					<td>ID</td>
					<td>: '.$row->id_.'</td>
					</tr>
					<tr>
					<td>Jenis</td>
					<td>: '.$row->jenis.'</td>
					</tr>
					<tr>
					<td>Tanggal Pasang</td>
					<td>: '.$row->tanggalpas.'</td>
					</tr>
					<tr>
					<td>Diameter</td>
					<td>: '.$row->diameter.'</td>
					</tr>
					<tr>
					<td>Keterangan</td>
					<td>: '.$row->keterangan.'</td>
					</tr>
					<tr>
					<td>Petugas Input</td>
					<td>: '.$row->petugas_in.'</td>
					</tr>
					<tr>
					<td>Tanggal Input</td>
					<td>: '.$row->tgl_input.'</td>
					</tr>
					</table></div>';
					$latlng                 = $row->latlng;
					$dataa       			= json_decode($latlng, true);
					$datas['lat']       	= (float) $dataa[0]['geometry'][0];
					$datas['lng']       	= (float) $dataa[0]['geometry'][1];
					
					array_push($marker, $datas);
				}
				}else{
				$marker = null;
			}
			echo json_encode($marker);
		}
		
	}			