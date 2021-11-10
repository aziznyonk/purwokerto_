<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MapTekanan extends CI_Controller {
    public function index()
    {

        $this->load->model('maps_model');
        $countM = $this->maps_model->getMapPelangganMBR();
        $countP = $this->maps_model->getMapPelanggan();
		$sumDebit = $this->maps_model->getMapSumDebit();
		$data['sumDebit']	= $sumDebit;
        $data['pelanggan']  = count($countP);
        $data['mbr']        = count($countM);
        $data['title']      = 'Web GIS';
        $this->load->view('mapsTekanan', $data);
    }

    
    public function mapTekanans()
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
                    $datas['content']           = '<div class="pipaContent">
                    <table class="table">
                        <tr>
                            <td><h4 class="pipaContent">'.$row->gid__2.'</h4></td>
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
                    $dataa                      = json_decode($latlng, true);
                    $count                      = count($dataa[0]['geometry']);
                    for($i=0; $i<$count; $i++){
                        $lines['lat']           = (float) $dataa[0]['geometry'][$i][0];
                        $lines['lng']           = (float) $dataa[0]['geometry'][$i][1];
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
    public function mapsTekananCek()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $this->load->model('maps_model');

        $result = $this->maps_model->getTekananPipaMap();
        if (!empty($result)){
            $polyline = array();
            foreach ($result as $row){
                $datas = array();
                $lines = array();
                $datas['lines'] = array();
                $datas['content']           = '<div class="pipaContent">
                    <table class="table">
                        <tr>
                            <td><h4 class="pipaContent">'.$row->gid__2.'</h4></td>
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
                        <tr>
                            <td>Keterangan</td>
                            <td>: '.$row->tekanan.'</td>
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
                $datas['tekanan']           = $row->tekanan;
                array_push($polyline, $datas);
            }
        }else{
            $polyline = null;
        }
        echo json_encode($polyline);

    }
    public  function mapsManometer()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $this->load->model('maps_model');

        $result = $this->maps_model->getMapManometer();

        if (!empty($result)){
            $marker = array();
            foreach ($result as $row){
                $datas = array();
                $datas['nomor_pela']    = 'Manometer';
                $datas['content']       = '<div class="markerContent">
                    <table class="table">
                        <tr>
                            <td><h4 class="markerContent">Manometer</h4></td>
                        </tr>
                        <tr>
                            <td>Kode Assest</td>
                            <td>: '.$row->kode_asset.'</td>
                        </tr>
                        <tr>
                            <td>Kode Manometer</td>
                            <td>: '.$row->kode_manom.'</td>
                        </tr>
                        <tr>
                            <td>Merek</td>
                            <td>: '.$row->merk.'</td>
                        </tr>
                        <tr>
                            <td>Lokasi</td>
                            <td>: '.$row->lokasi.'</td>
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
                            <td>Elevasi</td>
                            <td>: '.$row->elevasi.'</td>
                        </tr>
                        <tr>
                            <td>Koneksi Pipa </td>
                            <td>: '.$row->koneksi_pi.'</td>
                        </tr>
                        <tr>
                            <td>Petugas</td>
                            <td>: '.$row->petugas.'</td>
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
    public  function mapsMeter()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $this->load->model('maps_model');

        $result = $this->maps_model->getMapMeter();

        if (!empty($result)){
            $marker = array();
            foreach ($result as $row){
                $datas = array();
                $datas['nomor_pela']    = 'Meter Induk';
                $datas['content']       = '<div class="markerContent">
                    <table class="table">
                        <tr>
                            <td><h4 class="markerContent">Meter Induk</h4></td>
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
}