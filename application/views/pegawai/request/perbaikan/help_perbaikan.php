<!--box sortcut-->
<div class="row">
    <div style="margin-left:30px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
    <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
      <h4><i class="fa fa-arrow-circle-right"></i> Hallo, Kenalkan Saya Mr.BI</h4>
    
      Selamat Datang Aplikasi Andromeda 1.2 Berikut adalah modul untuk perbaikan. Anda dapat melakukan komplen perbaikan pada modul ini, untuk itu sebelum Anda mencobanya, silahkan baca dulu arahan umum dari Mr.BI ini. Salam & Terimakasih.
    </div>
    <div style="margin:15px;">
        <center>
        <img src="<?php echo base_url();?>assets/dist/img/help/perbaikan.jpg" class="img-responsive" alt="" />
        <?php echo anchor(site_url().'pegawai/perbaikan/create', 'Input Request Sekarang <i class="fa fa-arrow-circle-right"></i>', array('class'=>'btn btn-primary tultip', 'title'=>'klik untuk input request perbaikan'));?>
        
        </center>
    </div>
</div><!--//end row-->
