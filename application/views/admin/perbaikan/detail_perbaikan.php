<div class="row">
    <div style="margin-left:30px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
    <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
      <h4><i class="fa fa-arrow-circle-right"></i> Hii, I'm Is Your Help Desk ... </h4>
    
      Hallo Operator, Berikut merupakan konten untuk deteil permintan komplain dari user untuk di teruskan ke Solver tertentu sesuai dengan kerusakannya <br>
      Namun sebelumnya Anda harus melakukan eksekusi estimasi pekerjaan terlebih dahulu dan pilih tingkat Urgensi nya. Salam & Terimakasih
    </div>
</div>

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
	  <h3 class="box-title"><i class="fa fa-edit"></i> Detail Request Komplain</h3>
	</div>
	<div class="box-body">
        <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                <div class="pull-right">
                <?php
					echo anchor('admin/perbaikan', '<i class="ion ion-clipboard"></i> '.$title, array('class'=>'btn btn-flat btn-primary btn-xs tultip', 'title'=>'klik untuk melihat daftar request','data-toggle'=>'tooltip'));
				?>
                </div>
                <span class="bg-red"><?php echo $tgl_request;?></span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <!-- request pegawai -->
            <li>
                <i class="fa fa-envelope bg-blue"></i>
                <div class="timeline-item" style="margin-right:0px">
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo $jam_request;?></span>
                    <h3 class="timeline-header">
						<?php
						$qpegawai = $this->db->query("select * from pegawai where idpengguna='".$idpengguna."'");
						$cekPegawai = $qpegawai->num_rows();
						if($qpegawai->num_rows() > 0){
							$pegawai = $qpegawai->row();
							echo '<i class="fa fa-user"></i> '.ucwords($pegawai->nama_lengkap);
						}
						else{
							echo 'Pegawai Tidak Terdaftar';
						} 
                        
						?>                    
                    </h3>
                    <div class="timeline-body">
                        <?php
							$label='';$sts='';
							if($sts_eksekusi == 0){
								$label = 'label-warning';
								$sts = 'waiting list';
							}
							else if($sts_eksekusi == 1){
								$label = 'label-info';
								$sts = 'sedang ditangani';
							}
							else if($sts_eksekusi == 2){
								$label = 'label-success';
								$sts = 'selesai dikerjakan';
							}
							else if($sts_eksekusi == 3){
								$label = 'label-danger';
								$sts = 'Batal';
							}
							else{
								$label='';$sts='';
							}
                        	
						?>
                              <small class="label <?php echo $label?>">
                                  <i class="fa fa-arrow-circle-o-right"></i> <?php echo $sts;?>
                              </small>&nbsp;
                        <br />
                        <h4><strong><?php echo $request;?></strong></h4>
                        <?php echo $deskripsi_request;?>
                        <br /><br />
                        <?php 
                        if($kode_lokasi != ''){
                            $lokasi = $this->Lokasi_model->get_by_id($kode_lokasi);
                            echo ' Aplikasi: '. '<strong>'.ucfirst($lokasi->lokasi).'</strong>';
                        }else{
                            echo ' Aplikasi: -';
                        }
                        ?>      
                                       
                        <br />
                        <i class="fa fa-picture-o"></i> Gambar / Foto Lampiran :
                        <?php 
							echo ($photo == '' ? 'Tidak ada lampiran foto' : anchor('admin/perbaikan/photo/'.$id_request.'/detail-lampiran','Link Pic'));
						?>         
                   	</div><!--//timeline-body-->
                    
                    <div class="timeline-footer">
					<?php echo form_open($action, array('role'=>'form', 'id'=>'validForm'));?>
                        <div class="row">
                            <!-- Date range -->
                            <div class="form-group col-md-6 col-xs-12">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="estimasi" name="estimasi" placeholder="Estimasi Waktu Pengerjaan" 
                                    required data-bv-trigger="blur" data-bv-notempty-message="<i class='fa fa-times-circle'></i> Tentukan estimasi waktu pengerjaan" value="<?php echo $estimasi; ?>" />
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->                        
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-xs-12">
                                <select class="form-control" name="id_klasifikasi" required data-bv-trigger="blur" 
                                data-bv-notempty-message="<i class='fa fa-times-circle'></i> Tentukan tingkat urgensi request">
                                    <option value="">Tingkat Urgensi</option>
                                    <?php foreach($klasifikasis as $row_kls):?>
                                        <option value="<?php echo $row_kls->id_klasifikasi;?>"><?php echo ucwords($row_kls->klasifikasi);?> </option>
									<?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-xs-12">
                                <select class="form-control" name="ideksekutor" required data-bv-trigger="blur" 
                                data-bv-notempty-message="<i class='fa fa-times-circle'></i> Silahkan pilih eksekutor">
                                    <option value="">Pilih Solver</option>
                                    <?php
									foreach($eksekutors as $row_eksekutor):
									?>
                                        <option value="<?php echo $row_eksekutor->idpengguna;?>"><?php echo ucwords($row_eksekutor->unit);?> </option>
									<?php	
									endforeach;
									?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                              <input type="hidden" name="id_request" value="<?php echo $id_request; ?>" /> 
                              <button type="submit" name="forwad" class="btn btn-primary btn-flat">Forward <i class="fa fa-mail-forward"></i></button>
                            </div><!-- /.col -->
                        </div>
					<?php echo form_close();?>
                    </div><!---//end timeline-footer-->
                    
                </div><!---//timeline-item-->
            </li>
            <!-- END request -->
            <li>
                <i class="fa fa-clock-o bg-gray"></i>
            </li>
        </ul>
	</div>
</div>
