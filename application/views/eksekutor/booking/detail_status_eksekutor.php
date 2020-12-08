<?php
    $sukses = $this->uri->segment(5);
    if(($sukses =='success')){
    ?>
        <div style="margin-top:15px;">
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-thumbs-up"></i> OK !</h4>
                Status kesiapan berhasil diperbaharui
            </div>
        </div>          
    <?php
    }else if(($sukses =='extension')){
    ?>
        <div style="margin-top:15px;">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-times-circle"></i> Error!</h4>
                Extensi file yang diterima hanya .jpg atau .png
            </div>
        </div>          

    <?php            
    }
    else{
    ?>
    <div style="margin-top:15px;">
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-warning"></i> <strong>Warning</strong>
            <ol>
                <li>Setiap Eksekutor Wajib Melakukan Update Status Kesiapan</li>
                <li>Baik Eksekutor Yang Terlibat Ataupun Tidak Diharuskan Melakukan Update <br /> Bagi yang terlibat Pilih status "Siap", Bagi yang tidak terlibat pilih status "Tidak Terlibat"</li>
                <li>Setiap Eksekutor Wajib Melakukan Update Status Kesiapan</li>
            </ol> 
        </div>      
    </div>    
    <?php    
    }
?>
<div class="row" style="margin-top:15px;">
    <div class="col-md-6 col-xs-12">    
        <div class="box box-info color-palette-box">
                <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-info-circle"></i> Info Booking</h3>
            </div>
            <div class="box-body">
                <table class="table" id="" cellspacing="0" width="100%">
                    <tbody>
                        <tr>
                            <td width="200"><i class="fa fa-user"></i> User Request</td>
                            <td width="2">:</td>
                            <td>
                            <?php
                                echo ucwords($info->nama_lengkap).' / '.ucwords($info->jabatan);
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200"><i class="fa fa-edit"></i> Nama Kegiatan</td>
                            <td width="2">:</td>
                            <td>
                            <?php
                                echo ucwords($info->nama_kegiatan);
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200"><i class="fa fa-bookmark-o"></i> Deskripsi Kegiatan</td>
                            <td width="2">:</td>
                            <td>
                            <?php
                                echo ucwords($info->deskripsi_kegiatan);
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200"><i class="fa fa-calendar-o"></i> Jadwal Kegiatan</td>
                            <td width="2">:</td>
                            <td>
                            <?php 
                                $tanggal_kegiatan    = $this->tanggal->konversi($info->tanggal_kegiatan);
                                echo '<i class="fa fa-calendar"></i> '.$tanggal_kegiatan;
                                echo ' <i class="fa fa-clock-o"></i> '.$info->jam_mulai;
                                echo ' - '.$info->jam_selesai;
                            ?>                
                            </td>
                        </tr>
                        <tr>
                            <td width="200"><i class="fa fa-exclamation-circle"></i> Status</td>
                            <td width="2">:</td>
                            <td>
                            <?php 
								$q = $this->db->query("select * from request_ruangan_forward where id_request='".$id_request."' and ideksekutor='".$ideksekutor."'")->row();
								$sts_eksekusi = $q->sts_eksekusi;
							
                                if($sts_eksekusi==1){
                                    $sts = '<span class="label label-info">Siap</span>';
                                }
                                else if($sts_eksekusi==2){
                                    $sts = '<span class="label label-danger">Tidak Terlibat</span>';
                                }
                                else{
                                    $sts = '<span class="label label-warning">Menunggu</span>';
                                }
                                echo $sts;                
                            ?>                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--// col-6 -->
    <div class="col-md-6 col-xs-12">    
        <div class="box box-info color-palette-box" style="min-height:270px;">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-th-list"></i> Ruang Rapat</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped display responsive nowrap" id="" cellspacing="0" width="100%">
                    <thead class="bg-default">
                        <tr>
                            <th width="30">No</th>
                            <th>Ruangan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $start = 0;
                    foreach ($ruangan_data as $row)
                    {
                    ?>
                        <tr>
                            <td><?php echo ++$start;?></td>
                            <td><?php echo ucwords($row->nama_ruangan);?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--// col-6 -->
</div><!--// row -->

<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
    	<h3 class="box-title"><i class="fa fa-refresh"></i> Status Kesiapan</h3>
    </div>
    <div class="box-body">
	<?php 
	   if($q->foto !=""){
    ?>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <img src="<?php echo base_url().'assets/dist/img/kesiapan_eksekutor/'.($q->foto =='' ? 'no.jpg':$q->foto);?>" class="img-thumbnail span1 img-responsive" alt="User Image" />
        </div>
    <?php
       }
    	echo form_open_multipart($action, array('role'=>'form', 'id'=>'validForm'));
	?>

            <div class="form-group">
                <p style="margin-bottom:0px; "><label>Posting Foto </label></p>
                <div class="btn btn-default btn-file">
                  <i class="fa fa-picture-o"></i> Upload Foto
                  <input type="file" name="photo" />
                </div>  
                <p class="help-block"><code>*Kosongkan jika tidak ada gambar yang dapat dilampirkan</code></p>
            </div><!-- /.form group -->


            <div class="form-group">
                <div class="row">
                    <div class="col-xs-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>                
                            <select class="form-control" name="sts_eksekusi" required data-bv-trigger="blur" 
                            data-bv-notempty-message="<i class='fa fa-times-circle'></i> pilih status permintaan">
                                <option value="">--Update Status--</option>
                                <?php
                                	if($sts_eksekusi ==1){
										$selected_siap = 'selected';
										$selected_tidkterlibat = '';
									}else if($sts_eksekusi ==2){
										$selected_siap = '';
										$selected_tidkterlibat = 'selected';	
									}else{
										$selected_siap = '';
										$selected_tidkterlibat = '';										
									}
								?>
                                <option value="1" <?php echo $selected_siap;?>>Siap</option>
                                <option value="2" <?php echo $selected_tidkterlibat;?>>Tidak Terlibat</option>
                            </select>       
                        </div><!-- /input-group --> 
                    </div>
                </div>
            </div>              
            <button class="btn btn-info btn-flat" type="submit"><i class="fa fa-refresh"></i> Update Status </button>
        <?php echo form_close();?>
    </div>
</div>
