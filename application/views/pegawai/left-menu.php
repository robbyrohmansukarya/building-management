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
?>	
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?php echo base_url().'assets/dist/img/pegawai/'.($info_pengguna->photo =='' ? 'avatar3.png':$info_pengguna->photo);?>" class="img-circle" alt="User Image" />
    </div>
    <div class="pull-left info">
      <p><?php echo ucwords($info_pengguna->nama_lengkap);?></p>

      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <!-- search form -->
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search..."/>
      <span class="input-group-btn">
        <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
      </span>
    </div>
  </form>
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">&nbsp;</li>
    <li class="active">
      <a href="<?php echo base_url().$level.'/dashboard';?>">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
      </a>
    </li>
    <li class="treeview <?php echo $active_perbaikan;?>">
      <a href="#">
        <i class="fa fa-circle-o text-red"></i>
        <span>Perbaikan</span><i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <?php 
            //echo anchor('pegawai/perbaikan/create','<i class="fa fa-edit"></i> <span>Input Perbaikan</span>');
            echo anchor('pegawai/perbaikan/help','<i class="fa fa-edit"></i> <span>Input Perbaikan</span>');
          ?>    
        </li>
        <li>
          <?php 
            echo anchor('pegawai/perbaikan','<i class="fa fa-th-list"></i> <span>Daftar Perbaikan</span>');
          ?>
        </li>
        <li>
        <?php 
          $newProgres = $this->db->query("select id from progres_perbaikan where id_pegawai='".$idpengguna."' and baca_pegawai = 0")->num_rows();
            echo anchor('pegawai/perbaikan/historifwd/'.$idpengguna, '<i class="fa fa-wrench"></i> <span>Cek Progres</span>'.($newProgres > 0 ? '<small class="label pull-right bg-yellow">'.$newProgres.'</small>':' '));
        ?>          
        </li>
        <li>
          <?php 
            echo anchor('pegawai/perbaikan','<i class="fa fa-folder-open-o"></i> <span>Histori Perbaikan</span>');
          ?>
        </li>
      </ul>
    </li>
    <li class="treeview <?php echo $active_ruangan;?>">
      <a href="#">
        <i class="fa fa-circle-o text-yellow"></i>
        <span>Ruang Rapat</span><i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
		<?php 
		echo anchor('pegawai/ruangan/master/data-master-ruangan','<i class="fa fa-home"></i> <span>Data Ruangan</span>');?>
        </li>
        <li><?php echo anchor('pegawai/ruangan/cek_ruangan','<i class="fa fa-th-list"></i> <span>Daftar Booking</span>');?></li>
        <li>
		<?php 
			//echo anchor('pegawai/ruangan/booking','<i class="fa fa-edit"></i> <span>Input Booking</span>');
			echo anchor('pegawai/ruangan/help','<i class="fa fa-edit"></i> <span>Input Booking</span>');
		?>
        </li>
        <li><?php echo anchor('pegawai/ruangan/booking_status','<i class="fa fa-check-square"></i> <span>Cek Status</span>');?></li>
      </ul>
    </li>
    <li class="treeview <?php echo $active_barang;?>">
      <a href="#">
        <i class="fa fa-circle-o text-aqua"></i>
        <span>Pinjam Barang</span><i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><?php echo anchor('pegawai/barang/daftar','<i class="fa fa-th-list"></i> <span>Daftar Pinjam</span>');?></li>
        <li>
		<?php 
		//echo anchor('pegawai/barang','<i class="fa fa-edit"></i> <span>Pinjam Baru</span>');
		echo anchor('pegawai/barang/help','<i class="fa fa-edit"></i> <span>Pinjam Baru</span>');
		?>
        </li>
      </ul>
    </li>
    <li>
		<?php 
			echo anchor('pegawai/feedback', '<i class="fa fa-comments-o text-green"></i> <span>Feed Back</span>', array('class'=>''));
		?>
    </li>

    <li><?php echo anchor('login/signout', '<i class="fa fa-sign-out"></i> <span>Sign Out</span>', array('class'=>'', 'onclick'=>'return confirm(\'Apakah anda yakin keluar ?\');'));?>
    </li>
</section>
<!-- /.sidebar -->
</aside>