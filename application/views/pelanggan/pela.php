<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="input-group">
            <a href="<?php echo base_url(); ?>index.php/Sr_mbrAdd"><button class="btn btn-default"><i class="fa fa-plus"></i> Add New Pelanggan</button></a>
            <a href="<?php echo base_url(); ?>index.php/exportKml_pela" target="blank" download="Marker_Pelanggan.geojson" style="margin-left:10px"><button class="btn btn-info"><i class="fa fa-save"></i> Save Pelanggan KML</button></a>
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
                <table id="tt" class="easyui-datagrid" url="<?php base_url(); ?>/purwokerto_/pela/getDataPel" title="Load Data" iconCls="icon-save" rownumbers="true" pagination="true">
                    <thead>
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
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    'use strict';

    function deleteFunction(ID) {
        if (confirm("Apakah anda yakin untuk menghapus data ini ?!")) {
            $.ajax({
                url: "<?php base_url(); ?>delete_pelanggan",
                data: {
                    ID: ID
                },
                type: "POST",
                success: function(res) {
                    if (res == false) {
                        alert('Failed - Data Gagal Dihapus ' + res);
                    } else {
                        alert('Sukses Data Berhasil Dihapus');
                    }
                },
                error: function(error) {
                    alert('sukses ' + error);
                }
            });
        } else {
            alert('Tidak Jadi menhapus data pelanggan ' + ID);
        }
    }
</script>