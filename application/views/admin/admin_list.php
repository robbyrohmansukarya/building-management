<div style="margin:15px 0 0 0">
<?php $this->load->view('message/message');?>
</div>

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
	  <h3 class="box-title"><i class="fa fa-th-list"></i> Daftar Admin</h3>
	  <div class="box-tools pull-right">              
		<?php echo anchor(site_url('admin/admin/create'), '<i class="fa fa-plus-square" aria-hidden="true"></i> Add', array('class'=>'btn btn-sm btn-info tultip','title'=>'Tambah data baru')); ?>	    
	  </div>
	</div>
	<div class="box-body">
        <div class="">   
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="30">No</th>
                    <th>ID Admin</th>
                    <th>Nama Lengkap</th>
                    <th>No Telp</th>
                    <th>Email</th>
                    <th width="50px">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $start = 0;
            foreach ($admin_data as $admin)
            {
            ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $admin->idpengguna; ?></td>
                <td><?php echo $admin->nama_lengkap; ?></td>
                <td><?php echo $admin->no_telp; ?></td>
                <td>
				<?php 
					$query = $this->db->query("select username as email, password as pwd from login where idpengguna='".$admin->idpengguna."'")->row();
					echo $query->email; 
				?>
                </td>
                <td style="text-align:center" width="120">
                <?php 
                echo anchor(site_url('admin/admin/read/'.$admin->idpengguna),'<i class="fa fa-search-plus text-info"></i>', array('class'=>'tultip','title'=>'lihat detail data')); 
                echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
                echo anchor(site_url('admin/admin/update/'.$admin->idpengguna),'<i class="fa fa-edit text-warning"></i>', array('class'=>'tultip','title'=>'edit data')); 
                echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
                echo anchor(site_url('admin/admin/delete/'.$admin->idpengguna),'<i class="fa fa-trash-o text-danger"></i>', array('class'=>'tultip','title'=>'hapus data','onclick'=>'javasciprt: return confirm(\'Apakah anda yakin menghapus data ini, Lanjutkan ?\')')); 
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

