<?php
    $sukses = $this->uri->segment(5);
    if(($sukses =='success')){
    ?>
        <div style="margin-top:15px;">
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-thumbs-up"></i> OK !</h4>
                Status booking ruangan berhasil diperbaharui
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
                                if($info->sts_eksekusi==1){
                                    $sts = '<span class="label label-info">Siap</span>';
                                }
                                else if($info->sts_eksekusi==2){
                                    $sts = '<span class="label label-danger">Ditolak</span>';
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
                    foreach ($pinjam_data as $row)
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
    	<h3 class="box-title"><i class="fa fa-mail-forward"></i> Teruskan Permintaan</h3>
    </div>
    <div class="box-body">
		<?php 
			echo form_open($action, array('role'=>'form', 'id'=>'validForm'));
			$flag_fwd = $info->flag_fwd;
			$sts_eksekusi = $info->sts_eksekusi;
			if($flag_fwd==1){
				$disabled = 'disabled';	
			?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check-square-o"></i>
                Permintaan ruangan telah diteruskan ke eksekutor, silahkan klik menu 
                <?php echo anchor('admin/ruangan/status_eksekutor', 'status eksekutor', array('class'=>'tultip', 'title'=>'klik untuk melihat status eksekutor'));?>
            </div>			
			<?php	
			}else{
				$disabled = '';				
			}
		?>
        <div class="form-group">
            <label>
              <input type="radio" name="flag_fwd" value="0" class="minimal" <?php echo $checked = ($flag_fwd ==0 ? 'checked':''); echo ' '.$disabled;?> />
              Belum diteruskan ke eksekutor &nbsp;&nbsp;
            </label>
            <label>
              <input type="radio" name="flag_fwd" value="1" class="minimal"<?php echo $checked = ($flag_fwd ==1 ? 'checked':'');?> />
              Teruskan ke eksekutor
            </label>
        </div>
        
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
										$selected_ditolak = '';
									}else if($sts_eksekusi ==2){
										$selected_siap = '';
										$selected_ditolak = 'selected';	
									}else{
										$selected_siap = '';
										$selected_ditolak = '';										
									}
								?>
                                <option value="1" <?php echo $selected_siap;?>>Siap</option>
                                <option value="2" <?php echo $selected_ditolak;?>>Ditolak</option>
                            </select>       
                        </div><!-- /input-group --> 
                    </div>
                </div>
            </div>              
            <button class="btn btn-info btn-flat" type="submit"><i class="fa fa-mail-reply-all"></i> Forward </button>
        <?php echo form_close();?>
    </div>
</div>