<div style="margin:15px 0 0 0"><?php $this->load->view('message/message');?></div>
<div class="row">
    <div style="margin-left:30px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
    <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
        <h4><i class="fa fa-arrow-circle-right"></i> Hii, I'm Is Your Help Deks ... </h4>
        
        Hallo Operator, Saat ini anda sedang melihat tabel status eksekusi dari eksekutor untuk permintaan peminjaman ruangan , <br> 
        silahkan cek pada tabel statusnya apakah menunggu atau sudah di verifikasi. Salam & Terimakasih
    </div>
</div>

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-th-list"></i> Daftar Barang</h3>
        <div class="box-tools pull-right">              
            <?php echo anchor(site_url('pegawai/barang/baru'), '<i class="fa fa-plus-square" aria-hidden="true"></i> pinjam barang', array('class'=>'tultip','title'=>'input request peminjaman baru')); ?>
        </div>
	</div>
    
	<div class="box-body">
	 <div class="">   
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="30">No</th>
                    <th width="80">Kode</th>
                    <th>Nama Barang</th>
                    <th>Keterangan Barang</th>
                    <th width="100" style="text-align:center">Stok</th>
                    <th width="200" style="text-align:center">Status</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $start = 0;
			$jmlStok= 0;
            foreach ($barang_data as $row)
            {
            ?>
                <tr>
                    <td><?php echo ++$start;?></td>
                    <td><?php echo $row->kode_barang;?></td>
                    <td><?php echo ucwords($row->nama_barang); ?></td>
                    <td><?php echo ucfirst($row->keterangan); ?></td>
                    <td style="text-align:center">
					<?php 
						//echo $row->stok;
						$dipinjam = $this->db->query("select sum(qty) as totQty from request_barang where kode_barang='".$row->kode_barang."'")->row();
						//echo ($dipinjam->totQty != '' ? $dipinjam->totQty : '-');
						$jmlStok = ($row->jumlah_stok - $dipinjam->totQty);
						echo $jmlStok;
						
					?>
                    </td>
                    <td style="text-align:center">
                    <?php 
                        echo ($jmlStok > 0 ? '<span class="label label-success" style="padding:6px"><i class="fa fa-check"></i> Tersedia</span>':'<span class="label label-danger" style="padding:6px"><i class="fa fa-ban"></i> Tidak Tersedia</span>');
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

