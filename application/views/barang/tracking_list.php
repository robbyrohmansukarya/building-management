<div class="row">
    <div style="margin-left:30px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
    <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
      <h4><i class="fa fa-arrow-circle-right"></i> Hii, I'm Is Your Help Deks ... </h4>
    
      Hallo Operator, Saat ini anda sedang melihat tabel permintaan peminjaman barang Silahkan lakukan verifikasi apakah berhak untuk di pinjamkan atau tidak pada user tersebut , <br> 
      Klik Icon verifikasi. Salam & Terimakasih
    </div>
</div>

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
	  <h3 class="box-title"><i class="fa fa-th-list"></i> Tracking List Barang</h3>
	</div>
	<div class="box-body">
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="30" style="text-align:center">No</th>
                    <th width="50" style="text-align:center">Kode</th>
                    <th>Nama Barang</th>
                    <th width="50" style="text-align:center">Jumlah</th>
                    <th width="100" style="text-align:center">Dipinjam</th>
                    <th width="100" style="text-align:center">Sisa (Stok)</th>
                    <th width="80" style="text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $start = 0;
            foreach ($pinjam_data as $row)
            {
            ?>
                <tr>
                    <td><?php echo ++$start;?></td>
                    <td><?php echo $row->kode_barang;?></td>
                    <td><?php echo ucwords($row->nama_barang);?></td>
                    <td style="text-align:center"><?php echo $row->jumlah_stok;?></td>
                    <td style="text-align:center">
					<?php 
						$dipinjam = $this->db->query("select sum(qty) as totQty from request_barang where kode_barang='".$row->kode_barang."'")->row();
						echo ($dipinjam->totQty != '' ? $dipinjam->totQty : '-');
					?>
                    </td>
                    <td style="text-align:center"><?php echo ($row->jumlah_stok - $dipinjam->totQty);?></td>
                    <td style="text-align:center">
                    <?php 
	                    echo anchor('admin/barang/tracking_detail/'.$row->kode_barang.'/detail-tracking-barang','<i class="fa fa-search"></i> detail', array('class'=>'btn btn-info btn-xs tultip','title'=>'lihat detail peminjam barang'));
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