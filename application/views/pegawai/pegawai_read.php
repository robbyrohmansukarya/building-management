<div class="box box-warning color-palette-box" style="margin-top:15px">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-user"></i> Detail Pegawai</h3>
        <div class="box-tools pull-right">
        <?php echo anchor(site_url('admin/pegawai'), '<< Kembali ', array('class'=>'text-warning tultip','title'=>'Kembali ke halaman sebelumnya')); ?>
        </div>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <tr>
                <td width="250">
                <div class="col-lg-12 col-md-12 col-xs-12">
                 <img src="<?php echo base_url().'assets/dist/img/pegawai/'.($photo =='' ? 'avatar3.png':$photo);?>" class="img-thumbnail img-responsive" alt="User Image" />
                 </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr><td>Nomor Induk Pegawai</td><td><?php echo $nomor_induk; ?></td></tr>
            <tr><td>Nama Lengkap</td><td><?php echo ucwords($nama_lengkap); ?></td></tr>
            <tr><td>Jabatan</td><td><?php echo $jabatan; ?></td></tr>
            <tr><td>Jenis Kelamin</td><td><?php echo ($jk =='l' ? 'Laki-Laki':'Perempuan'); ?></td></tr>
            <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
            <tr><td>No Telp</td><td><?php echo $no_telp; ?></td></tr>
        <tr>
        	<td><i class="fa fa-envelope"></i> <strong>Email</strong></td>
            <td> 
			<?php 				
				$query = $this->db->query("select username as email, password as pwd from login where idpengguna='".$idpengguna."'");
				if($query->num_rows() > 0){
					$emailPeg = $query->row();
					echo '<strong>'.$emailPeg->email.'</strong>';
				}else{
					echo '<span class="text-danger">Silahkan klik ';
					echo anchor(site_url('admin/pegawai/update/'.$idpengguna),'<i class="fa fa-edit"></i>', array('class'=>'tultip','title'=>'edit data')); 				
					echo ' untuk setting email pegawai';
				}
				
			?>
            </td>
        </tr>
        <tr>
        	<td><i class="fa fa-key"></i> <strong>Password</strong></td>
            <td>
			<?php 
				if($query->num_rows() > 0){
					$pwdPeg = $query->row();					
					if($pwdPeg->pwd != md5($idpengguna)){
						echo '<strong>*****</strong>'; 				
						echo anchor('admin/pegawai/ubah_pwd/'.$idpengguna.'/ubah-password', '<i class="fa fa-repeat"></i> Resset Password', array('class'=>'btn btn-flat btn-danger btn-xs', 'onclick'=>'return confirm(\'Anda akan merubah password pegawai, Lanjutkan ?\');'));
					}else{
						echo '<strong>'.$idpengguna.'</strong>';
					}
				}else{
					echo '<span class="text-danger">Silahkan klik ';
					echo anchor(site_url('admin/pegawai/update/'.$idpengguna),'<i class="fa fa-edit"></i>', array('class'=>'tultip','title'=>'edit data')); 				
					echo ' untuk setting password pegawai';
				}
			?>
            </td>
        </tr>
        </table>        
    </div>
</div>