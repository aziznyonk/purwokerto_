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
            <table id="tt" class="easyui-datagrid"></table>
            <form method="post" action="#" id="tb" style="padding:2px 5px;">
                Cari :
                <input id="tgl" class="easyui" style="width:110px">
                <select id="username" class="easyui-combobox" name="username" style="width:200px;" data-options="onChange:doSearchUsername">
                    <option value="ALL">--Pilih Petugas--</option>
                    <?php foreach ($petugas as $p) : ?>
                        <option value="<?= $p->username ?>"><?= $p->nama ?></option>
                    <?php endforeach ?>
                </select>
                <input type="text" class="easyui-searchbox" style="width: 400px;" data-options="prompt:'Manometer, Petugas, Lokasi',searcher:doSearch">
                <a href="#" class="easyui-linkbutton" iconCls="icon-clear" onclick="resetTable()">Reset</a>
                <a href="#" class="easyui-linkbutton" iconCls="icon-save" onclick="exportExcel()">Export Excel</a>
            </form>
        </div>
    </div>
</section>

<?php $this->load->view('manometer/modal') ?>

<?= (isset($cusScript)) ? $cusScript : "" ?>
<?= (isset($mapScript)) ? $mapScript : "" ?>