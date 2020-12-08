<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?php echo base_url().'assets/dist/img/avatar2.png';?>" class="img-circle" alt="User Image" />
    </div>
    <div class="pull-left info">
      <p>Admin</p>

      <a href="#"><i class="fa fa-circle text-success"></i> Aktif</a>
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
      <a href="<?php echo base_url().'dashboard';?>">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
      </a>
    </li>
    <li class="treeview active">
      <a href="#">
        <i class="fa fa-gears"></i>
        <span>Data Master</span><i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><?php echo anchor('mahasiswa','<i class="fa fa-gear text-danger"></i> Mahasiswa');?></li>
        <li><?php echo anchor('dosen','<i class="fa fa-gear text-danger"></i> Dosen');?></li>
        <li><?php echo anchor('matakuliah','<i class="fa fa-gear text-danger"></i> Matakuliah');?></li>
        <li><?php echo anchor('praktikum','<i class="fa fa-gear text-danger"></i> Praktikum');?></li>
        <li><?php echo anchor('kelas','<i class="fa fa-gear text-danger"></i> Kelas');?></li>
        <li><?php echo anchor('kelas_status','<i class="fa fa-gear text-danger"></i> Status Kelas');?></li>
        <li><?php echo anchor('beban_sks','<i class="fa fa-gear text-danger"></i> Beban SKS');?></li>
        <li><?php echo anchor('beban_utsuas','<i class="fa fa-gear text-danger"></i> Beban UTS dan UAS');?></li>
        <li><?php echo anchor('config','<i class="fa fa-gear text-danger"></i> Configurasi Sistem');?></li>
        <li><?php echo anchor('prodi','<i class="fa fa-gear text-danger"></i> Program Studi');?></li>
        <li><?php echo anchor('provinsi','<i class="fa fa-gear text-danger"></i> Provinsi');?></li>
        <li><?php echo anchor('pengguna','<i class="fa fa-user text-danger"></i> Pengguna');?></li>
      </ul>
    </li>
</section>
<!-- /.sidebar -->
</aside>