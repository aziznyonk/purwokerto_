<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" /> -->

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
				<!-- <table id="tt" class="easyui-datagrid" title="Load Data" pagination="true" data-options="url:'<?php base_url(); ?>/purwokerto_/tekanan/getDataTekanan',method:'post',toolbar:'#tb',footer:'#ft'" style="width:100%;">
					<thead>
						<tr>
							<th field="ID">ID</th>
							<th field="id_manometer">ID Manometer</th>
							<th field="nama_manometer">Nama Manometer</th>
							<th field="lokasi">Lokasi</th>
							<th field="kondisi">Kondisi</th>
							<th field="tekanan">Tekanan</th>
							<th field="koordinat">Koordinat</th>
							<th field="keterangan">Keterangan</th>
							<th field="action" class="text-center">Action</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table> -->
				<table id="tt" class="easyui-datagrid"></table>
				<form method="post" action="#" id="tb" style="padding:2px 5px;">
					Cari :
					<input id="tgl" class="easyui" style="width:110px">
					<input type="text" class="easyui-searchbox" data-options="prompt:'ID manometer',searcher:doSearchMano">
					<input type="text" class="easyui-searchbox" data-options="prompt:'Nama Petugas',searcher:doSearchNama">
					<a href="#" class="easyui-linkbutton" iconCls="icon-clear" onclick="resetTable()">Reset</a>
				</form>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('manometer/modal') ?>