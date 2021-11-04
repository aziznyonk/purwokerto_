<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Hot News</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Hot News</li>
        </ol>
	</section>
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
                <h3 class="box-title">Table Data News</h3>
            </div>
			<div class="box-body">
			<table id="mbrTable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Judul</th>
							<th>Tanggal</th>
							<th>Isi Berita</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(!empty($newsRecords)) {
							$no = 1;
							foreach ($newsRecords as $record) {
								?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $record->judul ?></td>
									<td><?php echo $record->tgl_input ?></td>
									<td><?php echo $record->isiBerita ?></td>
									<td class="text-center">
										<a href="<?php echo base_url(); ?>index.php/news/details_news/<?php echo $record->id ?>" class="btn btn-small"><i class="icon fa fa-eye" title="Details"></i></a>
										<a href="<?php echo base_url(); ?>index.php/news/edit_news/<?php echo $record->id ?>" class="btn btn-small"><i class="icon fa fa-pencil" title="edit"></i></a>
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
