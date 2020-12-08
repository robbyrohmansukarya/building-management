<div style="margin:10px 0 0 0">
<?php $this->load->view('message/message');?>
</div>

<div class="box box-primary" style="margin-top:15px">
    <div class="box-header with-border">
	    <h3 class="box-title"><?php echo $title;?></h3>
        <div class="box-tools pull-right">
	        <?php echo anchor(site_url('admin/admin'), '<< Kembali', array('class'=>'text-warning tultip','title'=>'Kembali ke halaman sebelumnya'));?>
        </div>
    </div>
    <div class="box-body">
    <?php echo form_open_multipart($action, array('role'=>'form', 'id'=>'validForm'));?>
		<?php
            if($photo != ''){
         ?>
            <div class="row">
                <div class="form-group col-md-2 col-xs-12">
                    <img src="<?php echo base_url().'assets/dist/img/admin/'.$photo;?>" class="img-thumbnail img-responsive" alt="User Image" />
                </div>
            </div>
         <?php 
            }
        ?>
        <div class="form-group">
            <label for="exampleInputFile"><i class="fa fa-picture-o"></i> Foto Admin</label>
            <input type="file" id="exampleInputFile" name="photo">
        </div>
                
        <div class="form-group">
            <label for="varchar">Nama Lengkap <?php echo form_error('nama_lengkap') ?></label>
            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama lengkap admin .." value="<?php echo $nama_lengkap; ?>"
             required data-bv-trigger="blur" data-bv-notempty-message="<i class='fa fa-times-circle'></i> nama admin harus diisi" />
        </div>
        <div class="form-group">
            <label for="varchar">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email ini digunakan sebagai username admin" value="<?php echo $email; ?>"
            required data-bv-trigger="blur" 
            data-bv-notempty-message="<i class='fa fa-times-circle'></i> email harus diisi " />
        </div>
        
        <div class="form-group">
            <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder=" " value="<?php echo $alamat; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">No Telp <?php echo form_error('no_telp') ?></label>
            <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder=" " value="<?php echo $no_telp; ?>" />
        </div>
        <input type="hidden" name="idpengguna" value="<?php echo $idpengguna; ?>" /> 
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button> 
        <a href="<?php echo site_url('admin/admin/create') ?>" class="btn btn-warning"><i class="fa fa-repeat"></i> Batal</a>
    
    <?php echo form_close();?>
    </div>
</div>