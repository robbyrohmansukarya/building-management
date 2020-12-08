<div style="margin:15px 0 0 0">
<?php $this->load->view('message/message');?>
</div>

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
	  <h3 class="box-title"><i class="fa fa-th-list"></i> Daftar Eksekutor</h3>
	  <div class="box-tools pull-right">              
		<?php echo anchor(site_url('admin/eksekutor/create'), '<i class="fa fa-plus-square" aria-hidden="true"></i> Add', array('class'=>'btn btn-xs btn-info tultip','title'=>'tambah data baru')); ?>
	  </div>
	</div>
    
	<div class="box-body">
	 <div class="">   
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="30">No</th>
                    <th width="100">ID Eksekutor</th>
                    <th>Nama Lengkap</th>
                    <th>Bidang Kerja</th>
                    <th>No Telp</th>
                    <th>Email</th>
                    <th width="50px">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
				$start = 0;
				foreach ($eksekutor_data as $eksekutor)
				{
			?>
				<tr>
                    <td><?php echo ++$start; ?></td>
                    <td><?php echo $eksekutor->idpengguna; ?></td>
                    <td><?php echo $eksekutor->nama_lengkap; ?></td>
                    <td><?php echo $eksekutor->unit; ?></td>
                    <td><?php echo $eksekutor->no_telp; ?></td>
                    <td>
                    <?php 
                        $query = $this->db->query("select username as email, password as pwd from login where idpengguna='".$eksekutor->idpengguna."'")->row();
                        echo $query->email; 
                    ?>
                    </td>
                    <td style="text-align:center" width="120">
                    <?php 
						echo anchor(site_url('admin/eksekutor/read/'.$eksekutor->idpengguna),'<i class="fa fa-search-plus text-info"></i>', array('class'=>'tultip','title'=>'lihat detail data')); 
						echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
						echo anchor(site_url('admin/eksekutor/update/'.$eksekutor->idpengguna),'<i class="fa fa-edit text-warning"></i>', array('class'=>'tultip','title'=>'edit data')); 
						echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
						echo anchor(site_url('admin/eksekutor/delete/'.$eksekutor->idpengguna),'<i class="fa fa-trash-o text-danger"></i>', array('class'=>'tultip','title'=>'hapus data','onclick'=>'javasciprt: return confirm(\'Request dan Progres yang berhubungan dengan data ini akan dihapus, Lanjutkan? \')')); 
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

