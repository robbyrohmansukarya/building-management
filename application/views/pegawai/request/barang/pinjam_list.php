<div style="margin:15px 0 0 0"><?php $this->load->view('message/message');?></div>
<div class="row">
    <div style="margin-left:30px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
    <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
      <h4><i class="fa fa-arrow-circle-right"></i> Hii, I'm Is Your Help Deks ... </h4>
    
      Hallo, Saat ini Anda sedang meilhat aftar peminjaman barang yang anda lakukan.<br> 
      klik detail untuk melihat paket peminjaman yang anda lakukan. Salam & Terimakasih
    </div>
</div>

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-th-list"></i> Daftar Peminjaman Barang</h3>
        <div class="box-tools pull-right">              
            <?php echo anchor(site_url('pegawai/barang'), '<i class="fa fa-plus-square" aria-hidden="true"></i> pinjam barang', array('class'=>'tultip','title'=>'input request peminjaman baru')); ?>
        </div>
	</div>
	<div class="box-body">
	 <div class="">   
        <table class="table table-bordered display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="30">No</th>
                    <th width="100">Tanggal Pinjam</th>
                    <th width="100">Tanggal Kembali</th>
                    <th width="100">Status Verifikasi</th>
                    <th width="100">Keterlambatan</th>
                    <th width="70" style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $start = 0;
			date_default_timezone_set('Asia/Jakarta');
			$thisDay = time(); // Waktu sekarang
            foreach ($pinjam_data as $row)
            {
                if($row->verifikasi==1){
                    $sts = '<span class="label label-info">Dipinjamkan</span>';
					$tanggalKembali = strtotime($row->tanggal_pengembalian);
					$diff	= $thisDay - $tanggalKembali;
					$selisih	= floor($diff / (60 * 60 * 24));
					$infoSelisih = '<span class="label label-danger">'.$selisih.' Hari</span>';
					//echo floor($diff / (60 * 60 * 24 * 365)) . ' Tahun';
					//echo floor($diff / (60 * 60 * 24)) . ' Hari'; 
                }
                else if($row->verifikasi==2){
                    $sts = '<span class="label label-success">Dikembalikan</span>';
					$selisih = '';
					$infoSelisih='';
                }
                else{
                    $sts = '<span class="label label-warning">Menunggu</span>';
					$selisih='';
					$infoSelisih='';
                }
					$bgBaris = ($selisih > 0 ? 'danger':'');
            ?>
                <tr class="<?php echo $bgBaris?>">
                    <td style="text-align:center"><?php echo ++$start;?></td>
                    <td>
                    <?php 
                        $tanggal_peminjaman    = $this->tanggal->konversi($row->tanggal_peminjaman);
                        echo $tanggal_peminjaman;//.' <i class="fa fa-clock-o"></i> '.$jamReq['jam'];
                    ?>                
                    </td>
                    <td>
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
                    <td style="text-align:right" width="">
                    <?php 
                        echo $infoSelisih;
                    ?>
                    </td>
                    <td style="text-align:right">
                    <div class="btn-group">
                    <?php 
                        if(($row->verifikasi !=1) && ($row->verifikasi !=2))
                        {
                            echo anchor('pegawai/barang/delete_peminjaman/'.$row->id_request.'/hapus-request','<i class="fa fa-trash-o"></i> delete', array('class'=>'btn btn-danger btn-xs tultip','title'=>'hapus data peminjaman','onclick'=>'javasciprt: return confirm(\'Apakah anda yakin menghapus data peminjaman?\')'));
                        }                        
                        echo anchor('pegawai/barang/detail_peminjaman/'.$row->id_request.'/detail-request-peminjaman','<i class="fa fa-search-plus"></i> detail', array('class'=>'btn btn-xs btn-info tultip','title'=>'detail barang yang dipinjam'));
                    ?>
                        
                    </div>
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

