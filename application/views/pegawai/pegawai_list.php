<div style="margin:15px 0 0 0"><?php $this->load->view('message/message');?></div>

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-th-list"></i> Daftar Pegawai</h3>
        <div class="box-tools pull-right">              
			<?php echo anchor(site_url('admin/pegawai/create'), '<i class="fa fa-plus-square" aria-hidden="true"></i> Add', array('class'=>'btn btn-xs btn-info tultip','title'=>'tambah data baru')); ?>
        </div>
	</div>
    
	<div class="box-body">
	 <div class="">   
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="30">No</th>
                    <th width="50">IP Komputer</th>
                    <th>Nama Lengkap</th>
                    <th>No Telp</th>
                    <th>Email</th>
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
                    <td><?php echo ++$start;?></td>
                    <td><?php echo $pegawai->jabatan;?></td>
                    <td><?php echo ucwords($pegawai->nama_lengkap); ?></td>
                    <td><?php echo $pegawai->no_telp;?></td>
                    <td>
                    <?php 
                        $query = $this->db->query("select username as email from login where idpengguna='".$pegawai->idpengguna."'");
						if($query->num_rows() > 0){
                        	$emailPeg = $query->row();
							echo $emailPeg->email;
						}else{
							echo '<span class="text-danger">Tidak Ada Email</span>';
						}
                    ?>
                    </td>
                    <td style="text-align:center" width="120">
                    <?php 
                    echo anchor(site_url('admin/pegawai/read/'.$pegawai->idpengguna),'<i class="fa fa-search-plus text-info"></i>', array('class'=>'tultip','title'=>'lihat detail data')); 
                    echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
                    echo anchor(site_url('admin/pegawai/update/'.$pegawai->idpengguna),'<i class="fa fa-edit text-warning"></i>', array('class'=>'tultip','title'=>'edit data')); 
                    echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
                    echo anchor(site_url('admin/pegawai/delete/'.$pegawai->idpengguna),'<i class="fa fa-trash-o text-danger"></i>', array('class'=>'tultip','title'=>'hapus data','onclick'=>'javasciprt: return confirm(\'Request dan Progres yang berhubungan dengan data ini akan dihapus, Lanjutkan ?\')')); 
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

