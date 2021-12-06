<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" /> -->

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
                <h3 class="box-title">Table Master Tekanan</h3>
            </div>
            <div class="box-body">
                <table id="dg" class="easyui-datagrid" width="100%"></table>
                <form method="post" action="#" id="tb" style="padding:2px 5px;">
                    <input type="text" class="easyui-searchbox" data-options="prompt:'ID manometer',searcher:doSearchMano">
                    <input type="text" class="easyui-searchbox" data-options="prompt:'Lokasi manometer',searcher:doSearchLokasi">
                    <input type="text" class="easyui-searchbox" data-options="prompt:'Username/Nama Petugas',searcher:doSearchNama">
                    <a href="#" class="easyui-linkbutton" iconCls="icon-clear" onclick="resetTable()">Reset</a>
                </form>
            </div>
        </div>
    </section>
</div>

<div id="win" class="easyui-window" title="My Window" style="width:400px;min-height:500px; padding:10px" data-options="iconCls:'icon-edit',modal:true">
    <form action="#" id="frmEdit" class="form-horizontal">
        <div class="form-group">
            <label for="kd_mano" class="control-label col-lg-3">Manometer</label>
            <div class="col-lg-3">
                <input type="text" name="kd_mano" id="kd_mano" class="form-control" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="username" class="control-label col-lg-3">Username</label>
            <div class="col-lg-3">
                <input type="text" name="username" id="username" class="form-control" readonly>
            </div>
            <div class="col-lg-5">
                <input type="text" name="nama" id="nama" class="form-control" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="tgl_input" class="control-label col-lg-3">Tgl Input</label>
            <div class="col-lg-4">
                <input type="text" name="tgl_input" id="tgl_input" class="form-control easyui-datebox" data-options="formatter:myformatter,parser:myparser">
            </div>
        </div>

        <div class="form-group">
            <label for="lokasi_mano" class="control-label col-lg-3">Lokasi</label>
            <div class="col-lg-8">
                <textarea name="lokasi_mano" id="lokasi_mano" class="form-control"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="tekanan" class="control-label col-lg-3">Tekanan</label>
            <div class="col-lg-8">
                <input type="text" name="tekanan" id="tekanan" class="form-control">
            </div>
        </div>

        <div class="form-group text-right">
            <div class="col-lg-6">
                <input type="hidden" name="id" id="id">
            </div>
            <div class="col-lg-5">
                <button class="btn btn-primary" id="btnUpdate">SIMPAN</button>
                <input type="reset" value="BATAL" id="btnReset" class="btn btn-danger">
            </div>
        </div>
    </form>
</div>