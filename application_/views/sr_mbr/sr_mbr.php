<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="input-group">
            <a href="<?php echo base_url(); ?>index.php/Sr_mbrAdd"><button class="btn btn-default"><i class="fa fa-plus"></i> Add New MBR</button></a>
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
			<?php echo $echo; ?>
                <table id="mbrTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Survey</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Alamat Dipasang</th>
                        <th>Telfon</th>
                        <th>KTP</th>
                        <th>Type</th>
                        <th>Daya</th>
                        <th>Pekerjaan</th>
                        <th>Penghuni</th>
                        <th>Sumber</th>
                        <th>Jarak</th>
                        <th>Lebar Jalan</th>
                        <th>Distribusi</th>
                        <th>Penginput</th>
                        <th>Tgl Input</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($mbrRecords)) {
                        $no = 1;
                        foreach ($mbrRecords as $record) {
                            ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $record->ID_ ?></td>
                                <td><?php echo $record->nama ?></td>
                                <td><?php echo $record->alamat ?></td>
                                <td><?php echo $record->almt_dipasang ?></td>
                                <td><?php echo $record->telfon ?></td>
                                <td><?php echo $record->ktp ?></td>
                                <td><?php echo $record->rt_biasa ?></td>
                                <td><?php echo $record->daya_listrik ?></td>
                                <td><?php echo $record->pekerjaan ?></td>
                                <td><?php echo $record->jml_penghuni ?></td>
                                <td><?php echo $record->smber_skrg ?></td>
                                <td><?php echo $record->jarak ?></td>
                                <td><?php echo $record->lebar_jln ?></td>
                                <td><?php echo $record->jaringan_distri ?></td>
                                <td><?php echo $record->username ?></td>
                                <td><?php echo $record->date ?></td>
                                <td class="text-center">
                                    <a href="<?php echo base_url(); ?>index.php/sr_mbr/edit_mbr/<?php echo $record->ID ?>" class="btn btn-small"><i class="icon fa fa-pencil" title="edit"></i></a>
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
                url: "<?php base_url();?>delete_mbr",
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
            alert('Tidak Jadi menhapus data pelanggan MBR '+ID);
        }
    }
</script>