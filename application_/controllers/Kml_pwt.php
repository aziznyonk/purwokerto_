<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kml_pwt extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('kml_model');
		$this->load->helper('download');
    }
	
	public function export_pela()
	{
		$result = $this->kml_model->pelaListing();
		if(!empty($result))
		{
			$geojson = array(
			   'type'      => 'FeatureCollection',
			   'name'	   => 'Marker_Pelanggan',
			   'features'  => array(),
			   'crs' => array(
						'type' => 'name',
						'properties' => array(
							'name'=>"urn:ogc:def:crs:OGC:1.3:CRS84"
						)
					)
			);
			foreach ($result as $row)
			{
				$properties = $row;
				$json = json_decode($row['latlng'], true);
				$feature = array(
					'type' => 'Feature',
					'geometry' => array(
						'type' => 'Point',
						'coordinates' => array(
							$json[0]['geometry'][1],
							$json[0]['geometry'][0]
						)
					),
					'properties' => $properties
				);
				array_push($geojson['features'], $feature);
			}
		}
		header('Content-type: application/json');
		echo json_encode($geojson, JSON_NUMERIC_CHECK);
	}
	public function export_mbr()
	{
		$result = $this->kml_model->mbrListing();
		if(!empty($result))
		{
			$geojson = array(
			   'type'      => 'FeatureCollection',
			   'name'	   => 'Marker_PelangganMBR',
			   'features'  => array(),
			   'crs' => array(
						'type' => 'name',
						'properties' => array(
							'name'=>"urn:ogc:def:crs:OGC:1.3:CRS84"
						)
					)
			);
			foreach ($result as $row)
			{
				$properties = $row;
				$raw = explode(',',$row['latlng']);
				$feature = array(
					'type' => 'Feature',
					'geometry' => array(
						'type' => 'Point',
						'coordinates' => array(
							$raw[1],
							$raw[0]
						)
					),
					'properties' => $properties
				);
				array_push($geojson['features'], $feature);
			}
		}
		header('Content-type: application/json');
		echo json_encode($geojson, JSON_NUMERIC_CHECK);
	}
	public function export_pipa()
	{
		$result = $this->kml_model->pipaListing();
		if(!empty($result))
		{
			$geojson = array(
			   'type'      	=> 'FeatureCollection',
			   'name'	   	=> 'Polyline_PipaRencana',
			   'crs'		=> array(
								'type' => 'name',
								'properties' => array(
								'name'=>"urn:ogc:def:crs:OGC:1.3:CRS84"
						)
					),
			   'features'  	=> array()
			);
			foreach ($result as $row)
			{
				$properties = $row;
				$json = json_decode($row['latlng'], true);
				$count= count($json[0]['geometry']);
				$line = array();
				for($i=0; $i<$count; $i++){
					$data = array((float) $json[0]['geometry'][$i][1], $json[0]['geometry'][$i][0]);
					
					array_push($line, $data);
				}
				$feature = array(
					'type' => 'Feature',
					'geometry' => array(
						'type' => 'LineString',
						'coordinates' => $line
					),
					'properties' => $properties
				);
				array_push($geojson['features'], $feature);
			}
		}
		header('Content-type: application/json');
		echo json_encode($geojson, JSON_NUMERIC_CHECK);
	}
}	
?>