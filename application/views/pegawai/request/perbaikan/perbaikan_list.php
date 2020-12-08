<div style="margin:15px 0 0 0">
<?php $this->load->view('message/message');?>
</div>

<div class="row">
    <div style="margin-left:30px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
    <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
      <h4><i class="fa fa-arrow-circle-right"></i> Hii, I'm Is Your Help Desk ... </h4>
      Hallo, saat ini anda sedang melihat daftar perbaikan yang anda input 
      <br>klik detail pada aksi untuk melihat informasi selengkapnya. Salam dan Terimakasih 
    </div>
</div>

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
	  <h3 class="box-title"><i class="fa fa-th-list"></i> List Request Perbaikan</h3>
	  <div class="box-tools pull-right">              
		<?php echo anchor(site_url('pegawai/perbaikan/create'), '<i class="fa fa-plus-circle" aria-hidden="true"></i> Input Perbaikan', array('class'=>'btn btn-xs btn-info tultip','title'=>'Tambah data baru')); ?>	    
	  </div>
	</div>
	<div class="box-body table-responsive">
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="">
				<tr>
                    <th width="30">No</th>
                    <th width="100">Tanggal Request</th>
                    <th>Nama Perbaikan</th>
                    <th>Lokasi Perbaikan</th>
                    <th width="150">Status</th>
                    <th width="50">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
				$start = 0;
				foreach($perbaikan_data as $request)
				{
				?>
				<tr>
                    <td><?php echo ++$start ?></td>
                    <td>
						<?php 
							echo $request->tanggal_request;
						?>
                    </td>
                    <td><?php echo ucfirst($request->request);?></td>
                    <td>
                    	<?php 
                    		$lokasi = $this->Lokasi_model->get_by_id($request->kode_lokasi);
                    		echo ucfirst($lokasi->lokasi);
                    	?>    	
                    </td>
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
						echo anchor(site_url('pegawai/perbaikan/read/'.$request->id_request),'<i class="fa fa-search-plus text-info"></i>', array('class'=>'tultip','title'=>'lihat detail data')); 
						echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
						echo anchor(site_url('pegawai/perbaikan/update/'.$request->id_request),'<i class="fa fa-edit text-warning"></i>', array('class'=>'tultip','title'=>'edit data')); 
						echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
						echo anchor(site_url('pegawai/perbaikan/delete/'.$request->id_request),'<i class="fa fa-trash-o text-danger"></i>', array('class'=>'tultip','title'=>'hapus data','onclick'=>'javasciprt: return confirm(\'Data terkait request ini akan dihapus, Apakah anda yakin menghapus data ini ?\')')); 
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

