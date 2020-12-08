<div style="margin:15px 0 0 0">
<?php $this->load->view('message/message');?>
</div>

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<!-- Loading (remove the following to stop the loading)-->
	<div class="overlay">
	  <i class="fa fa-refresh fa-spin"></i>
	</div>
	<!-- end loading -->  
	<div class="box-header with-border">
	  <h3 class="box-title"><i class="fa fa-th-list"></i> Daftar Request</h3>
	  <div class="box-tools pull-right">              
		<?php echo anchor(site_url('pegawai/request/create'), '<i class="fa fa-plus-circle" aria-hidden="true"></i> Input Request', array('class'=>'btn btn-xs btn-info tultip','title'=>'Tambah data baru')); ?>	    
	  </div>
	</div>
	<div class="box-body table-responsive">
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="">
				<tr>
                    <th width="30">No</th>
                    <th width="100">Tanggal</th>
                    <th width="150">Kategori</th>
                    <th>Request</th>
                    <th width="150">Status</th>
                    <th width="50">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
				$start = 0;
				foreach($request_data as $request)
				{
				?>
				<tr>
                    <td><?php echo ++$start ?></td>
                    <td>
						<?php 
							echo $request->tanggal_request;
						?>
                    </td>
                    <td>
					<?php 
						$qkat = $this->db->query("select kategori from kategori_request where id_kategori='".$request->id_kategori."'")->row();
						echo ucwords($qkat->kategori);
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
						echo anchor(site_url('pegawai/request/read/'.$request->id_request),'<i class="fa fa-search-plus text-info"></i>', array('class'=>'tultip','title'=>'lihat detail data')); 
						echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
						echo anchor(site_url('pegawai/request/update/'.$request->id_request),'<i class="fa fa-edit text-warning"></i>', array('class'=>'tultip','title'=>'edit data')); 
						echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
						echo anchor(site_url('pegawai/request/delete/'.$request->id_request),'<i class="fa fa-trash-o text-danger"></i>', array('class'=>'tultip','title'=>'hapus data','onclick'=>'javasciprt: return confirm(\'Data terkait request ini akan dihapus, Apakah anda yakin menghapus data ini ?\')')); 
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

