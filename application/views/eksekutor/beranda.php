<!--box sortcut-->
<div class="row" style="margin-top:15px; padding:15px;">

    <div class="callout callout-warning" style="margin-bottom: 0!important;">                        
        <h4><i class="fa fa-arrow-circle-right"></i> Tentang Aplikasi</h4>
        Aplikasi Sistem Informasi Logistik membantu Pegawai Bank Indonesia dalam memudahkan penanganan permasalahan teknis atau non teknis. Anda dapat menggunakan fasilitas Request untuk penanganan segera terkait permaslahan yang Anda miliki.
    </div>

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
                    //hitung
                    $menunggu		= $this->Ruangan_model->getRequestSts('request_ruangan', 'sts_eksekusi', 0)->num_rows();
                    $tersedia 		= $this->Ruangan_model->getRequestSts('request_ruangan', 'sts_eksekusi', 1)->num_rows();
                    $tidakTersedia 	= $this->Ruangan_model->getRequestSts('request_ruangan', 'sts_eksekusi', 2)->num_rows();
                    $allRequestRuangan 	= $this->Ruangan_model->admGet_allReq()->num_rows();
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
                $jmlWaiting   = $this->Perbaikan_model->getRequestSts('perbaikan', 'sts_eksekusi', 0)->num_rows();
                $jmlSedang    = $this->Perbaikan_model->getRequestSts('perbaikan', 'sts_eksekusi', 1)->num_rows();
                $jmlSelesai   = $this->Perbaikan_model->getRequestSts('perbaikan', 'sts_eksekusi', 2)->num_rows();
                $allRequest   = $this->Perbaikan_model->admGet_allReq()->num_rows();
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

</div><!--//end row-->