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
    <li><?php echo anchor('pegawai/request/create','<i class="fa fa-edit"></i> <span>Input Request</span>');?></li>
    <li><?php echo anchor('pegawai/request','<i class="fa fa-folder-o"></i> <span>History Request</span>');?></li>
    <li><?php echo anchor('login/signout', '<i class="fa fa-sign-out"></i> <span>Sign Out</span>', array('class'=>'', 'onclick'=>'return confirm(\'Apakah anda yakin keluar ?\');'));?></li>
</section>
<!-- /.sidebar -->
</aside>