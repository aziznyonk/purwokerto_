<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content-header">
        <!-- <div class="input-group">
            <a href="<?php echo base_url(); ?>index.php/Sr_mbrAdd"><button class="btn btn-default"><i class="fa fa-plus"></i> Add New MBR</button></a>
            <a href="<?php echo base_url(); ?>index.php/exportKml_mbr" target="blank" download="Marker_PelangganMBR.geojson" style="margin-left:10px"><button class="btn btn-info"><i class="fa fa-save"></i> Save Pelanggan MBR</button></a>
        </div> -->
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
                <table id="tt" class="easyui-datagrid" title="Data Pelanggan MBR" data-options="rownumbers:true,pagination:true,singleSelect:true,url:'<?php base_url(); ?>mbr/getDataPelMbr',method:'post',toolbar:'#tb',footer:'#ft'">
                    <thead>
                        <tr>
                            <th field="ID_">ID Survey</th>
                            <th field="nama">Nama</th>
                            <th field="alamat">Alamat</th>
                            <th field="almt_dipasang">Alamat Dipasang</th>
                            <th field="telfon">Telfon</th>
                            <th field="ktp">KTP</th>
                            <th field="rt_biasa">Type</th>
                            <th field="daya_listrik">Daya</th>
                            <th field="pekerjaan">Pekerjaan</th>
                            <th field="jml_penghuni">Penghuni</th>
                            <th field="smber_skrg">Sumber</th>
                            <th field="jarak">Jarak</th>
                            <th field="lebar_jln">Lebar Jalan</th>
                            <th field="jaringan_distri">Distribusi</th>
                            <th field="username">Penginput</th>
                            <th field="date">Tgl Input</th>
                            <th field="action" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <form method="post" action="#" id="tb" style="padding:2px 5px;">
                    Cari :
                    <input type="text" class="easyui-searchbox" data-options="prompt:'ID Survey',searcher:doSearchSurv">
                    <input type="text" class="easyui-searchbox" data-options="prompt:'Nama Pelanggan',searcher:doSearchNama">
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
                            <option value="0 Watt"> 0 Watt</option>
                            <option value="450 Watt">450 Watt</option>
                            <option value="900 Watt">900 Watt</option>
                            <option value=">900 Watt">>900 Watt</option>
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

<script type="text/javascript">
    let doSearchPenginput = e => doSearch({
        'penginput': e
    })

    let doSearchNama = e => doSearch({
        'nama': e
    })

    let doSearchSurv = e => doSearch({
        'surv': e
    })

    let doSearch = (req) => {
        console.log(req)
        $('#tt').datagrid('load', req)
        $('#tb')[0].reset()
    }

    let resetTable = () => {
        $('#tt').datagrid('load', {
            page: 1,
            rows: 10
        })
    }

    function deleteFunction(ID) {
        if (confirm("Apakah anda yakin untuk menghapus data ini ?!")) {
            $.ajax({
                url: "<?php base_url(); ?>delete_mbr",
                data: {
                    ID: ID
                },
                type: "POST",
                success: function(res) {
                    if (res == false) {
                        alert('Failed - Data Gagal Dihapus ' + res);
                    } else {
                        alert('Sukses Data Berhasil Dihapus');
                        resetTable()
                    }
                },
                error: function(error) {
                    alert('sukses ' + error);
                }
            });
        } else {
            alert('Tidak Jadi menhapus data pelanggan MBR ' + ID);
        }
    }

    let editData = async (data) => {
        $.post('<?= base_url() ?>mbr/getDataPelId', {
            'id': data
        }, (json) => {
            $.each(json, (i, d) => {
                $('#ID').val(d.ID)
                $('#nama').val(d.nama)
                $('#alamat').val(d.alamat)
                $('#almt_dipasang').val(d.almt_dipasang)
                $('#ktp').val(d.ktp)
                $('#telfon').val(d.telfon)
                $('#daya_listrik').val(d.daya_listrik)
                $('#rt_biasa').val(d.rt_biasa)
                $('#pekerjaan').val(d.pekerjaan)
                $('#jml_penghuni').val(d.jml_penghuni)
                $('#smber_skrg').val(d.smber_skrg)
                $('#jarak').val(d.jarak)
                $('#lebar_jln').val(d.lebar_jln)
                $('#jaringan_distri').val(d.jaringan_distri)
                $('#latlng').val(d.latlng)
                $('#username').val(d.username)
                $('#ID_').val(d.ID_)

            })
        }, "json")
    }

    $('#frmEdit').on('submit', e => {
        const formData = $('#frmEdit').serializeArray()
        $.post(`<?= base_url() ?>mbr/update_pelanggan`, formData, json => {
            $('#frmEdit')[0].reset()
            const result = JSON.parse(json)
            alert(result.message)
            $('.close').trigger('click')
            $('#tt').datagrid('reload');
        })
        return false
    })
</script>