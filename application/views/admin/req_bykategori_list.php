<?php
	$sukses = $this->uri->segment(6);
	if(($sukses =='delete')){
	?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-thumbs-up"></i> OK !</h4>
		1 Data berhasil dihapus
	</div>		
    <?php
	}
?>
<div class="box box-warning color-palette-box" style="margin-top:15px">
	<!-- Loading (remove the following to stop the loading)-->
	<div class="overlay">
	  <i class="fa fa-refresh fa-spin"></i>
	</div>
	<!-- end loading -->      
	<div class="box-header with-border">
	  <h3 class="box-title"><i class="ion ion-clipboard"></i> <?php echo $title_kategori;?></h3>
	  <div class="box-tools pull-right">
      	<small><i class="fa fa-circle text-warning"></i> Waiting</small>              
      	<small><i class="fa fa-circle text-info"></i> Sedang</small>              
      	<small><i class="fa fa-circle text-success"></i> Selesai</small>              
	  </div>
	</div>
	<div class="box-body">
	 <div class="">   
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="20">No</th>
                    <th width="200"><i class="fa fa-user"></i> Pegawai</th>
                    <th width="100"><i class="fa fa-calendar"></i> Tanggal Request</th>
                    <th><i class="fa fa-envelope-o"></i> Request</th>
                    <th width="100"><i class="fa fa-arrows-alt"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
				$start = 0;
				$sts = '';
				foreach ($reqKategori as $rowReqKategori)
				{
					if($rowReqKategori->sts_eksekusi==1){
						$sts = '<span class="label label-info">Sedang Ditangani</span>';
					}
					else if($rowReqKategori->sts_eksekusi==2){
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
						$qpegawai = $this->db->query("select * from pegawai where idpengguna='".$rowReqKategori->idpengguna."'");
						$cekPegawai = $qpegawai->num_rows();
						if($qpegawai->num_rows() > 0){
							$pegawai = $qpegawai->row();
							echo anchor('admin/request/detail/'.$kategori.'/'.$rowReqKategori->id_kategori.'/'.$rowReqKategori->id_request.'/detail-request', ucwords($pegawai->nama_lengkap), array('class'=>'small-box-footer tultip', 'title'=>'klik untuk melihat detail request','data-toggle'=>'tooltip'));
						}
						else{
							echo 'Pegawai Tidak Terdaftar';
						}
						echo '&nbsp; '.$sts; 
					?>
                    </td>
                    <td>
					<?php 
						$tglReq			= $this->Request_model->detail_tanggal($rowReqKategori->id_request);
						$jamReq			= $this->Request_model->detail_jam($rowReqKategori->id_request);
						$tgl_request	= $this->tanggal->konversi($tglReq['tgl']);
						echo $tgl_request.' <i class="fa fa-clock-o"></i> '.$jamReq['jam'];
					?>
                    </td>
                    <td><?php echo ucwords($rowReqKategori->request);?></td>
                    <td>
					<?php 
						echo anchor('admin/request/detail/'.$kategori.'/'.$rowReqKategori->id_kategori.'/'.$rowReqKategori->id_request.'/detail-request', '<i class="fa fa-mail-forward"></i> Forward ', array('class'=>'small-box-footer tultip', 'title'=>'klik untuk meneruskan request','data-toggle'=>'tooltip'));
						echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
						echo anchor('admin/request/delete/'.$kategori.'/'.$rowReqKategori->id_kategori.'/'.$rowReqKategori->id_request.'/hapus-request','<i class="fa fa-trash-o text-danger"></i> <span class="text-danger">Delete</span>', array('class'=>'tultip','title'=>'hapus data','onclick'=>'javasciprt: return confirm(\'Apakah anda yakin menghapus data ini ?\')')); 
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
</div>
