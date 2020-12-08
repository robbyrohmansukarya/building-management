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
<div class="row">
    <div style="margin-left:30px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
    <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
      <h4><i class="fa fa-arrow-circle-right"></i> Hii, Perkenalkan Saya Mr.BI ... </h4>
    
      Hallo Operator, Saat ini anda sedang melihat tabel status eksekusi dari eksekutor untuk permintaan peminjaman ruangan , <br> 
      silahkan cek pada tabel statusnya apakah menunggu atau sudah di verifikasi. Salam & Terimakasih
    </div>
</div>

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
            	<h3 class="box-title"><i class="fa fa-info-circle"></i> Status Ruangan</h3>
                <div class="box-tools pull-right">              
                    <?php 
					echo form_open($action, array('role'=>'form', 'id'=>'validForm'));
					$sts_eksekusi = $info->sts_eksekusi;
					?>
                        <div class="form-group pull-right" style="width: 60%">
                            <div class="input-group input-group-sm">
                                <select class="form-control" name="sts_eksekusi" required data-bv-trigger="blur" 
                                data-bv-notempty-message="<i class='fa fa-times-circle'></i> pilih status permintaan">
                                    <option value="">--Update Status Ruangan--</option>
                                    <?php
                                        if($sts_eksekusi ==1){
                                            $selected_siap = 'selected';
                                            $selected_ditolak = '';
											$selected_menunggu = '';
                                        }else if($sts_eksekusi ==2){
                                            $selected_siap = '';
                                            $selected_ditolak = 'selected';
											$selected_menunggu = '';	
                                        }else{
                                            $selected_siap = '';
                                            $selected_ditolak = '';
											$selected_menunggu = 'selected';										
                                        }
                                    ?>
                                	<option value="0" <?php echo $selected_menunggu;?>>Menunggu</option>
                                    <option value="1" <?php echo $selected_siap;?>>Siap</option>
                                    <option value="2" <?php echo $selected_ditolak;?>>Ditolak</option>
                                </select>       
                                <span class="input-group-btn">
                                  <button class="btn btn-info btn-flat tultip" type="submit" title="klik untuk update status">&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;&nbsp;</button>
                                </span>
                            </div><!-- /input-group --> 
                        </div>              
                    <?php echo form_close();?>
                </div>
              
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped display responsive nowrap" id="" cellspacing="0" width="100%">
                    <thead class="bg-default">
                        <tr>
                            <th width="30">No</th>
                            <th><i class="fa fa-user"></i> Eksekutor</th>
                            <th> <i class="fa fa-info-circle"></i> Status</th>
                            <th> <i class="fa fa-picture-o"></i> Link Pic</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $start = 0;
                    foreach ($qforward as $row)
                    {
                    ?>
                        <tr>
                            <td><?php echo ++$start;?></td>
                            <td><?php echo ucwords($row->unit);?></td>
                            <td>
							<?php 
                                if($row->sts_eksekusi==1){
                                    $sts = '<span class="label label-info">Siap</span>';
                                }
                                else if($row->sts_eksekusi==2){
                                    $sts = '<span class="label label-danger">Tidak Terlibat</span>';
                                }
                                else{
                                    $sts = '<span class="label label-warning">Menunggu</span>';
                                }
                                echo $sts;                
							?>
                            </td>
                            <td style="text-align: center;">
                            <?php 
                                echo ($row->foto == '' ? '' : anchor('admin/ruangan/photo/'.$id_request.'/'.$row->id.'/detail-foto','Link Pic', array('class'=>'tultip', 'title'=>'klik untuk melihat foto')));
                            ?>    
                            </td>                            
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
