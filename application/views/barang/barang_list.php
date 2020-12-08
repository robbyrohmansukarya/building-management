<div style="margin:15px 0 0 0"><?php $this->load->view('message/message');?></div>

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-th-list"></i> Daftar Barang</h3>
        <div class="box-tools pull-right">              
			<?php echo anchor(site_url('admin/barang/create'), '<i class="fa fa-plus-square" aria-hidden="true"></i> Add', array('class'=>'btn btn-xs btn-info tultip','title'=>'tambah data baru')); ?>
        </div>
	</div>
    
	<div class="box-body">
	 <div class="">   
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="30">No</th>
                    <th width="50">Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Keterangan</th>
                    <th width="100" style="text-align:center">Jumlah</th>
                    <th width="100" style="text-align:center">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $start = 0;
            foreach ($barang_data as $row)
            {
            ?>
                <tr>
                    <td><?php echo ++$start;?></td>
                    <td><?php echo $row->kode_barang;?></td>
                    <td><?php echo ucwords($row->nama_barang); ?></td>
                    <td><?php echo ucfirst($row->keterangan); ?></td>
                    <td style="text-align:center"><?php echo $row->jumlah_stok;?></td>
                    <td style="text-align:center" width="120">
                    <?php 
                    echo anchor(site_url('admin/barang/update/'.$row->kode_barang),'<i class="fa fa-edit text-warning"></i>', array('class'=>'tultip','title'=>'edit data')); 
                    echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
                    echo anchor(site_url('admin/barang/delete/'.$row->kode_barang),'<i class="fa fa-trash-o text-danger"></i>', array('class'=>'tultip','title'=>'hapus data','onclick'=>'javasciprt: return confirm(\'Data barang ini akan dihapus, Lanjutkan ?\')')); 
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

