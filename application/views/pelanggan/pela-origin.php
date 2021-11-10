<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
                <table id="mbrTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Pelanggan</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Golongan</th>
                        <th>DMA</th>
                        <th>Cabang</th>
                        <th>Zona Baca</th>
                        <th>Keterangan</th>
                        <th>Penginput</th>
                        <th>Tgl Input</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($pelangganRecords)) {
                        $no = 1;
                        foreach ($pelangganRecords as $record) {
                            ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $record->nomor_pela ?></td>
                                <td><?php echo $record->nama ?></td>
                                <td><?php echo $record->alamat ?></td>
                                <td><?php echo $record->status ?></td>
                                <td><?php echo $record->klasifikasi ?></td>
                                <td><?php echo $record->golongan ?></td>
                                <td><?php echo $record->dma ?></td>
                                <td><?php echo $record->cabang ?></td>
                                <td><?php echo $record->zona_baca_ ?></td>
                                <td><?php echo $record->keterangan ?></td>
                                <td><?php echo $record->username ?></td>
                                <td><?php echo $record->tgl_input ?></td>
                                <td class="text-center">
                                    <a href="<?php echo base_url(); ?>index.php/pela/edit_pelanggan/<?php echo $record->ID ?>" class="btn btn-small"><i class="icon fa fa-pencil" title="edit"></i></a>
                                    <a onclick="deleteFunction(<?php echo $record->ID ?>)" class="btn btn-small"><i class="icon fa fa-trash" title="delete"></i></a>
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
	'use strict';
	function deleteFunction (ID){
        if (confirm("Apakah anda yakin untuk menghapus data ini ?!")) {
            $.ajax({
                url: "<?php base_url();?>delete_pelanggan",
                data: {ID : ID},
                type: "POST",
                success: function(res){
					if(res == false){
						alert('Failed - Data Gagal Dihapus '+res);
					}else{
						alert('Sukses Data Berhasil Dihapus');
					}
                },
                error: function(error){
                    alert('sukses '+error);
                }
            });
        } else {
            alert('Tidak Jadi menhapus data pelanggan '+ID);
        }
    }
</script>