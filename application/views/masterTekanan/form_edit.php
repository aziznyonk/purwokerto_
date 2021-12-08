<div id="win" class="easyui-window" title="My Window" style="width:400px;min-height:500px; padding:10px" data-options="iconCls:'icon-edit',modal:true">
    <form action="#" id="frmEdit" class="form-horizontal">
        <div class="form-group">
            <label for="id_" class="control-label col-lg-3">ID_</label>
            <div class="col-lg-3">
                <input type="text" name="id_" id="id_" class="form-control" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="id_manometer" class="control-label col-lg-3">Manometer</label>
            <div class="col-lg-3">
                <input type="text" name="id_manometer" id="id_manometer" class="form-control">
            </div>
            <div class="col-lg-5">
                <input type="text" name="nama_manometer" id="nama_manometer" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="cabang" class="control-label col-lg-3">Cabang</label>
            <div class="col-lg-8">
                <input type="text" name="cabang" id="cabang" class="form-control">
                <!-- <select name="cabang" id="cabang" class="form-control">
                    <option>--Pilih--</option>
                </select> -->
            </div>
        </div>

        <div class="form-group">
            <label for="nipam" class="control-label col-lg-3">Penanggungjawab</label>
            <div class="col-lg-8">
                <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control">
                <!-- <select name="nipam" id="nipam" class="form-control">
                    <option>--Pilih--</option>
                </select>
                <input type="hidden" name="penanggung_jawab" id="penanggung_jawab" class="form-control"> -->
            </div>
        </div>

        <div class="form-group">
            <label for="lokasi" class="control-label col-lg-3">Lokasi</label>
            <div class="col-lg-8">
                <textarea name="lokasi" id="lokasi" class="form-control"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="latlng" class="control-label col-lg-3">Koordinat</label>
            <div class="col-lg-8">
                <textarea name="latlng" id="latlng" class="form-control"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="koneksi_pipa" class="control-label col-lg-3">Koneksi Pipa</label>
            <div class="col-lg-8">
                <input type="text" name="koneksi_pipa" id="koneksi_pipa" class="form-control">
            </div>
        </div>

        <div class="form-group text-right">
            <div class="col-lg-6">
                <input type="hidden" name="ID" id="ID">
            </div>
            <div class="col-lg-5">
                <button class="btn btn-primary" id="btnUpdate">SIMPAN</button>
                <input type="reset" value="BATAL" id="btnReset" class="btn btn-danger">
            </div>
        </div>
    </form>
</div>