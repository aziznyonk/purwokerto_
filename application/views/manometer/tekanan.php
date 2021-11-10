<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

<div class="content-wrapper">
	<section class="content-header">
		<h1>Data Tekanan</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Data Tekanan</li>
		</ol>
	</section>
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Table Data Tekanan</h3>
			</div>
			<div class="box-body">
				<table id="tt" class="easyui-datagrid" title="Load Data" pagination="true" data-options="rownumbers:true,singleSelect:true,url:'<?php base_url(); ?>/purwokerto_/tekanan/getDataTekanan',method:'post',toolbar:'#tb',footer:'#ft'">
					<thead>
						<tr>
							<th field="id_manometer">ID Manometer</th>
							<th field="nama_manometer">Nama Manometer</th>
							<th field="lokasi">Lokasi</th>
							<th field="kondisi">Kondisi</th>
							<th field="koordinat">Koordinat</th>
							<th field="keterangan">Keterangan</th>
							<th field="action" class="text-center">Action</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
				<div id="tb" style="padding:2px 5px;">
					Date From: <input class="easyui-datebox" style="width:110px">
					To: <input class="easyui-datebox" style="width:110px">
					ID Manometer: <input type="text" id='f_id_manometer' name="cari" class="easyui-searchbox">
					<a href="#" class="easyui-linkbutton" iconCls="icon-search">Search</a>
				</div>
			</div>
		</div>
	</section>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div id="modal-body" class="modal-body">
				<div id="map" style="height: 512px;"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>
	let map;
	let openModal = async (lat, long) => {
		const coordinates = {
			lat: lat,
			lng: long
		}
		map = new google.maps.Map(document.getElementById("map"), {
			center: coordinates,
			zoom: 11,
		});
		const marker = new google.maps.Marker({
			position: coordinates,
			map: map,
		});
	}

	function initMap() {
		map = new google.maps.Map(document.getElementById("map"), {
			center: {
				lat: -7.431391,
				lng: 09.247833
			},
			zoom: 8,
		});
	}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhp3-zMM6Z1-NM8FBefecBjnRQBIv08_8&callback=initMap&v=weekly" async></script>

<script>
	const dummy = [{
			"ID": "558",
			"id_manometer": "202601018",
			"nama_manometer": "Manometer 26-18",
			"lokasi": "Jl. Tentara Pelajar (Utara Gang Kantor Kelurahan Kedungwuluh)",
			"latlng": "[{\"geometry\":[\"-7.419786869420706\",\"109.22836918383837\"],\"type\":\"MARKER\"}]",
			"username": "800200384",
			"kondisi": "Normal",
			"tekanan": "0.10",
			"keterangan": "bermbun",
			"path": "http://103.25.210.61:81/purwokerto/application/uploads/input_manometer/JPEG_20210915_094041.jpg",
			"kode_asset": null,
			"merk": null,
			"tgl_pasang": null,
			"elevasi": null,
			"koneksi_pi": null,
			"tgl_baca_s": "2021-09-14 09:24:33",
			"tgl_baca_d": null,
			"tgl_baca_t": null,
			"tek_min_sa": null,
			"tek_mak_sa": null,
			"tek_rata2_": null,
			"tek_min_du": null,
			"tek_mak_du": null,
			"tek_rata_1": null,
			"tek_min_ti": null,
			"tek_mak_ti": null,
			"tek_rata_2": null,
			"petugas": null,
			"tgl_perbai": null,
			"tgl_input": null,
			"petugas_in": null,
			"ogc_geom": null,
			"koordinat": "<a href=\"#\" onClick=\"openModal(-7.419786869420706,109.22836918383837)\" data-toggle=\"modal\" data-target=\"#myModal\">-7.419786869420706,109.22836918383837</a>",
			"action": "<a href=http://localhost/purwokerto_/pipa/details_pipa/558\" class=\"btn btn-small\"><i class=\"icon fa fa-eye\" title=\"Details\"></i></a><a href=\"http://localhost/purwokerto_/pipa/edit_pipa/558\" class=\"btn btn-small\"><i class=\"icon fa fa-pencil\" title=\"edit\"></i></a><a onclick=\"deleteFunction(558)\" class=\"btn btn-small text-danger\"><i class=\"icon fa fa-trash\" title=\"delete\"></i></a>"
		},
		{
			"ID": "559",
			"id_manometer": "202601017",
			"nama_manometer": "Manometer 26-17",
			"lokasi": "Jl. Pekih",
			"latlng": "[{\"geometry\":[\"-7.422851888000331\",\"109.22841243445873\"],\"type\":\"MARKER\"}]",
			"username": "800200384",
			"kondisi": "Normal",
			"tekanan": "0.80",
			"keterangan": "berembun",
			"path": "http://103.25.210.61:81/purwokerto/application/uploads/input_manometer/JPEG_20210915_094334.jpg",
			"kode_asset": null,
			"merk": null,
			"tgl_pasang": null,
			"elevasi": null,
			"koneksi_pi": null,
			"tgl_baca_s": "2021-09-14 09:30:17",
			"tgl_baca_d": null,
			"tgl_baca_t": null,
			"tek_min_sa": null,
			"tek_mak_sa": null,
			"tek_rata2_": null,
			"tek_min_du": null,
			"tek_mak_du": null,
			"tek_rata_1": null,
			"tek_min_ti": null,
			"tek_mak_ti": null,
			"tek_rata_2": null,
			"petugas": null,
			"tgl_perbai": null,
			"tgl_input": null,
			"petugas_in": null,
			"ogc_geom": null,
			"koordinat": "<a href=\"#\" onClick=\"openModal(-7.422851888000331,109.22841243445873)\" data-toggle=\"modal\" data-target=\"#myModal\">-7.422851888000331,109.22841243445873</a>",
			"action": "<a href=http://localhost/purwokerto_/pipa/details_pipa/559\" class=\"btn btn-small\"><i class=\"icon fa fa-eye\" title=\"Details\"></i></a><a href=\"http://localhost/purwokerto_/pipa/edit_pipa/559\" class=\"btn btn-small\"><i class=\"icon fa fa-pencil\" title=\"edit\"></i></a><a onclick=\"deleteFunction(559)\" class=\"btn btn-small text-danger\"><i class=\"icon fa fa-trash\" title=\"delete\"></i></a>"
		}
	]
	document.querySelector('.easyui-linkbutton').addEventListener('click', e => {
		$('#tt').datagrid('load', {
			id_manometer: $('#f_id_manometer').val()
		})
	})
</script>