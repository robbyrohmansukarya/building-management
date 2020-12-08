
        <div class="box box-warning color-palette-box" style="margin-top:15px">
            <div class="box-header with-border">
              <h3 class="box-title">Title</h3>
              <div class="box-tools pull-right">
                  <?php echo anchor(site_url('pegawai'), '<< Kembali ', array('class'=>'text-warning tultip','title'=>'Kembali ke halaman sebelumnya')); ?>
              </div>
            </div>
            <div class="box-body">
                <table class="table">
	    <tr><td>Nama Lengkap</td><td><?php echo $nama_lengkap; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>No Telp</td><td><?php echo $no_telp; ?></td></tr>
	    <tr><td>Photo</td><td><?php echo $photo; ?></td></tr>
	
                </table>        
            </div>