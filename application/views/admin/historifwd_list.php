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
	  <h3 class="box-title"><i class="fa fa-th-list"></i> <?php echo $title;?></h3>
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
                    <th width="100"><i class="fa fa-bookmark"></i> ID Request</th>
                    <th width="100"><i class="fa fa-calendar"></i> Tanggal</th>
                    <th width="200"><i class="fa fa-user"></i> Pegawai</th>
                    <th width="100"><i class="fa fa-tags"></i> Klasifikasi</th>
                    <th><i class="fa fa-exclamation-circle"></i> Status </th>
                    <th><i class="fa fa-gears"></i> Eksekutor</th>
                    <th><i class="fa fa-envelope-o"></i> Request</th>
                    <th width="100"><i class="fa fa-arrows-alt"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
				$start = 0;
				$sts = '';
				foreach ($historifwd as $row)
				{
					if($row->sts_eksekusi==1){
						$sts = '<span class="label label-info">Sedang Ditangani</span>';
					}
					else if($row->sts_eksekusi==2){
						$sts = '<span class="label label-success">Selesai Ditangani</span>';
					}
					else{
						$sts = '<span class="label label-warning">Waiting List</span>';
					}
				?>
				<tr>
                    <td><?php echo ++$start ?></td>
                    <td><?php echo $row->id_request;?></td>
                    <td>
					<?php 
						$tglReq			= $this->Request_model->detail_tanggal($row->id_request);
						$jamReq			= $this->Request_model->detail_jam($row->id_request);
						$tgl_request	= $this->tanggal->konversi($tglReq['tgl']);
						echo $tgl_request;//.' <i class="fa fa-clock-o"></i> '.$jamReq['jam'];
					?>
                    </td>
                    <td>
					<?php
						$qpegawai = $this->db->query("select * from pegawai where idpengguna='".$row->idpengguna."'");
						$cekPegawai = $qpegawai->num_rows();
						if($qpegawai->num_rows() > 0){
							$pegawai = $qpegawai->row();
							echo anchor('admin/request/progres'.'/'.$row->id_request.'/progres-request', ucwords($pegawai->nama_lengkap), array('class'=>'small-box-footer tultip', 'title'=>'klik untuk melihat progres request','data-toggle'=>'tooltip'));
						}
						else{
							echo 'Pegawai Tidak Terdaftar';
						}
					?>
                    </td>
                    <td>
					<?php 
						$klasifikasi = $this->Request_model->get_detail('klasifikasi_request', 'id_klasifikasi', $row->id_klasifikasi);
						echo $klasifikasi->klasifikasi;
					?>
                    </td>
                    <td><?php echo $sts;?></td>
                    <td>
					<?php 
						$eksekutor = $this->Request_model->get_detail('eksekutor', 'idpengguna', $row->ideksekutor);					
						echo $eksekutor->unit;
					?>
                    </td>
                    <td><?php echo ucwords($row->request);?></td>
                    <td>
					<?php 
						echo anchor('admin/request/progres'.'/'.$row->id_request.'/progres-request', '<i class="fa fa-wrench"></i> Progres ', array('class'=>'small-box-footer tultip', 'title'=>'klik untuk melihat progres request','data-toggle'=>'tooltip'));
						//echo anchor('admin/request/detail/'.$row->id_kategori.'/'.$row->id_request.'/detail-request', '<i class="fa fa-search-plus"></i> Detail ', array('class'=>'small-box-footer tultip', 'title'=>'klik untuk melihat detail request','data-toggle'=>'tooltip'));
						//echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
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
