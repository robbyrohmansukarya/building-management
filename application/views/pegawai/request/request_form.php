<div style="margin:10px 0 0 0">
<?php $this->load->view('message/message');?>
</div>

<!-- quick email widget -->
<div class="box box-info" style="margin-top:15px">
    <div class="box-header">
        <?php echo $title;?>
        <!-- tools box -->
        <div class="pull-right box-tools">
		<?php echo anchor(site_url('pegawai/request'), '<i class="fa fa-th-list" aria-hidden="true"></i> Daftar Request', array('class'=>'btn btn-xs btn-info tultip','title'=>'Histori Request')); ?>	    
        </div><!-- /. tools -->
    </div>
    <?php echo form_open_multipart($action, array('role'=>'form', 'id'=>'validForm'));?>
    <div class="box-body">
        <div class="form-group">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <select class="form-control" name="id_kategori" required data-bv-trigger="blur" 
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
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi request" value="<?php echo $lokasi; ?>"
                    required data-bv-trigger="blur" 
                    data-bv-notempty-message="<i class='fa fa-times-circle'></i> Lokasi request harus diisi" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="request" id="request" placeholder="Request" value="<?php echo $request; ?>"
            required data-bv-trigger="blur" 
            data-bv-notempty-message="<i class='fa fa-times-circle'></i> Silahkan isi deskripsi request" />
        </div>    
        <div class="form-group">
          <textarea class="form-control" placeholder="Deskripsi Request .." style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="deskripsi_request" required data-bv-trigger="blur" 
        data-bv-notempty-message="<i class='fa fa-times-circle'></i> silahkan isi pesan anda"><?php echo $deskripsi_request;?></textarea>

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
            <div class="btn btn-default btn-file">
              <i class="fa fa-paperclip"></i> Foto Lampiran
              <input type="file" name="photo" />
            </div>
            <p class="help-block">*Kosongkan jika tidak ada foto yang dapat dilampirkan</p>
        </div>
        
    </div>
    <div class="box-footer clearfix">
        <input type="hidden" name="id_request" value="<?php echo $id_request; ?>" /> 
        <button class="pull-right btn btn-primary" type="submit">Send <i class="fa fa-arrow-circle-right"></i></button>
    </div>
	<?php echo form_close();?>
</div>
    <script type="text/javascript">
      $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                  ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                  },
                  startDate: moment().subtract('days', 29),
                  endDate: moment()
                },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
