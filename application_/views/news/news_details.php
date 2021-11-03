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
							if(!empty($newsRecords))
							{
								foreach($newsRecords as $record)
								{
						?>
						<div class="form-group">
							<label class="col-md-4 ">ID : <?php echo $record->id ?></label>
						</div>
						<div class="form-group">
							<label class="col-md-4 ">Judul : <?php echo $record->judul ?></label>
						</div>
						<div class="form-group">
							<label class="col-md-4 ">Tanggal Input : <?php echo $record->tgl_input ?></label>
						</div>
						<div class="form-group">
							<label class="col-md-4 ">Isi Berita : <?php echo $record->isiBerita ?></label>
						</div>
						<?php
								}
							}else{
								echo $newsRecords->ID;
							}	
						?>
					</fieldset>
				</form>
			</div>	
		</div>
	</section>	
</div>	
