<!--box sortcut-->
<div class="row">
	<div>
    <div style="margin-left:30px; z-index:1000;position:absolute">
    	<img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
  <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
      <h4><i class="fa fa-arrow-circle-right"></i> Tentang Aplikasi</h4>
    
      Selamat Datang Aplikasi SIM-LOG Ver 1.0. Berikut adalah modul untuk peminjaman Barang. Anda dapat melakukan Peminjaman Barang pada modul ini, untuk itu sebelum Anda mencobanya, silahkan baca dulu arahan umum dari Mr.BI ini. Salam & Terimakasih.
  </div>
  </div>
  <div style="margin:15px;">
  <center>
  	<img src="<?php echo base_url();?>assets/dist/img/help/barang.jpg" class="img-responsive" alt="" />
    <?php echo anchor(site_url().'pegawai/barang', 'Input Request Sekarang <i class="fa fa-arrow-circle-right"></i>', array('class'=>'btn btn-primary tultip', 'title'=>'klik untuk input request peminjaman barang'));?>

  </center>
  </div>
</div><!--//end row-->
