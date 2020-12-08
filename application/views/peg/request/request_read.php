
        <div class="box box-warning color-palette-box" style="margin-top:15px">
            <div class="box-header with-border">
              <h3 class="box-title">Title</h3>
              <div class="box-tools pull-right">
                  <?php echo anchor(site_url('request'), '<< Kembali ', array('class'=>'text-warning tultip','title'=>'Kembali ke halaman sebelumnya')); ?>
              </div>
            </div>
            <div class="box-body">
                <table class="table">
	    <tr><td>Id Kategori</td><td><?php echo $id_kategori; ?></td></tr>
	    <tr><td>Id Klasifikasi</td><td><?php echo $id_klasifikasi; ?></td></tr>
	    <tr><td>Idpengguna</td><td><?php echo $idpengguna; ?></td></tr>
	    <tr><td>Request</td><td><?php echo $request; ?></td></tr>
	    <tr><td>Deskripsi Request</td><td><?php echo $deskripsi_request; ?></td></tr>
	    <tr><td>Baca Admin</td><td><?php echo $baca_admin; ?></td></tr>
	    <tr><td>Baca Eksekutor</td><td><?php echo $baca_eksekutor; ?></td></tr>
	    <tr><td>Sts Baca Admin</td><td><?php echo $sts_baca_admin; ?></td></tr>
	    <tr><td>Sts Baca Eksekutor</td><td><?php echo $sts_baca_eksekutor; ?></td></tr>
	    <tr><td>Sts Eksekusi</td><td><?php echo $sts_eksekusi; ?></td></tr>
	
                </table>        
            </div>