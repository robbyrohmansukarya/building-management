<?php
$sukses = $this->uri->segment(5);
if($sukses =='success'){
?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-thumbs-up"></i> OK !</h4>
		Status pengerjaan berhasil ditambahkan
	</div>		
<?php
}
if($sukses =='delete'){
?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-thumbs-up"></i> OK !</h4>
		Data progres berhasil dihapus
	</div>		
<?php
}
?>
<div>
    <div style="margin-left:20px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
  <div class="callout callout-warning" style="margin:15px 0px 15px 100px;">											
      <h4><i class="fa fa-arrow-circle-right"></i> Tentang Aplikasi</h4>
Hallo Solver , Saat ini anda sedang melihat detail permintaan komplain. 
  Silahkan lakukan input progress pekerjaan pada form aksi dan lihat hasil input progress pekerjaan anda di daftar progress
  </div>
</div>

<div class="row" style="margin-top:15px;">
    <div class="col-md-6">    
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-edit"></i> Request</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered display responsive nowrap" id="" cellspacing="0" width="100%">
                    <tbody>    
                        <tr>
                            <td width="200">ID Request</td>
                            <td><?php echo $id_request;?></td>
                        </tr>
                        <tr>
                            <td width="200">User Request</td>
                            <td>
								<?php
                                $qpegawai = $this->db->query("select * from pegawai where idpengguna='".$idpengguna."'");
                                $cekPegawai = $qpegawai->num_rows();
                                if($qpegawai->num_rows() > 0){
                                    $pegawai = $qpegawai->row();
                                    $jabatan = $pegawai->jabatan;
                                    $no_tlp  = $pegawai->no_telp;
                                    echo ucwords($pegawai->nama_lengkap);
                                    echo ($jabatan !='' ?' / '.ucwords($jabatan):''); 
                                }
                                else{
                                    $jabatan = '';
                                    $no_tlp = '';
                                    echo 'Pegawai Tidak Terdaftar';
                                } 
								?>                    
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Nomor Telp / HP</td>
                            <td><?php echo $no_tlp;?></td>
                        </tr>
                        <tr>
                            <td width="200">Tanggal Request</td>
                            <td><?php echo $tgl_request.' '. $jam_request;?></td>
                        </tr>
                        <tr>
                            <td width="200">Status Eksekusi</td>
                            <td> 
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
                            </td>
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
                                echo ($photo == '' ? 'Tidak ada lampiran foto' : anchor('eksekutor/perbaikan/photo/'.$id_request.'/detail-lampiran','Link Pic'));
                            ?>         
                            </td>
                        </tr>
                        <tr>
                            <td>Aplikasi</td>
                            <td>
                            <?php 
                                if($kode_lokasi != ''){
                                    $lokasi = $this->Lokasi_model->get_by_id($kode_lokasi);
                                    echo ' Aplikasi: '. '<strong>'.ucfirst($lokasi->lokasi).'</strong>';
                                }else{
                                    echo ' Aplikasi: -';
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
                            <td>Tenggang Waktu</td>
                            <td><?php echo $estimasi;?></td>
                        </tr>        
                    </tbody>
                </table>
            </div><!-- //box-body-->
        </div><!-- //box-->
    </div><!-- //md -->
    
    <div class="col-md-6">    
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-rocket"></i> Aksi</h3>
            </div>
			<?php echo form_open_multipart($action, array('role'=>'form', 'id'=>'validForm'));?>
            <div class="box-body">
                <div class="form-group">
                    <label>Update Status:</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-wrench"></i>
                    </div>
                    <select class="form-control" name="sts_eksekusi" required data-bv-trigger="blur" 
                    data-bv-notempty-message="<i class='fa fa-times-circle'></i> Silahkan pilih status">
                        <option value="" selected>Pilih Status </option>
                        <option value="1">Sedang Ditangani </option>
                        <option value="2">Selesai Dikerjakan </option>
                    </select>
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                    <p style="margin-bottom:0px; "><label>Posting pengerjaan</label></p>
                    <div class="btn btn-default btn-file">
                      <i class="fa fa-picture-o"></i> Upload Foto
                      <input type="file" name="photo_lokasi" />
                    </div>  
                    <p class="help-block"><code>*Kosongkan jika tidak ada foto yang dapat dilampirkan</code></p>
                </div><!-- /.form group -->
                <div class="form-group">
                    <label>Spek Teknis:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-thumb-tack"></i>
                      </div>
                      <input type="text" name="progres" class="form-control pull-right" id="progres" required data-bv-trigger="blur" 
                    data-bv-notempty-message="<i class='fa fa-times-circle'></i> progres harus diisi"/>
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                    
                    
                </div><!-- /.form group -->
                
            </div><!-- //col-box-body-->
            <div class="box-footer clearfix">
                <input type="hidden" name="id_request" value="<?php echo $id_request; ?>" /> 
                <input type="hidden" name="ideksekutor" value="<?php echo $ideksekutor; ?>" /> 
                <input type="hidden" name="id_admin" value="<?php echo $id_admin; ?>" /> 
                <input type="hidden" name="id_pegawai" value="<?php echo $idpengguna; ?>" /> 
                <button class="pull-right btn btn-primary" type="submit"><i class="fa fa-refresh"></i> Update</button>
            </div>
			<?php echo form_close();?>
        </div><!-- //box-->
    </div><!-- //col-md-->
</div><!-- //row -->

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
	  <h3 class="box-title"><i class="fa fa-th-list" ></i> Daftar Progres</h3>
	</div>
    
	<div class="box-body table-responsive">
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="20">No</th>
                    <th width="200"><i class="fa fa-wrench"></i> Status</th>
                    <th width=""><i class="fa fa-thumb-tack"></i> Spek Teknis</th>
                    <th width="100"><i class="fa fa-arrows-alt"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
			<?php
				$start=0;
                foreach($progress as $row):
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
                    <td><?php echo ucwords($row->progres);?></td>
                    <td>
                    <?php
						echo anchor(site_url('eksekutor/perbaikan/delete_progres/'.$row->id.'/'.$id_request.'/delete-progres'),'<i class="fa fa-trash-o text-danger"></i> Delete', array('class'=>'tultip text-danger','title'=>'hapus data','onclick'=>'javasciprt: return confirm(\'Apakah anda yakin menghapus data ini ?\')')); 
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
