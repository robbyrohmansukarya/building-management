<div class="row">
    <div style="margin-left:30px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
    <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
      <h4><i class="fa fa-arrow-circle-right"></i> Hii, I'm Is Your Help Desk ... </h4>
    
      Hallo Operator, Berikut merupakan konten untuk melihat status progress Komplain yang dilakukan oleh Solver <br>
      Lihatlah pada sub-koten daftar progress untuk melakukan monitoring komplain yang dilakukan oleh solver, Anda juga bisa melihat foto kemajuan pengerjaannya. Salam & Terimakasih
    </div>
</div>

<div class="row" style="margin-top:15px;">
    <div class="col-md-12">    
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-edit"></i> Detail Request</h3>
                <div class="box-tools pull-right">
                    <?php echo anchor(site_url('admin/perbaikan/historifwd'), '<< Kembali', array('class'=>'tultip btn btn-info btn-xs','title'=>'Kembali ke halaman sebelumnya'));?>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered display responsive nowrap" id="" cellspacing="0" width="100%">
                    <tbody> 
                        <tr>
                            <td width="200">ID Request</td>
                            <td><?php echo $id_request;?></td>
                        </tr>
                        <tr>
                            <td width="250">User Request</td>
                            <td>
								<?php
                                $qpegawai = $this->db->query("select * from pegawai where idpengguna='".$idpengguna."'");
                                $cekPegawai = $qpegawai->num_rows();
                                if($qpegawai->num_rows() > 0){
                                    $pegawai = $qpegawai->row();
                                    echo ucwords($pegawai->nama_lengkap);
                                }
                                else{
                                    echo 'Pegawai Tidak Terdaftar';
                                } 
								?>                    
                            </td>
                        </tr>
                        <tr>
                            <td width="250">Tanggal Request</td>
                            <td><?php echo $tgl_request.' '. $jam_request;?></td>
                        </tr>
                        <tr>
                            <td>Klasifikasi</td>
                            <td>
							<?php 
								$klasifikasi = $this->Perbaikan_model->get_detail('klasifikasi_request', 'id_klasifikasi', $id_klasifikasi);
								echo $klasifikasi->klasifikasi;
							?>
                            </td>
                        </tr>
                        <tr>
                            <td>Request</td>
                            <td><?php echo $request;?></td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td><?php echo $deskripsi_request;?></td>
                        </tr>
                        <tr>
                            <td>Lampiran Gambar</td>
                            <td>
							<?php 
                                echo ($photo == '' ? 'Tidak ada lampiran foto' : anchor('admin/perbaikan/photo/'.$id_request.'/detail-lampiran','Link Pic'));
                                ?>         
                            </td>
                        </tr>
                        <tr>
                            <td>Aplikasi</td>
                            <td>
                            <?php 
                                if($kode_lokasi != ''){
                                    $lokasi = $this->Lokasi_model->get_by_id($kode_lokasi);
                                    echo 'Aplikasi: '. '<strong>'.ucfirst($lokasi->lokasi).'</strong>';
                                }else{
                                    echo 'Aplikasi: -';
                                }
                            ?>      
                            </td>
                        </tr>
                        <tr>
                            <td>Diteruskan Oleh</td>
                            <td>
							<?php 
								$dropby = $this->Perbaikan_model->get_detail('admin', 'idpengguna', $id_admin);					
								echo 'Admin - '.$dropby->nama_lengkap;
							?>
                            </td>
                        </tr>
                        <tr>
                            <td>Solver</td>
                            <td>
							<?php 
								$eksekutor = $this->Perbaikan_model->get_detail('eksekutor', 'idpengguna', $ideksekutor);					
								echo $eksekutor->unit;
							?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tenggang Waktu</td>
                            <td><?php echo $estimasi;?></td>
                        </tr>        
                    </tbody>
                </table>
            </div><!-- //box-body-->
        </div><!-- //box-->
    </div><!-- //md -->
</div><!-- //row -->

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
	  <h3 class="box-title"><i class="fa fa-th-list" ></i> Daftar Progress</h3>
        <div class="box-tools pull-right">
            <?php echo anchor(site_url('admin/perbaikan/historifwd'), '<< Kembali', array('class'=>'tultip btn btn-info btn-xs','title'=>'Kembali ke halaman sebelumnya'));?>
        </div>
	</div>
    
	<div class="box-body table-responsive">
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="20">No</th>
                    <th width="200"><i class="fa fa-wrench"></i> Status</th>
                    <th width="100"><i class="fa fa-calendar"></i> Eksekusi</th>
                    <th width=""><i class="fa fa-thumb-tack"></i> Progres</th>
                    <th width="100"><i class="fa fa-picture-o"></i> Pengerjaan</th>
                </tr>
            </thead>
            <tbody>
			<?php
				$start=0;
                foreach($histori_progres as $row):
            ?>
            	<tr>
                    <td><?php echo ++$start;?></td>
                    <td width="200">
                    <?php 
                        if($row->sts_eksekusi==1){
                            $sts = '<span class="label label-info">Sedang Ditangani</span>';
                        }
                        else if($row->sts_eksekusi==2){
                            $sts = '<span class="label label-success">Selesai Ditangani</span>';
                        }
                        else{
                            $sts = '<span class="label label-warning">Waiting List</span>';
                        }
                    echo $sts;
                    ?>
                    </td>
                    <td>
					<?php 
					//echo $row->waktu_eksekusi;
					$tglp			= $this->Perbaikan_model->tgl_progres($row->id);
					$jamp			= $this->Perbaikan_model->jam_progres($row->id);
					$tgl_p			= $this->tanggal->konversi($tglp['tgl_progres']);
					echo $tgl_p.' '. $jamp['jam_progres'];
					?>
                    </td>
                    <td><?php echo ucwords($row->progres);?></td>
                    <td>
					<?php 
						echo ($row->foto_lokasi == '' ? 'Tidak ada lampiran foto' : anchor('admin/perbaikan/photo_progres/lokasi/'.$row->id.'/'.$id_request.'/foto-lokasi','Link Pic'));
					?>
                    </td>
                    
                </tr>
			<?php    
                endforeach;
            ?>
            </tbody>
        </table>
	</div>
</div>
