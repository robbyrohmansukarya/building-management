<div style="margin:10px 0 0 0">
<?php $this->load->view('message/message');?>
</div>

<div class="row">
    <div style="margin-left:30px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
    <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
      <h4><i class="fa fa-arrow-circle-right"></i> Hii, I'm Is Your Help Desk ... </h4>
      Hallo, saat ini anda sedang melihat daftar perbaikan yang anda lakukan. Untuk mengecek  detail setiap 
      perbaikan anda <br> silahkan klik lihat progres pada tabel aksi, Salam dan Terimakasih 
    </div>
</div>
<!-- quick email widget -->
<div class="box box-info" style="margin-top:15px">
    <div class="box-header">
        <?php echo $title;?>
        <!-- tools box -->
        <div class="pull-right box-tools">
		<?php echo anchor(site_url('pegawai/perbaikan'), '<i class="fa fa-th-list" aria-hidden="true"></i> Daftar Perbaikan', array('class'=>'btn btn-xs btn-info tultip','title'=>'Histori Request Perbaikan')); ?>	    
        </div><!-- /. tools -->
    </div>
    <?php echo form_open_multipart($action, array('role'=>'form', 'id'=>'validForm'));?>
    <div class="box-body">

        <div class="row">
            <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-wrench"></i></span>
                        <input type="text" class="form-control" name="request" id="request" placeholder="Nama Perbaikan" value="<?php echo $request; ?>"
                         required data-bv-trigger="blur" data-bv-notempty-message="<i class='fa fa-times-circle'></i> nama perbaikan harus diisi" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <select class="form-control" name="kode_lokasi" required data-bv-trigger="blur" 
                        data-bv-notempty-message="<i class='fa fa-times-circle'></i> Silahkan pilih kategori request">
                        <option value="">-- Lokasi Perbaikan --</option>
                        <?php
                            foreach($lokasi as $rowLokasi):
                            $selectedKdLokasi= ($kode_lokasi== $rowLokasi->kode_lokasi ? 'selected':' ');
                        ?>
                            <option value="<?php echo $rowLokasi->kode_lokasi;?>" <?php echo $selectedKdLokasi;?>>
                                <?php echo $rowLokasi->lokasi;?>
                            </option>
                        <?php       
                            endforeach;
                        ?>
                        </select>       
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                  <textarea class="form-control" placeholder="Tulis deskripsi anda disini .." style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="deskripsi_request" required data-bv-trigger="blur" 
                data-bv-notempty-message="<i class='fa fa-times-circle'></i> silahkan isi deskripsi "><?php echo $deskripsi_request;?></textarea>

                </div>
            </div>
        </div>

		<?php
            if($photo != ''){
         ?>
            <div class="row">
                <div class="form-group col-lg-4 col-md-6 col-xs-12">
                    <img src="<?php echo base_url().'assets/dist/img/request/'.$photo;?>" class="img-thumbnail img-responsive" alt="User Image" />
                </div>
            </div>
         <?php 
            }
        ?>
        <div class="form-group">
            <!--<div class="btn btn-default btn-file">-->
              <i class="fa fa-paperclip"></i> Foto Lampiran
              <input type="file" name="photo" accept="image/*" />
            <!--</div>-->
            <p class="help-block">*Kosongkan jika tidak ada foto yang dapat dilampirkan</p>
        </div>

        <div class="row">
            <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <input type="hidden" name="id_request" value="<?php echo $id_request; ?>" /> 
                    <button class="pull-right btn btn-primary" type="submit">Send Request <i class="fa fa-arrow-circle-right"></i></button>
                </div>
            </div>
        </div>
      
    </div><!--//end box-body-->
	<?php echo form_close();?>
</div>