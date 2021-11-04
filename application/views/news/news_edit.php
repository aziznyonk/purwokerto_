<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrapper">
	<section class="content-header">
    </section>
	<section class="content">
        <div class="box">
			<div class="box-header with-border">
                <h3 class="box-title">Edit Data Hot News</h3>
            </div>
			<div class="box-body">
				<form class="form-horizontal" action="<?php echo base_url(); ?>index.php/news/save_news" method="post">
					<fieldset>
						<div class="form-group">
							<div class="col-md-12">
								<div class="alert alert-danger alert-dismissible" style="display:<?php echo $echo?>">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> Alert!</h4>
									FAILED - Update data news gagal
								</div>
								<div class="alert alert-success alert-dismissible" style="display:<?php echo $ech?>">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-check"></i> Success!</h4>
									Success - Update data news berhasil
								</div>
							</div>
						</div>
						<?php
							if(!empty($newsRecords))
							{
								foreach($newsRecords as $record)
								{
						?>
									<!-- Text input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="textinput">Judul Berita</label>  
									  <div class="col-md-6">
									  <input id="textinput" name="judul" type="text" value="<?php echo $record->judul ?>" class="form-control input-md">
									  <span class="help-block">Judul Berita</span>  
									  </div>
									</div>
									<!-- Date input-->
									<div class="form-group">
										<label class="col-md-4 control-label" for="dateinput">Tanggal Input</label>  
										<div class="col-md-6">
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" name="tgl_input" class="form-control" id="datepicker" value="<?php echo $record->tgl_input ?>"> 
											</div>
										</div>
										
									</div>
									<!-- Text Area input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="textinput">Isi Berita</label>  
									  <div class="col-md-6">
									  <textarea class="textarea" name="isiBerita"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $record->isiBerita?></textarea>
									  <span class="help-block">Isi Berita</span>  
									  </div>
									</div>
									<!-- Button (Double) -->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="button1id"></label>
									  <div class="col-md-8">
										<input name="id" type="hidden" value="<?php echo $record->id ?>">
										<button id="button1id" name="button1id" class="btn btn-success">Save</button>
									  </div>
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