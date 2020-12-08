<div class="row">
	<div>
        <div style="margin-left:30px; z-index:1000;position:absolute">
            <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
        </div>
      <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
          <h4><i class="fa fa-arrow-circle-right"></i> Hallo, Perkenalkan Saya Mr.BI</h4>        
      Aplikasi Sistem Informasi Logistik membantu Pegawai Bank Indonesia dalam memudahkan penanganan permasalahan teknis atau non teknis. Anda dapat menggunakan fasilitas Request untuk penanganan segera terkait permaslahan yang Anda miliki.
      </div>
  </div>
</div>

<div class="row">
  <div style="margin:15px;">

    <div class="box box-warning quick-link">
        <div class="box-header">
          <i class="fa fa-circle text-primary"></i>
          <h3 class="box-title">Ruang Rapat</h3>
        </div><!-- /.box-header -->
        <div class="box-body" style="overflow:auto;">

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>
				  <?php 
                        //$this->Request_model->hitungRequest($idpengguna, 'request', 'sts_eksekusi', 0);
                        $menunggu		= $this->Ruangan_model->hitungRequest($idpengguna, 'request_ruangan', 'sts_eksekusi', 0);
						$tersedia 		= $this->Ruangan_model->hitungRequest($idpengguna, 'request_ruangan', 'sts_eksekusi', 1);
                        $tidakTersedia 	= $this->Ruangan_model->hitungRequest($idpengguna, 'request_ruangan', 'sts_eksekusi', 2);
                        $allRequestRuangan 	= $this->Ruangan_model->hitungAllRequest($idpengguna, 'request_ruangan');
                        echo $menunggu;
                  ?>
                    </h3>
                  <p>Menunggu</p>
                </div>
                <div class="icon">
                  <i class="fa fa-clock-o"></i>
                </div>
                
                </div>
            </div><!-- ./col -->
            
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $tersedia;?></h3>
                  <p>Siap Digunakan</p>
                </div>
                <div class="icon">
                  <i class="fa fa-wrench"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $tidakTersedia;?></h3>
                  <p>Tidak Tersedia</p>
                </div>
                <div class="icon">
                  <i class="fa fa-check-square"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $allRequestRuangan;?></h3>
                  <p>All Request</p>
                </div>
                <div class="icon">
                  <i class="fa fa-edit"></i>
                </div>
              </div>
            </div><!-- ./col -->
        
        </div><!-- /.box-body -->
    </div><!-- /.box -->

<!-- PERBAIKAN -->
    <div class="box box-warning quick-link">
        <div class="box-header">
          <i class="fa fa-circle text-primary"></i>
          <h3 class="box-title">Perbaikan</h3>
        </div><!-- /.box-header -->
        <div class="box-body" style="overflow:auto;">

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>
      				  <?php 
      					//hitung						
      					$jmlWaiting		= $this->Perbaikan_model->hitungRequest($idpengguna,'perbaikan', 'sts_eksekusi', 0);
      					$jmlSedang 		= $this->Perbaikan_model->hitungRequest($idpengguna,'perbaikan', 'sts_eksekusi', 1);
      					$jmlSelesai 	= $this->Perbaikan_model->hitungRequest($idpengguna,'perbaikan', 'sts_eksekusi', 2);
      					$allRequest 	= $this->Perbaikan_model->hitungAllRequest($idpengguna,'perbaikan');
      					echo $jmlWaiting;
      				  ?>
                  </h3>
                  <p>Waiting List</p>
                </div>
                <div class="icon">
                  <i class="fa fa-clock-o"></i>
                </div>
                
                </div>
            </div><!-- ./col -->
            
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $jmlSedang;?></h3>
                  <p>Sedang Ditangani</p>
                </div>
                <div class="icon">
                  <i class="fa fa-wrench"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $jmlSelesai;?></h3>
                  <p>Selesai Dikerjakan</p>
                </div>
                <div class="icon">
                  <i class="fa fa-check-square"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $allRequest;?></h3>
                  <p>All Request</p>
                </div>
                <div class="icon">
                  <i class="fa fa-edit"></i>
                </div>
              </div>
            </div><!-- ./col -->
        
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <!-- PEMINJAMAN BARANG -->
    <div class="box box-warning quick-link">
        <div class="box-header">
          <i class="fa fa-circle text-primary"></i>
          <h3 class="box-title">Peminjaman</h3>
        </div><!-- /.box-header -->
        <div class="box-body" style="overflow:auto;">

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>
				  <?php 
                    $wait	= $this->Barang_model->hitungRequest($idpengguna,'request_barang', 'verifikasi', 0);
                    $siap = $this->Barang_model->hitungRequest($idpengguna,'request_barang', 'verifikasi', 1);
                    $dikembalikan = $this->Barang_model->hitungRequest($idpengguna,'request_barang', 'verifikasi', 2);
                    $allPeminjaman 	= $this->Barang_model->hitungAllRequest($idpengguna,'request_barang');					
                    echo $wait;
                  ?>
                  </h3>
                  <p>Menuggu</p>
                </div>
                <div class="icon">
                  <i class="fa fa-clock-o"></i>
                </div>
                
                </div>
            </div><!-- ./col -->
            
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $siap;?></h3>
                  <p>Siap</p>
                </div>
                <div class="icon">
                  <i class="fa fa-wrench"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $dikembalikan;?></h3>
                  <p>Dikembalikan</p>
                </div>
                <div class="icon">
                  <i class="fa fa-check-square"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $allPeminjaman;?></h3>
                  <p>All Request</p>
                </div>
                <div class="icon">
                  <i class="fa fa-edit"></i>
                </div>
              </div>
            </div><!-- ./col -->
        
        </div><!-- /.box-body -->
    </div><!-- /.box -->

</div><!-- /.row -->