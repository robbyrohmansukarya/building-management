<div style="margin:10px 0 0 0">
<?php $this->load->view('message/message');?>
</div>

<div class="box box-primary" style="margin-top:15px">
    <div class="box-body">
	<?php
		$dtRuangan = $this->Ruangan_model->get_all();
	?>
        <div class="input_fields_wrap">
            <div>
                <div class="row">
                    <div class="col-lg-6 col-xs-12" style="margin:10px 0px 0px 0px">
                        <div class="form-group">
                            <div class="input-group ruangan">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                    <select id="kode_ruangan" class="form-control" name="kode_ruangan[]" required data-bv-trigger="blur" 
                                    data-bv-notempty-message="<i class='fa fa-times-circle'></i> Silahkan pilih tanggal kegiatan">
                                        <option value="">-- Pilih Ruangan --</option>
                                        <?php foreach($dtRuangan as $row):?>
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
	            $(wrapper).append('<div style="margin:0px 0px 10px 0px"><div class="row"><div class="col-lg-6 col-xs-12"><div><select id="kode_ruangan" class="form-control" name="kode_ruangan[]"><option>--Pilih Ruangan--</option><?php foreach($dtRuangan as $row1):?><option value="<?php echo $row1->kode_ruangan;?>"><?php echo $row1->nama_ruangan;?></option><?php endforeach;?></select><a href="#" class="btn btn-danger btn-xs btn-flat remove_field"><i class="fa fa-trash-o"></i> Remove</a></div></div></div></div>'); //add input box
	        }
	    });
	   
	    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
	        e.preventDefault(); $(this).parent('div').remove(); x--;
	    })
	});	
</script>


                                      
    <?php echo form_close();?>
	</div>
</div>
