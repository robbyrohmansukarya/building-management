<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<?php 
	$level 		= $this->session->userdata('level');
	$idpengguna	= $this->session->userdata('idpengguna');
	$table 		= $this->keamanan->table_pengguna($level);
	$info_pengguna= $this->login_model->info_pengguna($table, 'idpengguna', $idpengguna);

	$menu = $this->uri->segment(2);

	$active_perbaikan	='';
	$active_ruangan	='';
	$active_perbaikan = ($menu == 'perbaikan' ? 'active' : '');
	$active_ruangan = ($menu == 'ruangan' ? 'active' : '');
	$active_barang = ($menu == 'barang' ? 'active' : '');
	$active_master = ($menu == 'admin' ? 'active' : '');
	
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
        <i class="fa fa-dashboard"></i> <span>Beranda</span></i>
      </a>
    </li>
    
    <li class="treeview <?php echo $active_ruangan;?>">
    	<?php
          $newBooking = $this->db->query("select * from request_ruangan where sts_baca_admin = 0 group by id_request")->num_rows();        
		?>	
      <a href="#">
        <i class="fa fa-circle-o text-yellow"></i>
        <span>Ruang Rapat &nbsp;<?php echo ($newBooking > 0 ? '<small class="label bg-yellow">New '.$newBooking.' <i class="fa fa-envelope-o"></i></small>':' ');?></span><i class="fa fa-angle-left pull-right"></i></i>
      </a>
      <ul class="treeview-menu">
        <li>
        <?php 
          echo anchor('admin/ruangan/inbox','<i class="fa fa-angle-right"></i> <span>Kotak Masuk</span>');          
        ?>  
        </li>
        <li><?php echo anchor('admin/ruangan/daftar_booking','<i class="fa fa-angle-right"></i> <span>Daftar Peminjaman</span>');?></li>
        <li><?php echo anchor('admin/ruangan/status_eksekutor','<i class="fa fa-angle-right"></i> <span>Status Eksekutor</span>');?></li>
        <li><?php echo anchor('admin/excel_ruangan/export','<i class="fa fa-angle-right"></i> <span>Unduh Laporan</span>');?></li>
      </ul>
    </li>

    <li class="treeview <?php echo $active_perbaikan;?>">
      <a href="#">
        <i class="fa fa-circle-o text-red"></i>
        <span>Perbaikan</span><i class="fa fa-angle-left pull-right"></i></i>
      </a>
      <ul class="treeview-menu">
        <li>
        <?php
          $newPerbaikan = $this->db->query("select * from perbaikan where sts_baca_admin = 0")->num_rows();
          echo anchor('admin/perbaikan','<i class="fa fa-angle-right"></i> <span>Kotak Masuk</span>'.($newPerbaikan > 0 ? '<small class="label pull-right bg-yellow">'.$newPerbaikan.' <i class="fa fa-envelope-o"></i></small>':' '));
        ?>
        </li>
        <li><?php echo anchor('admin/perbaikan/historifwd','<i class="fa fa-angle-right"></i> <span>Cek Progres</span>');?></li>
        <li><?php echo anchor('admin/excel/export','<i class="fa fa-angle-right"></i> <span>Unduh Laporan</span>');?></li>
      </ul>
    </li>

    <li class="treeview <?php echo $active_barang;?>">
      <a href="#">
        <i class="fa fa-circle-o text-aqua"></i>
        <span>Peminjaman</span><i class="fa fa-angle-left pull-right"></i></i>
      </a>
      <ul class="treeview-menu">
        <li>
        <?php
          $newPeminjaman = $this->db->query("select * from request_barang where sts_baca_admin = 0 group by id_request")->num_rows();
          echo anchor('admin/barang/inbox','<i class="fa fa-angle-right"></i> <span>Kotak Masuk </span>'.($newPeminjaman > 0 ? '<small class="label pull-right bg-yellow">'.$newPeminjaman.' <i class="fa fa-envelope-o"></i></small>':' '));

        ?>
        </li>
        <li><?php echo anchor('admin/barang/tracking','<i class="fa fa-angle-right"></i> <span>Pelacakan</span>');?></li>
        <li><?php echo anchor('admin/excel_barang/export','<i class="fa fa-angle-right"></i> <span>Unduh Laporan</span>');?></li>
      </ul>
    </li>
    
    </li>
    
    <li class="treeview <?php echo $active_master;?>">
      <a href="#">
        <i class="fa fa-gears"></i>
        <span>Data Utama</span><i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><?php echo anchor('admin/admin/daftar','<i class="fa fa-angle-right"></i> <span>Admin</span>');?></li>
        <li><?php echo anchor('admin/pegawai','<i class="fa fa-angle-right"></i> <span>Pegawai</span>');?></li>
        <li><?php echo anchor('admin/eksekutor','<i class="fa fa-angle-right"></i> Eksekutor');?></li>
        
        <li><?php echo anchor('admin/barang','<i class="fa fa-angle-right"></i> Barang');?></li>
        <li><?php echo anchor('admin/ruangan','<i class="fa fa-angle-right"></i> Ruangan');?></li>
        <li><?php echo anchor('admin/lokasi','<i class="fa fa-angle-right"></i> Lokasi');?></li>
      </ul>
    </li>
    <li>
		<?php 
			echo anchor('admin/feedback', '<i class="fa fa-comments-o text-green"></i> <span>Feed Back</span>', array('class'=>''));
		?>
    </li>
    
    <li><?php echo anchor('login/signout', '<i class="fa fa-sign-out"></i> <span>Keluar</span>', array('class'=>'', 'onclick'=>'return confirm(\'Apakah anda yakin keluar ?\');'));?></li>
</section>
<!-- /.sidebar -->
</aside>