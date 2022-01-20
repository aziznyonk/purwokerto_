<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="input-group">
            <!-- <a href="<?php echo base_url(); ?>index.php/Sr_mbrAdd"><button class="btn btn-default"><i class="fa fa-plus"></i> Add New MBR</button></a> -->
            <a href="<?php echo base_url(); ?>index.php/exportKml_mbr" target="blank" download="Marker_PelangganMBR.geojson" style="margin-left:10px"><button class="btn btn-info"><i class="fa fa-save"></i> Save Pelanggan MBR</button></a>
        </div>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">MBR</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Table MBR Data</h3>
            </div>
            <div class="box-body" style="overflow-y:auto">
                <table id="tt" class="easyui-datagrid" title="Data Pelanggan MBR" ></table>
                <form method="post" action="#" id="tb" style="padding:2px 5px;">
                    Cari :
                    <input type="text" class="easyui-searchbox" data-options="prompt:'ID Survey',searcher:doSearchSurv">
                    <input type="text" class="easyui-searchbox" data-options="prompt:'Nama Pelanggan',searcher:doSearchNama">
                    <input type="text" class="easyui-searchbox" data-options="prompt:'Alamat',searcher:doSearchAlamat">
                    <input type="text" class="easyui-searchbox" data-options="prompt:'ID Penginput',searcher:doSearchPenginput">
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Edit Data Pelanggan Reguler</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="frmEdit" onsubmit="return false">
                    <div class="form-group">
                        <label for="textinput">ID Survey</label>
                        <input id="ID_" name="ID_" type="text" value="" class="form-control input-md">
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
                        <label for="textinput">Alamat Dipasang</label>
                        <input id="almt_dipasang" name="almt_dipasang" type="text" value="" class="form-control input-md">
                    </div>
                    <div class="form-group">
                        <label for="textinput">Nomor Telfon</label>
                        <input id="telfon" name="telfon" type="text" value="" class="form-control input-md">
                    </div>
                    <div class="form-group">
                        <label for="textinput">KTP</label>
                        <input id="ktp" name="ktp" type="text" value="" class="form-control input-md">
                    </div>
                    <div class="form-group">
                        <label for="selectbasic">Tipe Bangunan</label>
                        <select id="rt_biasa" name="rt_biasa" class="form-control">
                            <option value="Rumah Tangga Biasa" selected>Rumah Tangga Biasa</option>
                            <option value="Kos-kosan/Asrama">Kos-kosan/Asrama</option>
                            <option value="Ruko/Toko">Ruko/Toko</option>
                            <option value="Rumah Bertingkat">Rumah Bertingkato</option>
                            <option value="Rumah Dinas">Rumah Dinas</option>
                            <option value="Ruko/Toko">Rumah Tangga Biasa</option>
                            <option value="Ruko/Toko">Rumah Tidak Dihuni</option>
                            <option value="Tanah Kosong/Pondasi">Tanah Kosong/Pondasi</option>
                            <option value="Tempat Ibadah">Tempat Ibadah</option>
                            <option value="Tempat Usaha">Tempat Usaha</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectbasic">Daya Listrik</label>
                        <select id="daya_listrik" name="daya_listrik" class="form-control">
                            <option value="0 watt"> 0 watt</option>
                            <option value="450 watt">450 watt</option>
                            <option value="900 watt">900 watt</option>
                            <option value=">900 watt">>900 watt</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="textinput">Profesi</label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                    </div>
                    <div class="form-group">
                        <label for="jml_penghuni">Jumlah Penghuni</label>
                        <input id="jml_penghuni" name="jml_penghuni" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="textinput">Sumber Air</label>
                        <input id="smber_skrg" name="smber_skrg" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="textinput">Jarak</label>
                        <input id="jarak" name="jarak" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="textinput">Lebar Jalan</label>
                        <input id="lebar_jln" name="lebar_jln" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="textinput">Distribusi Jaringan</label>
                        <input id="jaringan_distri" name="jaringan_distri" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="textinput">Latitude Longitude</label>
                        <textarea id="latlng" name="latlng" type="text" class="form-control"></textarea>
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

<script defer src="<?= base_url('assets/custom/js/sr_mbr.js'); ?>"></script>