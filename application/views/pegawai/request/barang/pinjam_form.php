<style type="text/css">
    .remove_field{
        border: solid 1px #000000;
        margin-top: 5px;
    }
</style>

<div style="margin:10px 0 0 0">
<?php $this->load->view('message/message');?>
</div>

<div class="row">
    <div style="margin-left:30px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
    <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
      <h4><i class="fa fa-arrow-circle-right"></i> Hii, I'm Is Your Help Deks ... </h4>
    
      Hallo, berikut merupakan konten dari proses peminjaman barang, silahkan lakukan peminjaman barang dengan melihat terlebih dahulu ketersediaan barannya dulu.  <br> 
      Salam & Terimakasih
    </div>
</div>

<div class="box box-primary" style="margin-top:15px">
    <div class="box-header with-border">
	    <h3 class="box-title"><?php echo $title;?></h3>
        <div class="box-tools pull-right">
	        <?php echo anchor(site_url('pegawai/barang/daftar/daftar-barang'), '<< Kembali', array('class'=>'tultip','title'=>'Kembali ke halaman sebelumnya'));?>
        </div>
        
    </div>
    <div class="box-body">
    <?php echo form_open($action, array('role'=>'form', 'id'=>'validForm'));?>


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
                $(wrapper).append('<div style="margin:0px 0px 0px 0px"><div class="row"><div class="col-lg-4 col-xs-8"><div class="form-group"><div class="input-group barang"><span class="input-group-addon"><i class="fa fa-th-large"></i></span><select id="kode_barang" required class="form-control" name="kode_barang[]"><option value="">--Pilih Barang--</option><?php foreach($barang as $row1):?><option value="<?php echo $row1->kode_barang;?>"><?php echo ucwords($row1->nama_barang);?></option><?php endforeach;?></select></div></div></div><div class="col-lg-2 col-xs-4"><div class="form-group"><div class="input-group"><span class="input-group-addon"><i class="fa fa-edit"></i></span><input type="number" class="form-control" name="jumlah[]" id="jumlah[]" required value="<?php echo $jumlah; ?>" placeholder="Qty"></div></div></div><a href="#" class="btn btn-danger btn-xs btn-flat remove_field"><i class="fa fa-trash-o"></i> Remove</a></div>'); //add input box
            }
        });
       /*
<input type="number" class="form-control" name="jumlah" id="jumlah" value="<?php echo $jumlah; ?>" placeholder="Jumlah" required data-bv-trigger="blur" data-bv-notempty-message="<i class='fa fa-times-circle'></i> harus diisi angka" />
       */
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    }); 

</script>


        <div class="row">
            <div class="col-lg-3 col-xs-6" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="date" class="form-control" name="tanggal_pinjam" 
                        id="tanggal_pinjam"
                        value="<?php echo set_value('tanggal_pinjam') ? set_value('tanggal_pinjam') : $tanggal_pinjam;?>"
                        placeholder="Tanggal Peminjaman" 
                        required data-bv-trigger="blur" 
                        data-bv-notempty-message="<i class='fa fa-times'></i> tanggal pinjam tidak boleh kosong">    
                    </div>
               </div>
            </div>
            <div class="col-lg-3 col-xs-6" style="margin:10px 0px 0px 0px">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="date" class="form-control" name="tanggal_kembali" 
                        id="tanggal_kembali"
                        value="<?php echo set_value('tanggal_kembali') ? set_value('tanggal_kembali') : $tanggal_kembali;?>"
                        placeholder="Tanggal Pengembalian" 
                        required data-bv-trigger="blur" 
                        data-bv-notempty-message="<i class='fa fa-times'></i> tanggal kembali tidak boleh kosong">    
                    </div>
               </div>
            </div>
        </div>
        
        <div class="input_fields_wrap">
            <div>
                <div class="row">
                    <div class="col-lg-4 col-xs-8" style="margin:10px 0px 0px 0px">
                        <div class="form-group">
                            <div class="input-group barang">
                                <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                <select id="kode_barang" class="form-control" name="kode_barang[]" required>
                                    <option value="">-- Pilih Barang --</option>
                                    <?php foreach($barang as $row):?>
                                    <option value="<?php echo $row->kode_barang;?>">
                                        <?php echo ucwords($row->nama_barang);?>        
                                    </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div style="margin:3px 0 0 0">
                                <span class="input-group-btn">
                                  <button class="btn btn-default btn-xs btn-flat add_field_button" type="button"><span class="text-info"><i class="fa fa-plus-square"></i> Barang</span></button>
                                </span>                         
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-xs-4" style="margin:10px 0px 0px 0px">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                <input type="number" class="form-control" name="jumlah[]" id="jumlah" 
                                    value="<?php echo $jumlah; ?>" 
                                    placeholder="Qty"
                                    required data-bv-trigger="blur" 
                                    data-bv-notempty-message="<i class='fa fa-times-circle'></i> harus diisi angka" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
                                              
        <input type="hidden" name="id_request" value="<?php echo $id_request; ?>" /> 
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button> 
        <a href="<?php echo site_url('pegawai/barang') ?>" class="btn btn-warning"><i class="fa fa-repeat"></i> Batal</a>
    <?php echo form_close();?>
	</div>
</div>
<!-- ./wrapper -->
<script src="<?php echo base_url().'assets/plugins/datepicker/bootstrap-datepicker.js';?>"></script>