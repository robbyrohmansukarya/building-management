<div style="margin:10px 0 0 0">
<?php $this->load->view('message/message');?>
</div>
<script type="text/javascript">
	$(document).ready(function()
	{		
	
		//data tanggal untuk pilih ruangan
		$("#tanggal").change(function()
		{
			var tgl=$(this).val();
			$.ajax(
			{
				url:"<?php echo base_url(); ?>pegawai/ruangan/tersedia",
				type:"POST",
				data:"tgl="+tgl,

				success:function(ruangan)
				{
					$(".ruangan").html(ruangan).show();	
				}	
			});
		});
				
	});

</script>

<div class="box box-primary" style="margin-top:15px">
    <div class="box-header with-border">
	    <h3 class="box-title"><?php echo $title;?></h3>
        <div class="box-tools pull-right">
	        <?php echo anchor(site_url('pegawai/ruangan'), '<< Kembali', array('class'=>'text-warning tultip','title'=>'Kembali ke halaman sebelumnya'));?>
        </div>
    </div>
    <div class="box-body">
    <?php echo form_open($action, array('role'=>'form', 'id'=>'validForm'));?>

        <div class="row">
            <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control dpTxt" name="tanggal" 
                        id="tanggal"
                        value="<?php echo set_value('tanggal_kegiatan') ? set_value('tanggal_kegiatan') : $tanggal_kegiatan;?>"
                        placeholder="Tanggal Kegiatan" 
                        required data-bv-trigger="blur" 
                        data-bv-notempty-message="<i class='fa fa-times'></i> tanggal tidak boleh kosong">    
                    </div>
                </div>
            </div>
        </div>
        
        <div class="ruangan"></div>
        
        <div class="row">
            <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                        <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" placeholder="Nama Kegiatan" value="<?php echo $nama_kegiatan; ?>"
                         required data-bv-trigger="blur" data-bv-notempty-message="<i class='fa fa-times-circle'></i> nama kegiatan harus diisi" />
                    </div>
                </div>
            </div>
        </div>
 
        <div class="row">
            <div class="col-lg-3 col-xs-6 bootstrap-timepicker" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i> Mulai</span>
                        <input type="text" class="form-control mulai" name="Jam Mulai" id="jam_mulai" placeholder="Jam Mulai" value="<?php echo $jam_mulai; ?>"
                         required data-bv-trigger="blur" data-bv-notempty-message="<i class='fa fa-times-circle'></i> isi jam mulai" />
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6 bootstrap-timepicker" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i> Selesai</span>
                        <input type="text" class="form-control selesai" name="Jam Selesai" id="jam_selesai" placeholder="Jam Selesai" value="<?php echo $jam_selesai; ?>"
                         required data-bv-trigger="blur" data-bv-notempty-message="<i class='fa fa-times-circle'></i> isi jam selesai" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                
                  <textarea class="form-control" placeholder="Tulis deskripsi anda disini .." style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="deskripsi_kegiatan" required data-bv-trigger="blur" 
                data-bv-notempty-message="<i class='fa fa-times-circle'></i> silahkan isi deskripsi "><?php echo $deskripsi_kegiatan;?></textarea>

                </div>
            </div>
        </div>

                                      
        <input type="hidden" name="id_request" value="<?php echo $id_request; ?>" /> 
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button> 
        <a href="<?php echo site_url('pegawai/ruangan') ?>" class="btn btn-warning"><i class="fa fa-repeat"></i> Batal</a>
    <?php echo form_close();?>
	</div>
</div>
<!-- ./wrapper -->
<script src="<?php echo base_url().'assets/plugins/datepicker/bootstrap-datepicker.js';?>"></script>