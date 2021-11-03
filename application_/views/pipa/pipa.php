<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content-header">
		<h1>Pipa</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pipa</li>
        </ol>
	</section>
	<section class="content">
        <div class="box">
			<div class="box-header with-border">
                <h3 class="box-title">Table Data Pipa</h3>
            </div>
			<div class="box-body">
				<table id="mbrTable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>GID</th>
							<th>Lokasi</th>
							<th>Cabang</th>
							<th>Panjang</th>
							<th>Diameter</th>
							<th>Keterangan</th>
							<th>ID Manometer</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(!empty($pipaRecords)) {
							$no = 1;
							foreach ($pipaRecords as $record) {
								?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $record->gid__2 ?></td>
									<td><?php echo $record->lokasi ?></td>
									<td><?php echo $record->cabang ?></td>
									<td><?php echo $record->panjang ?></td>
									<td><?php echo $record->diameter ?></td>
									<td><?php echo $record->keterangan ?></td>
									<td><?php echo $record->kd_manometer ?></td>
									<td class="text-center">
										<a href="<?php echo base_url(); ?>index.php/pipa/details_pipa/<?php echo $record->ID ?>" class="btn btn-small"><i class="icon fa fa-eye" title="Details"></i></a>
										<a href="<?php echo base_url(); ?>index.php/pipa/edit_pipa/<?php echo $record->ID ?>" class="btn btn-small"><i class="icon fa fa-pencil" title="edit"></i></a>
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