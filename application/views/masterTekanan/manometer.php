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
                    Cari : <input type="text" class="easyui-searchbox" style="width:300px;" data-options="prompt:'Manometer/Cabang/PJ/Lokasi',searcher:doSearch">
                    <a href="#" class="easyui-linkbutton" iconCls="icon-clear" onclick="resetTable()">Reset</a>
                </form>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('masterTekanan/form_edit'); ?>