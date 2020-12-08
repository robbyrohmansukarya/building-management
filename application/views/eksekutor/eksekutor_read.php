<div class="box box-warning color-palette-box" style="margin-top:15px">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-user"></i> Detail Eksekutor</h3>
        <div class="box-tools pull-right">
        <?php echo anchor(site_url('admin/eksekutor'), '<< Kembali ', array('class'=>'text-warning tultip','title'=>'Kembali ke halaman sebelumnya')); ?>
        </div>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
        <tr>
        	<td width="250">
            <div class="col-lg-12 col-md-12 col-xs-12">
             <img src="<?php echo base_url().'assets/dist/img/eksekutor/'.($photo =='' ? 'avatar04.png':$photo);?>" class="img-thumbnail img-responsive" alt="User Image" />
             </div>
            </td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>ID Eksekutor</td><td>: <?php echo $idpengguna; ?></td></tr>
        <tr><td>Nama Lengkap</td><td>: <?php echo $nama_lengkap; ?></td></tr>
        <tr><td>Unit</td><td>: <?php echo $unit; ?></td></tr>
        <tr><td>Alamat</td><td>: <?php echo $alamat; ?></td></tr>
        <tr><td>No Telp</td><td>: <?php echo $no_telp; ?></td></tr>
        <tr>
        	<td><i class="fa fa-envelope"></i> <strong>Email</strong></td>
            <td>
			<?php 
				$query = $this->db->query("select username as email, password as pwd from login where idpengguna='".$idpengguna."'")->row();
				echo '<strong>'.$query->email.'</strong>'; 
			?>
            </td>
        </tr>
        <tr>
        	<td><i class="fa fa-key"></i> <strong>Password</strong></td>
            <td>
			<?php 
				if($query->pwd != md5($idpengguna)){
					echo '<strong>*****</strong>'; 				
					echo anchor('admin/eksekutor/ubah_pwd/'.$idpengguna.'/ubah-password', '<i class="fa fa-repeat"></i> Resset Password', array('class'=>'btn btn-flat btn-danger btn-xs', 'onclick'=>'return confirm(\'Anda akan merubah password eksekutor, Lanjutkan ?\');'));
				}else{
					echo '<strong>'.$idpengguna.'</strong>';
				}
			?>
            </td>
        </tr>
    </table>        
    </div>
</div>