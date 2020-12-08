
<div class="box box-warning color-palette-box" style="margin-top:15px">
	<!-- Loading (remove the following to stop the loading)-->
	<div class="overlay">
	  <i class="fa fa-refresh fa-spin"></i>
	</div>
	<!-- end loading -->  
	<div class="box-header with-border">
	  <h3 class="box-title">Title</h3>
	  <div class="box-tools pull-right">              
		<?php echo anchor(site_url('pegawai/create'), '<i class="fa fa-plus-square" aria-hidden="true"></i>', array('class'=>'btn btn-sm btn-info tultip','title'=>'tambah data baru')); ?>
		<?php echo anchor(site_url('pegawai/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',  array('class'=>'btn btn-sm btn-success tultip','title'=>'export to excel')); ?>
		<?php echo anchor(site_url('pegawai/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i>',  array('class'=>'btn btn-sm btn-primary tultip','title'=>'export to word')); ?>
	    
	  </div>
	</div>
	<div class="box-body">
	 <div class="table-responsive">   
		<table class="table table-bordered table-striped" id="mytable">
			<thead class="bg-primary">
				<tr>
					<th width="50">No</th>
		    <th>Nama Lengkap</th>
		    <th>Alamat</th>
		    <th>No Telp</th>
		    <th>Photo</th>
		 <th width="50px">Action</th>
									</tr>
								</thead>
	    <tbody>
								<?php
								$start = 0;
								foreach ($pegawai_data as $pegawai)
								{
									?>
									<tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $pegawai->nama_lengkap ?></td>
		    <td><?php echo $pegawai->alamat ?></td>
		    <td><?php echo $pegawai->no_telp ?></td>
		    <td><?php echo $pegawai->photo ?></td>
		    <td style="text-align:center" width="120">
			<?php 
			echo anchor(site_url('pegawai/read/'.$pegawai->idpengguna),'<i class="fa fa-search-plus text-info"></i>', array('class'=>'tultip','title'=>'lihat detail data')); 
			 echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
			 echo anchor(site_url('pegawai/update/'.$pegawai->idpengguna),'<i class="fa fa-edit text-warning"></i>', array('class'=>'tultip','title'=>'edit data')); 
			 echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
			 echo anchor(site_url('pegawai/delete/'.$pegawai->idpengguna),'<i class="fa fa-trash-o text-danger"></i>', array('class'=>'tultip','title'=>'hapus data','onclick'=>'javasciprt: return confirm(\'Apakah anda yakin menghapus data ini ?\')')); 
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

