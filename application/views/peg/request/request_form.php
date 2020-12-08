<div style="margin:10px 0 0 0">
<?php $this->load->view('message/message');?>
</div>

<!-- quick email widget -->
<div class="box box-info" style="margin-top:15px">
    <div class="box-header">
        <i class="fa fa-edit"></i><h3 class="box-title">Quick Request</h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
        <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
        	<i class="fa fa-times"></i>
        </button>
        </div><!-- /. tools -->
    </div>
    <?php echo form_open($action, array('role'=>'form', 'id'=>'validForm'));?>
    <div class="box-body">
        <div class="form-group">
            <select class="form-control" name="id_kategori"  required data-bv-trigger="blur" 
            data-bv-notempty-message="<i class='fa fa-times-circle'></i> Silahkan pilih kategori request">
            <option value="">-- Pilih Kategori --</option>
            <?php
            foreach($kategori as $rowKategori):
                $selectedIdKategori = ($id_kategori == $rowKategori->id_kategori ? 'selected':' ');
            ?>
                <option value="<?php echo $rowKategori->id_kategori;?>" <?php echo $selectedIdKategori;?>>
                    <?php echo $rowKategori->kategori;?>
                </option>
            <?php		
                endforeach;
            ?>
            </select>       
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="request" id="request" placeholder="Request" value="<?php echo $request; ?>"
            required data-bv-trigger="blur" 
            data-bv-notempty-message="<i class='fa fa-times-circle'></i> field ini harus diisi" />
        </div>    
        <div class="form-group">
          <textarea class="form-control" placeholder="Deskripsi Request .." style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="deskripsi_request" required data-bv-trigger="blur" 
        data-bv-notempty-message="<i class='fa fa-times-circle'></i> silahkan isi pesan anda"><?php echo $deskripsi_request;?></textarea>

        </div>
        <div class="form-group">
            <label for="exampleInputFile"><i class="fa fa-picture-o"></i> Foto</label>
            <input type="file" id="exampleInputFile" name="lampiran">
        </div>

    </div>
    <div class="box-footer clearfix">
        <input type="hidden" name="id_request" value="<?php echo $id_request; ?>" /> 
        <button class="pull-right btn btn-default" type="submit">Send <i class="fa fa-arrow-circle-right"></i></button>
    </div>
	<?php echo form_close();?>
</div>
