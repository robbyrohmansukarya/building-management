
        <div class="box box-warning color-palette-box" style="margin-top:15px">
            <div class="box-header with-border">
              <h3 class="box-title">Title</h3>
              <div class="box-tools pull-right">
                  <?php echo anchor(site_url('pegawai'), '<< Kembali', array('class'=>'text-warning tultip','title'=>'Kembali ke halaman sebelumnya'));?>
              </div>
            </div>
            <div class="box-body">
                <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                                <label for="varchar">Nama Lengkap <?php echo form_error('nama_lengkap') ?></label>
                                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" />
                            </div>
	    <div class="form-group">
                                <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
                                <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                            </div>
	    <div class="form-group">
                                <label for="varchar">No Telp <?php echo form_error('no_telp') ?></label>
                                <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" />
                            </div>
	    <div class="form-group">
                                <label for="varchar">Photo <?php echo form_error('photo') ?></label>
                                <input type="text" class="form-control" name="photo" id="photo" placeholder="Photo" value="<?php echo $photo; ?>" />
                            </div>
	    <input type="hidden" name="idpengguna" value="<?php echo $idpengguna; ?>" /> 
	    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button> 
	    <a href="<?php echo site_url('pegawai') ?>" class="btn btn-warning"><i class="fa fa-repeat"></i> Batal</a>
	
                </form>
            </div>