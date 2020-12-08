<div style="margin:10px 0 0 0">
<?php $this->load->view('message/message');?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    var max_fields      = 10; //maximum input boxes allowed
	    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
	    var add_button      = $(".add_field_button"); //Add button ID
	   	
		
	    var x = 1; //initlal text box count
	    $(add_button).click(function(e){ //on add input button click
	        e.preventDefault();
	        if(x < max_fields){ //max input box allowed
	            x++; //text box increment
	            $(wrapper).append('<div style="margin:0px 0px 0px 0px"><div class="row"><div class="col-lg-6 col-xs-12"><div class="form-group"><div class="input-group ruangan"><span class="input-group-addon"><i class="fa fa-home"></i></span><select id="kode_ruangan" class="form-control" name="kode_ruangan[]"><option value="">--Pilih Ruangan--</option><?php foreach($ruangan as $row1):?><option value="<?php echo $row1->kode_ruangan;?>"><?php echo $row1->nama_ruangan;?></option><?php endforeach;?></select></div><a href="#" class="btn btn-danger btn-xs btn-flat remove_field"><i class="fa fa-trash-o"></i> Remove</a></div></div></div></div>'); //add input box
	        }
	    });
	   
	    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
	        e.preventDefault(); $(this).parent('div').remove(); x--;
	    })
	});	

	/*
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
	*/
</script>
<div class="row">
    <div style="margin-left:30px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
    <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
      <h4><i class="fa fa-arrow-circle-right"></i> Hii, I'm Is Your Help Deks ... </h4>
      Hallo, Berikut merupakan konten dari proses booking ruangan, silahkan lakukan booking ruangan dengan menentukan waktunya terlebih dahulu. 
      <br>Salam dan Terimakasih 
    </div>
</div>

<div class="box box-primary" style="margin-top:15px">
    <div class="box-header with-border">
	    <h3 class="box-title"><?php echo $title;?></h3>
        <div class="box-tools pull-right">
	        <?php echo anchor(site_url('pegawai/ruangan'), '<< Kembali', array('class'=>'text-warning tultip','title'=>'Kembali ke halaman sebelumnya'));?>
        </div>
    </div>
    <div class="box-body">
    <?php echo form_open($action, array('role'=>'form', 'id'=>'validForm'));?>
        
        <div class="input_fields_wrap">
            <div>
                <div class="row">
                    <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                        <div class="form-group">
                            <div class="input-group ruangan">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                    <select id="kode_ruangan" class="form-control" name="kode_ruangan[]" required data-bv-trigger="blur" 
                                    data-bv-notempty-message="<i class='fa fa-times-circle'></i> Silahkan pilih ruangan">
                                        <option value="">-- Pilih Ruangan --</option>
                                        <?php foreach($ruangan as $row):?>
                                        <option value="<?php echo $row->kode_ruangan;?>"><?php echo ucwords($row->nama_ruangan);?></option>
                                        <?php endforeach;?>
                                    </select>
                            </div>
                            <div style="margin:3px 0 0 0">
                                <span class="input-group-btn">
                                  <button class="btn btn-success btn-xs btn-flat add_field_button" type="button"><i class="fa fa-plus-square"></i> Ruangan </button>
                                </span>                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-xs-6" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i> Mulai</span>
                        <input type="date" class="form-control" name="tanggal" 
                        id="tanggal"
                        value="<?php echo set_value('tanggal_kegiatan') ? set_value('tanggal_kegiatan') : $tanggal_kegiatan;?>"
                        placeholder="Tanggal Mulai" 
                        required data-bv-trigger="blur" 
                        data-bv-notempty-message="<i class='fa fa-times'></i> tanggal mulai tidak boleh kosong">    
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar-o"></i> Selesai</span>
                        <input type="date" class="form-control" name="tanggal_selesai" 
                        id="tanggal"
                        value="<?php echo set_value('tanggal_selesai') ? set_value('tanggal_selesai') : $tanggal_selesai;?>"
                        placeholder="Tanggal Selesai" 
                        required data-bv-trigger="blur" 
                        data-bv-notempty-message="<i class='fa fa-times'></i> tanggal selesai tidak boleh kosong">    
                    </div>
                </div>
            </div>
        </div>

 
        <div class="row">
            <div class="col-lg-3 col-xs-6 bootstrap-timepicker" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i> Mulai</span>
                        <input type="text" class="form-control mulai" name="jam_mulai" id="jam_mulai" placeholder="Jam Mulai" value="<?php echo $jam_mulai; ?>"
                         required data-bv-trigger="blur" data-bv-notempty-message="<i class='fa fa-times-circle'></i> isi jam mulai" />
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6 bootstrap-timepicker" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i> Selesai</span>
                        <input type="text" class="form-control selesai" name="jam_selesai" id="jam_selesai" placeholder="Jam Selesai" value="<?php echo $jam_selesai; ?>"
                         required data-bv-trigger="blur" data-bv-notempty-message="<i class='fa fa-times-circle'></i> isi jam selesai" />
                    </div>
                </div>
            </div>
        </div>
        
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