<div class="row">
	<div>
        <div style="margin-left:30px; z-index:1000;position:absolute">
            <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
        </div>
      <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
          <h4><i class="fa fa-arrow-circle-right"></i> Hallo, Perkenalkan Saya Mr....</h4>        
      Aplikasi Komplain dalam memudahkan penanganan permasalahan teknis atau non teknis. Anda dapat menggunakan fasilitas Request untuk penanganan segera terkait permaslahan yang Anda miliki.
      </div>
  </div>
</div>

<div class="row">
  <div style="margin:15px;">


<!-- PERBAIKAN -->
    <div class="box box-warning quick-link">
        <div class="box-header">
          <i class="fa fa-circle text-primary"></i>
          <h3 class="box-title">Komplain</h3>
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

   

</div><!-- /.row -->