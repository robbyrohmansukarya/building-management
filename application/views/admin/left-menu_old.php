<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<?php 
	$level 		= $this->session->userdata('level');
	$idpengguna	= $this->session->userdata('idpengguna');
	$table 		= $this->keamanan->table_pengguna($level);
	$info_pengguna= $this->login_model->info_pengguna($table, 'idpengguna', $idpengguna);
?>

<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?php echo base_url().'assets/dist/img/admin/'.($info_pengguna->photo =='' ? 'avatar3.png':$info_pengguna->photo);?>" class="img-circle" alt="User Image" />
    </div>
    <div class="pull-left info">
      <p><?php echo ucwords($info_pengguna->nama_lengkap);?></p>

      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">&nbsp;</li>
    <li>
      <a href="<?php echo base_url().'admin/dashboard';?>">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
      </a>
    </li>
    <li class="treeview active">
      <a href="#">
        <i class="fa fa-edit"></i>
        <span>New Request</span><i class="fa fa-angle-left pull-right"></i>
        <?php
        	$newReq = $this->db->query("select * from request where sts_baca_admin = 0")->num_rows();
			echo ($newReq > 0 ? '<small class="label pull-right bg-aqua"><i class="fa fa-envelope-o"></i> '.$newReq.'</small>':' ');
		?>
      </a>
      <ul class="treeview-menu">
        <li>
			<?php
				$newPerbaikan = $this->db->query("select * from request where id_kategori='KR01' and sts_baca_admin = 0")->num_rows();
				echo anchor('admin/request/kategori/KR01/perbaikan','<i class="fa fa-angle-right"></i> <span>Perbaikan</span>'.($newPerbaikan > 0 ? '<small class="label pull-right bg-yellow">'.$newPerbaikan.'</small>':' '));
			?>
        </li>
        <li>
		<?php 
        	$newPermintaan = $this->db->query("select * from request where id_kategori='KR02' and sts_baca_admin = 0")->num_rows();
			echo anchor('admin/request/kategori/KR02/permintaan','<i class="fa fa-angle-right"></i> Permintaan'.($newPermintaan > 0 ? '<small class="label pull-right bg-yellow">'.$newPermintaan.'</small>':' '));
		?>
        </li>
        <li>
		<?php 
        	$newPenyedia = $this->db->query("select * from request where id_kategori='KR03' and sts_baca_admin = 0")->num_rows();
			echo anchor('admin/request/kategori/KR03/penyedia','<i class="fa fa-angle-right"></i> Penyedia Ruangan'.($newPenyedia > 0 ? '<small class="label pull-right bg-yellow">'.$newPenyedia.'</small>':' '));
		?>
        </li>
      </ul>
    </li>
    <li>
	<?php
		$newProg = $this->db->query("select * from progres where id_admin='".$idpengguna."' and baca_admin = 0")->num_rows();
		echo anchor('admin/request/historifwd', '<i class="fa fa-wrench"></i> <span>Progres Request</span>'.($newProg > 0 ? '<small class="label pull-right bg-yellow">'.$newProg.'</small>':' '));
	?>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-gears"></i>
        <span>Master Data</span><i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><?php echo anchor('admin/admin/daftar','<i class="fa fa-angle-right"></i> <span>Admin</span>');?></li>
        <li><?php echo anchor('admin/pegawai','<i class="fa fa-angle-right"></i> <span>Pegawai</span>');?></li>
        <li><?php echo anchor('admin/eksekutor','<i class="fa fa-angle-right"></i> Eksekutor');?></li>
      </ul>
    </li>
    <li><?php echo anchor('login/signout', '<i class="fa fa-sign-out"></i> <span>Sign Out</span>', array('class'=>'', 'onclick'=>'return confirm(\'Apakah anda yakin keluar ?\');'));?></li>
</section>
<!-- /.sidebar -->
</aside>