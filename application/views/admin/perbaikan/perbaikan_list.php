<div class="row">
    <div style="margin-left:30px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
    <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
      <h4><i class="fa fa-arrow-circle-right"></i> Hii, I'm Is Your Help Desk ... </h4>
    
      Hallo Operator, Berikut saya tampilkan beberapa daftar permintaan Komplain yang mungkin belum Anda lihat , <br> 
      silahkan cek detail informasinya denngan mengklik nama atau aksi forward. Salam & Terimakasih
    </div>
</div>

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
	  <h3 class="box-title"><i class="fa fa-th-list"></i> List Request Komplain</h3>
	</div>
	<div class="box-body table-responsive">
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="">
				<tr>
                    <th width="30">No</th>
                    <th width="100">User Request</th>
                    <th>IP komputer</th>
                    <th width="100">Tanggal Request</th>
                    <th>Nama Komplain</th>
                    <th width="150">Status</th>
                    <th width="120">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
				$start = 0;
				foreach($perbaikan_data as $request)
				{
					if($request->sts_eksekusi==1){
						$sts = '<span class="label label-info">Sedang Ditangani</span>';
					}
					else if($request->sts_eksekusi==2){
						$sts = '<span class="label label-success">Selesai Ditangani</span>';
					}
					else{
						$sts = '<span class="label label-warning">Waiting List</span>';
					}
				?>
				<tr>
                    <td><?php echo ++$start ?></td>
                    <td>
					<?php
						$qpegawai = $this->db->query("select * from pegawai where idpengguna='".$request->idpengguna."'");
						$cekPegawai = $qpegawai->num_rows();
						if($qpegawai->num_rows() > 0){
							$pegawai = $qpegawai->row();
							$jabatan = $pegawai->jabatan;
							echo anchor('admin/perbaikan/detail/'.$request->id_request.'/detail-request', ucwords($pegawai->nama_lengkap), array('class'=>'small-box-footer tultip', 'title'=>'klik untuk melihat detail request','data-toggle'=>'tooltip'));
						}
						else{
							$jabatan = '';
							echo 'Pegawai Tidak Terdaftar';
						}
					?>
                    </td>
                    <td><?php echo ucfirst($jabatan);?></td>
                    <td>
						<?php 
							echo $request->tanggal_request;
						?>
                    </td>
                    <td><?php echo ucfirst($request->request);?></td>
                    <td>
					<?php
						$label='';$ico=''; 
						if($request->sts_eksekusi == 0){
							$label = 'label-warning';
							$ico = '<i class="fa fa-clock-o"></i>';
						}
						else if($request->sts_eksekusi == 1){
							$label = 'label-info';
							$ico = '<i class="fa fa-wrench"></i>';
						}
						else if($request->sts_eksekusi == 2){
							$label = 'label-success';
							$ico = '<i class="fa fa-check-square"></i>';
						}
						else if($request->sts_eksekusi == 3){
							$label = 'label-danger';
							$ico = '<i class="fa fa-times"></i>';
						}
						else{
							$label='';$ico='';
						}
						
						$qeksekusi = $this->db->query("select keterangan from sts_eksekusi where sts_eksekusi= '".$request->sts_eksekusi."'")->row();
					?>
                      <small class="label <?php echo $label?>"><?php echo $ico.' '.ucwords($qeksekusi->keterangan);?></small>
                    </td>
                    <td style="text-align:center" width="120">
					<?php 
						echo anchor('admin/perbaikan/detail/'.$request->id_request.'/detail-request', '<i class="fa fa-mail-forward"></i> Forward ', array('class'=>'small-box-footer tultip', 'title'=>'klik untuk meneruskan request','data-toggle'=>'tooltip'));
						echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
						echo anchor('admin/perbaikan/delete/'.$request->id_request.'/hapus-request','<i class="fa fa-trash-o text-danger"></i> <span class="text-danger">Delete</span>', array('class'=>'tultip','title'=>'hapus data','onclick'=>'javasciprt: return confirm(\'Apakah anda yakin menghapus data ini ?\')')); 
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