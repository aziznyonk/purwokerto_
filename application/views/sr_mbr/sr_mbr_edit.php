<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content-header">

	</section>
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Edit Data Pelanggan MBR</h3>
			</div>
			<div class="box-body">
				<form class="form-horizontal" action="<?php echo base_url(); ?>index.php/sr_mbr/save_mbr" method="post">
					<?php
					if (!empty($mbrRecords)) {
						foreach ($mbrRecords as $record) {
					?>
							<fieldset>
								<div class="form-group">
									<label class="col-md-4 control-label" for="textmassage"><?php echo $echo ?></label>
								</div>
								<!-- Text input ID Survey-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="textinput">ID Survey</label>
									<div class="col-md-4">
										<input id="textinput" name="ID_" type="text" value="<?php echo $record->ID_ ?>" class="form-control input-md">
										<span class="help-block">ID Survey</span>
									</div>
								</div>
								<!-- Text input Nama Pelanggan-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="textinput">Nama Pelanggan</label>
									<div class="col-md-4">
										<input id="textinput" name="nama" type="text" value="<?php echo $record->nama ?>" class="form-control input-md">
										<span class="help-block">Nama Pelanggan</span>
									</div>
								</div>

								<!-- Text input Alamat-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="textinput">Alamat</label>
									<div class="col-md-4">
										<input id="textinput" name="alamat" type="text" value="<?php echo $record->alamat ?>" class="form-control input-md">
										<span class="help-block">Alamat Pelanggan</span>
									</div>
								</div>

								<!-- Text input Alamat Dipasang-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="textinput">Alamat Dipasang</label>
									<div class="col-md-4">
										<input id="textinput" name="almt_dipasang" type="text" value="<?php echo $record->almt_dipasang ?>" class="form-control input-md">
										<span class="help-block">Alamat Dipasang</span>
									</div>
								</div>
								<!-- Text input Telfon-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="textinput">Nomor Telfon</label>
									<div class="col-md-4">
										<input id="textinput" name="telfon" type="text" value="<?php echo $record->telfon ?>" class="form-control input-md">
										<span class="help-block">Nomor Telfon</span>
									</div>
								</div>
								<!-- Text input KTP-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="textinput">KTP</label>
									<div class="col-md-4">
										<input id="textinput" name="ktp" type="text" value="<?php echo $record->ktp ?>" class="form-control input-md">
										<span class="help-block">KTP</span>
									</div>
								</div>

								<!-- Text input Type-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="selectbasic">Tipe Bangunan</label>
									<div class="col-md-4">
										<select id="tipe" name="tipe" class="form-control">
											<option value="<?php echo $record->rt_biasa ?>"><?php echo $record->rt_biasa ?></option>
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
								</div>
								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="textinput">Daya Listrik</label>
									<div class="col-md-4">
										<select id=daya name="daya" class="form-control">
											<option value="<?php echo $record->daya_listrik ?>"><?php echo $record->daya_listrik ?></option>
											<option value="0 Watt"> 0 Watt</option>
											<option value="450 Watt">450 Watt</option>
											<option value="900 Watt">900 Watt</option>
											<option value=">900 Watt">>900 Watt</option>
										</select>
										<span class="help-block">Daya Listrik</span>
									</div>
								</div>
								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="textinput">Profesi</label>
									<div class="col-md-4">
										<input id="textinput" name="pekerjaan" type="text" value="<?php echo $record->pekerjaan ?>" class="form-control input-md">
										<span class="help-block">Profesi Pelanggan</span>
									</div>
								</div>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="textinput">Jumlah Penghuni</label>
									<div class="col-md-4">
										<input id="textinput" name="penghuni" type="text" value="<?php echo $record->jml_penghuni ?>" class="form-control input-md">
										<span class="help-block">Jumlah Penghuni</span>
									</div>
								</div>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="textinput">Sumber Air</label>
									<div class="col-md-4">
										<input id="textinput" name="smber_skrg" type="text" value="<?php echo $record->smber_skrg ?>" class="form-control input-md">
										<span class="help-block">Sumber Air</span>
									</div>
								</div>
								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="textinput">Jarak</label>
									<div class="col-md-4">
										<input id="textinput" name="jarak" type="text" value="<?php echo $record->jarak ?>" class="form-control input-md">
										<span class="help-block">Jarak</span>
									</div>
								</div>
								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="textinput">Lebar Jalan</label>
									<div class="col-md-4">
										<input id="textinput" name="lebar_jln" type="text" value="<?php echo $record->lebar_jln ?>" class="form-control input-md">
										<span class="help-block">Lebar Jalan</span>
									</div>
								</div>
								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="textinput">Distribusi Jaringan</label>
									<div class="col-md-4">
										<input id="textinput" name="jaringan_distri" type="text" value="<?php echo $record->jaringan_distri ?>" class="form-control input-md">
										<span class="help-block">Distribusi Jaringan</span>
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