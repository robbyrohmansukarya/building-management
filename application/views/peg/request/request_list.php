
<div class="box box-warning color-palette-box" style="margin-top:15px">
	<!-- Loading (remove the following to stop the loading)-->
	<div class="overlay">
	  <i class="fa fa-refresh fa-spin"></i>
	</div>
	<!-- end loading -->  
	<div class="box-header with-border">
	  <h3 class="box-title">Title</h3>
	  <div class="box-tools pull-right">              
		<?php echo anchor(site_url('request/create'), '<i class="fa fa-plus-square" aria-hidden="true"></i>', array('class'=>'btn btn-sm btn-info tultip','title'=>'tambah data baru')); ?>
		<?php echo anchor(site_url('request/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',  array('class'=>'btn btn-sm btn-success tultip','title'=>'export to excel')); ?>
		<?php echo anchor(site_url('request/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i>',  array('class'=>'btn btn-sm btn-primary tultip','title'=>'export to word')); ?>
	    
	  </div>
	</div>
	<div class="box-body">
	 <div class="table-responsive">   
		<table class="table table-bordered table-striped" id="mytable">
			<thead class="bg-primary">
				<tr>
					<th width="50">No</th>
		    <th>Id Kategori</th>
		    <th>Id Klasifikasi</th>
		    <th>Idpengguna</th>
		    <th>Request</th>
		    <th>Deskripsi Request</th>
		    <th>Baca Admin</th>
		    <th>Baca Eksekutor</th>
		    <th>Sts Baca Admin</th>
		    <th>Sts Baca Eksekutor</th>
		    <th>Sts Eksekusi</th>
		 <th width="50px">Action</th>
									</tr>
								</thead>
	    <tbody>
								<?php
								$start = 0;
								foreach ($request_data as $request)
								{
									?>
									<tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $request->id_kategori ?></td>
		    <td><?php echo $request->id_klasifikasi ?></td>
		    <td><?php echo $request->idpengguna ?></td>
		    <td><?php echo $request->request ?></td>
		    <td><?php echo $request->deskripsi_request ?></td>
		    <td><?php echo $request->baca_admin ?></td>
		    <td><?php echo $request->baca_eksekutor ?></td>
		    <td><?php echo $request->sts_baca_admin ?></td>
		    <td><?php echo $request->sts_baca_eksekutor ?></td>
		    <td><?php echo $request->sts_eksekusi ?></td>
		    <td style="text-align:center" width="120">
			<?php 
			echo anchor(site_url('request/read/'.$request->id_request),'<i class="fa fa-search-plus text-info"></i>', array('class'=>'tultip','title'=>'lihat detail data')); 
			 echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
			 echo anchor(site_url('request/update/'.$request->id_request),'<i class="fa fa-edit text-warning"></i>', array('class'=>'tultip','title'=>'edit data')); 
			 echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
			 echo anchor(site_url('request/delete/'.$request->id_request),'<i class="fa fa-trash-o text-danger"></i>', array('class'=>'tultip','title'=>'hapus data','onclick'=>'javasciprt: return confirm(\'Apakah anda yakin menghapus data ini ?\')')); 
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

