<header class="main-header">
<?php 
	$level 				= $this->session->userdata('level');
	$ideksekutor		= $this->session->userdata('idpengguna');
	$table 				= $this->keamanan->table_pengguna($level);
	$info_pengguna= $this->login_model->info_pengguna($table, 'idpengguna', $ideksekutor);

?>
<a href="<?php echo base_url().$level.'/dashboard';?>" class="logo"><img src="<?php echo base_url().'assets/dist/img/bi_logo.png';?>" class="span2" alt="Logo Image" style=""/></a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </a>
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo base_url().'assets/dist/img/eksekutor/'.($info_pengguna->photo =='' ? 'avatar3.png':$info_pengguna->photo);?>" class="user-image" alt="User Image" />
          <span class="hidden-xs"><?php echo ucwords($info_pengguna->nama_lengkap);?></span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="<?php echo base_url().'assets/dist/img/eksekutor/'.($info_pengguna->photo =='' ? 'avatar3.png':$info_pengguna->photo);?>" class="img-circle" alt="User Image" />
            <p>
              <?php echo ucwords($info_pengguna->nama_lengkap);?>
              <small><?php echo ucwords($level);?></small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
              <?php echo anchor('login/signout', 'Sign out', array('class'=>'btn btn-default btn-flat', 'onclick'=>'return confirm(\'Apakah anda yakin keluar ?\');'));?>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
</header>

