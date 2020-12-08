<div style="margin:10px 0 0 0">
<?php $this->load->view('message/message');?>
</div>

<div class="box box-primary" style="margin-top:15px">
    <div class="box-header with-border">
	    <h3 class="box-title"><?php echo $title;?></h3>
        <div class="box-tools pull-right">
	        <?php echo anchor(site_url('admin/lokasi'), '<< Kembali', array('class'=>'text-warning tultip','title'=>'Kembali ke halaman sebelumnya'));?>
        </div>
    </div>
    <div class="box-body">
    <?php echo form_open($action, array('role'=>'form', 'id'=>'validForm'));?>

        <div class="row">
            <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                        <input type="text" class="form-control" name="kode_lokasi" id="kode_lokasi" placeholder="<?php echo $kode_lokasi;?>" disabled  />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                        <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Nama lokasi" value="<?php echo $lokasi; ?>"
                         required data-bv-trigger="blur" data-bv-notempty-message="<i class='fa fa-times-circle'></i> nama lokasi harus diisi" />
                    </div>
                </div>
            </div>
        </div>
                              
        <input type="hidden" name="kode_lokasi" value="<?php echo $kode_lokasi; ?>" /> 
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button> 
        <a href="<?php echo site_url('admin/lokasi') ?>" class="btn btn-warning"><i class="fa fa-repeat"></i> Batal</a>
    <?php echo form_close();?>
	</div>
</div>