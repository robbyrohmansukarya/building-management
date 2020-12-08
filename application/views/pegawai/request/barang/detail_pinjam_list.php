<div style="margin:15px 0 0 0"><?php $this->load->view('message/message');?></div>

<div class="row">
    <div style="margin-left:30px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
    <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
      <h4><i class="fa fa-arrow-circle-right"></i> Hii, I'm Is Your Help Deks ... </h4>
    
      Hallo, Saat ini anda sedang melihat detail peminjaman barang untuk setiap paket pinjam nya , <br> 
      Disertakan juga info verifikasi dan keterlambatan. Salam & Terimakasih
    </div>
</div>

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-th-list"></i> Detail Peminjaman Barang</h3>
        <div class="box-tools pull-right">
            <div class="btn-group">                  
            <?php echo anchor(site_url('pegawai/barang/daftar'), '<i class="fa fa-th-list" aria-hidden="true"></i> Daftar', array('class'=>'tultip btn btn-default btn-xs','title'=>'daftar peminjaman barang')); ?>
            <?php echo anchor(site_url('pegawai/barang'), '<i class="fa fa-plus-square" aria-hidden="true"></i> Pinjam Barang', array('class'=>'tultip btn btn-info btn-xs','title'=>'input request peminjaman baru')); ?>
            </div>    
        </div>
	</div>
    
	<div class="box-body">
	 <div class="">   
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="30">No</th>
                    <th width="50">Kode</th>
                    <th width="200">Nama Barang</th>
                    <th width="100">Qty</th>
                    <th width="100">Tgl Pinjam</th>
                    <th width="100">Tgl Kembali</th>
                    <th width="100">Verifikasi</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $start = 0;
            foreach ($pinjam_data as $row)
            {
                if($row->verifikasi==1){
                    $sts = '<span class="label label-info">Dipinjamkan</span>';
                }
                else if($row->verifikasi==2){
                    $sts = '<span class="label label-success">Dikembalikan</span>';
                }
                else{
                    $sts = '<span class="label label-warning">Menunggu</span>';
                }
            ?>
                <tr>
                    <td><?php echo ++$start;?></td>
                    <td><?php echo $row->kode_barang;?></td>
                    <td><?php echo ucwords($row->nama_barang); ?></td>
                    <td style="text-align: center;"><?php echo $row->qty; ?></td>
                    <td style="text-align:center">
                    <?php 
                        $tanggal_peminjaman    = $this->tanggal->konversi($row->tanggal_peminjaman);
                        echo $tanggal_peminjaman;//.' <i class="fa fa-clock-o"></i> '.$jamReq['jam'];
                    ?>                
                    </td>
                    <td style="text-align:center">
                    <?php 
                        
                        $tanggal_pengembalian    = $this->tanggal->konversi($row->tanggal_pengembalian);
                        echo $tanggal_pengembalian;//.' <i class="fa fa-clock-o"></i> '.$jamReq['jam'];
                    ?>                
                    </td>
                    <td style="text-align:center" width="100">
                    <?php 
                        echo $sts;
                    ?>
                    </td>
                    <td style="text-align:center" width="100">
                    <?php 
                        if(($row->verifikasi !=1) && ($row->verifikasi !=2))
                        {
                            echo anchor('pegawai/barang/delete_Reqbarang/'.$row->id.'/'.$row->id_request.'/hapus-data-barang','<i class="fa fa-trash-o"></i> delete', array('class'=>'btn btn-danger btn-xs tultip','title'=>'hapus data barang','onclick'=>'javasciprt: return confirm(\'Apakah anda yakin menghapus data ini ?\')'));
                        }else{
                    ?>
                            <a href="#" class="btn btn-xs  tultip" title="data yang sudah diverifikasi tidak bisa dirubah atau dihapus"><i class="fa fa-trash-o"></i> delete</a>
                    <?php    
                        } 
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

