<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content-header">
    </section>
	<section class="content">
        <div class="box">
			<div class="box-header with-border">
                <h3 class="box-title">Details Data <?php echo $title?></h3>
            </div>
			<div class="box-body">
				<form class="form-horizontal">
					<fieldset>
						<?php
							if(!empty($pipaRecords))
							{
								foreach($pipaRecords as $record)
								{
						?>			
									<div class="form-group">
										<label class="col-md-2 col-md-offset-2">ID</label>
										<label class="col-md-8">: <?php echo $record->ID ?></label>
									</div>
									<div class="form-group">
										<label class="col-md-2 col-md-offset-2">GID</label>
										<label class="col-md-8">: <?php echo $record->gid__2 ?></label>
									</div>
									<div class="form-group">
										<label class="col-md-2 col-md-offset-2">Lokasi</label>
										<label class="col-md-8">: <?php echo $record->lokasi ?></label>
									</div>
									<div class="form-group">
										<label class="col-md-2 col-md-offset-2">Cabang </label>
										<label class="col-md-8">: <?php echo $record->cabang ?></label>
									</div>
									<div class="form-group">
										<label class="col-md-2 col-md-offset-2">Panjang </label>
										<label class="col-md-8">: <?php echo $record->panjang ?></label>
									</div>
									<div class="form-group">
										<label class="col-md-2 col-md-offset-2">Diameter </label>
										<label class="col-md-8">: <?php echo $record->diameter ?></label>
									</div>
									<div class="form-group">
										<label class="col-md-2 col-md-offset-2">Keterangan </label>

										<label class="col-md-8">: <?php echo $record->keterangan ?></label>
									</div>
									<div class="form-group">
										<label class="col-md-2 col-md-offset-2">Nomor SPK </label>

										<label class="col-md-8">: <?php echo $record->nospk ?></label>
									</div>
									<div class="form-group">
										<label class="col-md-2 col-md-offset-2">Pelaksana</label>

										<label class="col-md-8">: <?php echo $record->pelaksana ?></label>
									</div>
									<div class="form-group">
										<label class="col-md-2 col-md-offset-2">Bahan</label>

										<label class="col-md-8">: <?php echo $record->bahan ?></label>
									</div>
									<div class="form-group">
										<label class="col-md-2 col-md-offset-2">Status </label>

										<label class="col-md-8">: <?php echo $record->statuspipa ?></label>
									</div>
									<div class="form-group">
										<label class="col-md-2 col-md-offset-2">Latitude Longitude </label>

										<label class="col-md-8">: <?php echo $record->latlng ?></label>
									</div>
									<div class="form-group">
										<label class="col-md-2 col-md-offset-2">Kode Manometer </label>

										<label class="col-md-8">: <?php echo $record->kd_manometer ?></label>
									</div>
						<?php			
								}
							}	
						?>
					</fieldset>
			</div>
		</div>
	</section>	
</div>