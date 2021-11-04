<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content-header">
    </section>
	<section class="content">
        <div class="box">
			<div class="box-header with-border">
                <h3 class="box-title">Edit Data Pipa</h3>
            </div>
			<div class="box-body">
				<form class="form-horizontal" action="<?php echo base_url(); ?>index.php/pipa/save_pipa" method="post">
					<fieldset>
						<?php
							if(!empty($pipaRecords))
							{
								foreach($pipaRecords as $record)
								{
						?>			
									<div class="form-group">
									<label class="col-md-4 control-label" for="textmassage"><?php echo $echo ?></label>    
									</div>
									<!-- Text input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="textinput">GID</label>  
									  <div class="col-md-7">
									  <input id="textinput" name="gid__2" type="text" value="<?php echo $record->gid__2 ?>" class="form-control input-md">
									  <span class="help-block">GID</span>  
									  </div>
									</div>
									<!-- Text input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="textinput">Lokasi</label>  
									  <div class="col-md-7">
									  <input id="textinput" name="lokasi" type="text" value="<?php echo $record->lokasi ?>" class="form-control input-md">
									  <span class="help-block">Lokasi</span>  
									  </div>
									</div>
									<!-- Text input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="textinput">Cabang</label>  
									  <div class="col-md-7">
									  <input id="textinput" name="cabang" type="text" value="<?php echo $record->cabang ?>" class="form-control input-md">
									  <span class="help-block">Cabang</span>  
									  </div>
									</div>
									<!-- Text input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="textinput">Panjang</label>  
									  <div class="col-md-7">
									  <input id="textinput" name="panjang" type="text" value="<?php echo $record->panjang ?>" class="form-control input-md">
									  <span class="help-block">Panjang</span>  
									  </div>
									</div>
									<!-- Text input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="textinput">Diameter</label>  
									  <div class="col-md-7">
									  <input id="textinput" name="diameter" type="text" value="<?php echo $record->diameter ?>" class="form-control input-md">
									  <span class="help-block">Diameter</span>  
									  </div>
									</div>
									<!-- Text input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="textinput">Id Manometer</label>  
									  <div class="col-md-7">
									  <input id="textinput" name="diameter" type="text" value="<?php echo $record->kd_manometer ?>" class="form-control input-md">
									  <span class="help-block">Id Manometer</span>  
									  </div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label" for="textinput">Latitude Longitude</label>  
										<div class="col-md-7">
											<textarea class="form-control input-md" name="latlng"><?php echo $record->latlng ?></textarea>
											<span class="help-block">Latitude Longitude</span>  
										</div>
									</div>
									<!-- Button (Double) -->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="button1id"></label>
									  <div class="col-md-8">
									  <input name="ID" type="hidden" value="<?php echo $record->ID ?>">
										<button id="button1id" name="button1id" class="btn btn-success">Save</button>
									  </div>
									</div>
						<?php			
								}
							}	
						?>
					</fieldset>
				</form>
			</div>
		</div>
	</section>	
</div>