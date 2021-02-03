<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<?php 
	$level 		= $this->session->userdata('level');
	$ideksekutor	= $this->session->userdata('idpengguna');
	$table 		= $this->keamanan->table_pengguna($level);
	$info_pengguna= $this->login_model->info_pengguna($table, 'idpengguna', $ideksekutor);
	
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
      <img src="<?php echo base_url().'assets/dist/img/eksekutor/'.($info_pengguna->photo =='' ? 'avatar3.png':$info_pengguna->photo);?>" class="img-circle" alt="User Image" />
    </div>
    <div class="pull-left info">
      <p><?php echo ucwords($info_pengguna->nama_lengkap);?></p>

      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">&nbsp;</li>
    <li class="active">
      <a href="<?php echo base_url().'eksekutor/dashboard';?>">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
      </a>
    </li>

    

    <li class="treeview <?php echo $active_perbaikan;?>">
      <a href="#">
        <i class="fa fa-circle-o text-red"></i>
        <span>Komplain</span> <i class="fa fa-angle-left pull-right"></i></i>
      </a>
      <ul class="treeview-menu">
        <li>
        <?php
          //$ideksekutor   = $this->session->userdata('idpengguna');
          $newPerbaikan = $this->db->query("select * from perbaikan where ideksekutor='".$ideksekutor."' and sts_baca_eksekutor = 0")->num_rows();
          echo anchor('eksekutor/perbaikan','<i class="fa fa-th-list"></i> <span>List Request</span>'.($newPerbaikan > 0 ? '<small class="label pull-right bg-yellow">'.$newPerbaikan.' new <i class="fa fa-envelope-o"></i></small>':' '));
        ?>
        </li>
      </ul>
    </li>

    <li>
      <?php 
        echo anchor('login/signout', '<i class="fa fa-sign-out"></i> <span>Sign Out</span>', array('class'=>'', 'onclick'=>'return confirm(\'Apakah anda yakin keluar ?\');'));
      ?>   
    </li>
</section>
<!-- /.sidebar -->
</aside>