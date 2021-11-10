<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Master Tekanan</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Master Tekanan</li>
		</ol>
	</section>
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Table Data Master Tekanan</h3>
			</div>
			<div class="box-body">
				<table id="tt" class="easyui-datagrid" url="<?php base_url(); ?>/purwokerto_/tekanan/getDataTekanan" title="Load Data" iconCls="icon-save" rownumbers="true" pagination="true">
					<thead>
						<tr>
							<th field="lokasi">Lokasi</th>
							<th field="cabang">Cabang</th>
							<th field="panjang">Panjang</th>
							<th field="diameter">Diameter</th>
							<th field="keterangan">Keterangan</th>
							<th field="id_manometer">ID Manometer</th>
							<th field="action" class="text-center">Action</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</section>
</div>