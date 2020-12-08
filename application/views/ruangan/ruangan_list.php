<div style="margin:15px 0 0 0"><?php $this->load->view('message/message');?></div>
<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-th-list"></i> Daftar Ruangan</h3>
        <div class="box-tools pull-right">              
			<?php echo anchor(site_url('admin/ruangan/create'), '<i class="fa fa-plus-square" aria-hidden="true"></i> Add', array('class'=>'btn btn-xs btn-info tultip','title'=>'tambah data baru')); ?>
        </div>
	</div>
    
	<div class="box-body">
	 <div class="">   
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="30">No</th>
                    <th width="50">Kode Ruangan</th>
                    <th>Nama Ruangan</th>
                    <th>Keterangan Ruangan</th>
                    <th width="50">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $start = 0;
            foreach ($ruangan_data as $row)
            {
            ?>
                <tr>
                    <td><?php echo ++$start;?></td>
                    <td><?php echo $row->kode_ruangan;?></td>
                    <td><?php echo ucwords($row->nama_ruangan); ?></td>
                    <td><?php echo ucfirst($row->keterangan); ?></td>
                    <td style="text-align:center" width="120">
                    <?php 
                    echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
                    echo anchor(site_url('admin/ruangan/update/'.$row->kode_ruangan),'<i class="fa fa-edit text-warning"></i>', array('class'=>'tultip','title'=>'edit data')); 
                    echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
                    echo anchor(site_url('admin/ruangan/delete/'.$row->kode_ruangan),'<i class="fa fa-trash-o text-danger"></i>', array('class'=>'tultip','title'=>'hapus data','onclick'=>'javasciprt: return confirm(\'Data ruangan ini akan dihapus, Lanjutkan ?\')')); 
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

