<!-- Modal Map -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Posisi Manometer</h4>
            </div>
            <div id="modal-body" class="modal-body">
                <div id="map" class='map-container' style="height: 512px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--
-------------------------------------------------------------------------------------------------
-->

<!-- Modal Edit -->
<div id="editModal" class="modal fade" tabindex="-2" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document" style="background:white;">
        <div class="modal-header">
            <button type="button" id="closeEdit" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Data Tekanan</h4>
        </div>
        <div id="modal-body" class="modal-body">
            <form action="#" id="frmEdit" class="form-horizontal">
                <div class="form-group">
                    <label for="id_manometer" class="control-label col-lg-2">ID Manometer</label>
                    <div class="col-lg-4">
                        <input type="text" name="id_manometer" id="id_manometer" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_manometer" class="control-label col-lg-2">Nama Manometer</label>
                    <div class="col-lg-4">
                        <input type="text" name="nama_manometer" id="nama_manometer" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lokasi" class="control-label col-lg-2">Lokasi</label>
                    <div class="col-lg-4">
                        <input type="text" name="lokasi" id="lokasi" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="latlng" class="control-label col-lg-2">Latitude Longitude</label>
                    <div class="col-lg-4">
                        <input type="text" name="latlng" id="latlng" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="kondisi" class="control-label col-lg-2">Kondisi</label>
                    <div class="col-lg-4">
                        <input type="text" name="kondisi" id="kondisi" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tekanan" class="control-label col-lg-2">Tekanan</label>
                    <div class="col-lg-4">
                        <input type="text" name="tekanan" id="tekanan" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="keterangan" class="control-label col-lg-2">Keterangan</label>
                    <div class="col-lg-4">
                        <input type="text" name="keterangan" id="keterangan" class="form-control">
                    </div>
                </div>
                <div class="form-group text-right">
                    <div class="col-lg-4">
                        <input type="hidden" name="ID" id="ID" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        <button id="simpan" class="btn btn-primary">SIMPAN</button>
                        <span id="batal" class="btn btn-danger">BATAL</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>