<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="input-group">
            <!-- <a href="<?php echo base_url(); ?>index.php/Sr_mbrAdd"><button class="btn btn-default"><i class="fa fa-plus"></i> Add New Pelanggan</button></a> -->
            <a href="<?php echo base_url(); ?>exportKml_pela" target="blank" download="Marker_Pelanggan.geojson" style="margin-left:10px"><button class="btn btn-info"><i class="fa fa-save"></i> Save Pelanggan KML</button></a>
            <!-- <a href="<?php echo base_url(); ?>exportKml_pela" target="_blank" style="margin-left:10px"><button class="btn btn-info"><i class="fa fa-save"></i> Save Pelanggan KML</button></a> -->
        </div>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pelanggan</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Table Pelanggan</h3>
            </div>
            <div class="box-body" style="overflow-y:auto">
                <!-- <table id="mbrTable" class="table table-bordered table-striped"> -->
                <table id="tt" class="easyui-datagrid" title="Pelanggan Reguler">
                    <!-- data-options="rownumbers:true,pagination:true,singleSelect:true,url:'<?php base_url(); ?>pela/getDataPel',method:'post',toolbar:'#tb',footer:'#ft'"> -->
                    <!-- <thead>
                        <tr>
                            <th field="nomor_pela">Nomor Pelanggan</th>
                            <th field="nama">Nama</th>
                            <th field="alamat">Alamat</th>
                            <th field="status">Status</th>
                            <th field="klasifikasi">Type</th>
                            <th field="golongan">Golongan</th>
                            <th field="dma">DMA</th>
                            <th field="cabang">Cabang</th>
                            <th field="zona_baca_">Zona Baca</th>
                            <th field="keterangan">Keterangan</th>
                            <th field="username">Penginput</th>
                            <th field="tgl_input">Tgl Input</th>
                            <th field="action">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody> -->
                </table>
                <form method="post" action="#" id="tb" style="padding:2px 5px;">
                    Cari :
                    <input type="text" class="easyui-searchbox" data-options="prompt:'ID manometer',searcher:doSearchMano">
                    <input type="text" class="easyui-searchbox" data-options="prompt:'Nama Pelanggan',searcher:doSearchNama">
                    <input type="text" class="easyui-searchbox" data-options="prompt:'Alamat',searcher:doSearchAlamat">
                    <input type="text" class="easyui-searchbox" data-options="prompt:'ID Survey',searcher:doSearchSurv">
                    <a href="#" class="easyui-linkbutton" iconCls="icon-clear" onclick="resetTable()">Reset</a>
                </form>
            </div>
        </div>
    </section>
</div>

<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Data Pelanggan Reguler</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="frmEdit" onsubmit="return false">
                    <div class="form-group">
                        <label for="textinput">Nomor Pelanggan</label>
                        <input id="nomor_pela" name="nomor_pela" type="text" value="" class="form-control input-md" readonly>
                    </div>
                    <div class="form-group">
                        <label for="textinput">Nama Pelanggan</label>
                        <input id="nama" name="nama" type="text" value="" class="form-control input-md">
                    </div>
                    <div class="form-group">
                        <label for="textinput">Alamat</label>
                        <input id="alamat" name="alamat" type="text" value="" class="form-control input-md">
                    </div>
                    <div class="form-group">
                        <label for="textinput">Klasifikasi</label>
                        <input id="klasifikasi" name="klasifikasi" type="text" value="" class="form-control input-md">
                    </div>
                    <div class="form-group">
                        <label for="textinput">Cabang</label>
                        <input id="cabang" name="cabang" type="text" value="" class="form-control input-md">
                    </div>
                    <div class="form-group">
                        <label for="selectbasic">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="textinput">Latitude Longitude</label>
                        <textarea class="form-control textarea" id="latlng" name="latlng"></textarea>
                    </div>
                    <!-- Button (Double) -->
                    <div class="form-group">
                        <label for="button1id"></label>
                        <input id="ID" name="ID" type="hidden" value="">
                        <button id="button1id" name="button1id" class="btn btn-primary btn-block">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script defer src="<?= base_url('assets/custom/js/pelanggan.js'); ?>"></script>