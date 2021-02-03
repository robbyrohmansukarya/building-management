<div style="margin:10px 0 0 0">
<?php $this->load->view('message/message');?>
</div>

<div class="box box-primary" style="margin-top:15px">
    <div class="box-header with-border">
	    <h3 class="box-title">Input Komplain</h3>
        <div class="box-tools pull-right">
	        <?php echo anchor(site_url('admin/pegawai'), '<< Kembali', array('class'=>'text-warning tultip','title'=>'Kembali ke halaman sebelumnya'));?>
        </div>
    </div>
    <div class="box-body">
    <?php echo form_open_multipart($action, array('role'=>'form', 'id'=>'validForm'));?>
		<?php
            if($photo != ''){
         ?>
            <div class="row">
                <div class="form-group col-md-2 col-xs-12">
                    <img src="<?php echo base_url().'assets/dist/img/pegawai/'.$photo;?>" class="img-thumbnail img-responsive" alt="User Image" />
                </div>
            </div>
         <?php 
            }
        ?>
        <div class="form-group">
            <label for="exampleInputFile"><i class="fa fa-picture-o"></i> Foto Pegawai</label>
            <input type="file" id="exampleInputFile" name="photo">
        </div>

        <div class="row">
            <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                        <input type="text" class="form-control" name="nomor_induk" id="nomor_induk" placeholder="Nomor Induk  .." value="<?php echo $nomor_induk; ?>"
                         required data-bv-trigger="blur" data-bv-notempty-message="<i class='fa fa-times-circle'></i> nomor induk pegawai harus diisi" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama lengkap  .." value="<?php echo $nama_lengkap; ?>"
                         required data-bv-trigger="blur" data-bv-notempty-message="<i class='fa fa-times-circle'></i> nama pegawai harus diisi" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
                        <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="IP Komputer User .." value="<?php echo $nama_lengkap; ?>"
                         required data-bv-trigger="blur" data-bv-notempty-message="<i class='fa fa-times-circle'></i> IP harus diisi" />    
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-male"></i></span>
                        <select class="form-control" name="jk" required data-bv-trigger="blur" 
                        data-bv-notempty-message="<i class='fa fa-times-circle'></i> Silahkan pilih Jenis Kelamin">
	                        <option value="">-- Jenis Kelamin --</option>
	                        <option value="l">Laki - Laki</option>
	                        <option value="p">Perempuan</option>
                        </select>       
                    </div>
                </div>
            </div>
        </div>

              
        <div class="row">
            <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email ini digunakan sebagai username pegawai" value="<?php echo $email; ?>"
                            required data-bv-trigger="blur" 
                            data-bv-notempty-message="<i class='fa fa-times-circle'></i> email harus diisi " />
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Bagian/Cabang " value="<?php echo $alamat; ?>" />
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                        <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Nomor Ponsel" value="<?php echo $no_telp; ?>" />
                    </div>
                </div>
            </div>
        </div>
              
        
        <!-- <input type="hidden" name="idpengguna" value="<?php echo $idpengguna; ?>" />  -->
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button> 
        <a href="<?php echo site_url('admin/pegawai') ?>" class="btn btn-warning"><i class="fa fa-repeat"></i> Batal</a>
    <?php echo form_close();?>
	</div>
</div>