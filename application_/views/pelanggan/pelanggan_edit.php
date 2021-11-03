<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content-header">
	
    </section>
	<section class="content">
        <div class="box">
			<div class="box-header with-border">
                <h3 class="box-title">Edit Data Pelanggan</h3>
            </div>
			<div class="box-body">
				<form class="form-horizontal" action="<?php echo base_url(); ?>index.php/pela/save_pelanggan" method="post">
					<?php 
					if(!empty($pelangganRecords)) {
                        foreach ($pelangganRecords as $record) {
					?>
						<fieldset>
							<div class="form-group">
							  <label class="col-md-4 control-label" for="textmassage"><?php echo $massage ?></label>    
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label" for="textinput">Nomor Pelanggan</label>  
							  <div class="col-md-4">
							  <input id="textinput" name="nomor_pela" type="text" value="<?php echo $record->nomor_pela ?>" class="form-control input-md">
							  <span class="help-block">Nomor Pelanggan</span>  
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label" for="textinput">Nama Pelanggan</label>  
							  <div class="col-md-4">
							  <input id="textinput" name="nama" type="text" value="<?php echo $record->nama ?>" class="form-control input-md">
							  <span class="help-block">Nama Pelanggan</span>  
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label" for="textinput">Alamat</label>  
							  <div class="col-md-4">
							  <input id="textinput" name="alamat" type="text" value="<?php echo $record->alamat ?>" class="form-control input-md">
							  <span class="help-block">Alamat</span>  
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label" for="textinput">Klasifikasi</label>  
							  <div class="col-md-4">
							  <input id="textinput" name="klasifikasi" type="text" value="<?php echo $record->klasifikasi ?>" class="form-control input-md">
							  <span class="help-block">Klasifikasi</span>  
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label" for="textinput">Cabang</label>  
							  <div class="col-md-4">
							  <input id="textinput" name="cabang" type="text" value="<?php echo $record->cabang ?>" class="form-control input-md">
							  <span class="help-block">Cabang</span>  
							  </div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label" for="selectbasic">Status</label>
								<div class="col-md-4">
									<select id="tipe" name="status" class="form-control">
									  <option value="Aktif">Aktif</option>
									  <option value="Tidak Aktif">Tidak Aktif</option>
									</select>	
									<span class="help-block">Status</span>
								</div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label" for="textinput">Latitude Longitude</label>  
							  <div class="col-md-6">
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
						</fieldset>
					<?php		
						}
					}
					?>
				</form>
			</div>
		</div>
	</section>	

</div>