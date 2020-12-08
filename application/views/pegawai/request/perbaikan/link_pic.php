<div class="box box-warning color-palette-box" style="margin-top:15px">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-picture-o"></i> Gambar / Foto Lampiran</h3>
        <div class="box-tools pull-right">
        <?php echo anchor(site_url('pegawai/perbaikan/progres/'.$id_request.'/progres-request'), '<< Kembali ', array('class'=>'text-warning tultip','title'=>'Kembali ke halaman sebelumnya')); ?>
        </div>
    </div>
    <div class="box-body table-responsive">
        <div class="col-lg-6 col-md-6 col-xs-12">
         <img src="<?php echo base_url().'assets/dist/img/request/'.($photo =='' ? 'no.jpg':$photo);?>" class="img-thumbnail span1 img-responsive" alt="User Image" />
         </div>

    </div>
</div>