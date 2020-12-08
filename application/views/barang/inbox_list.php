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
	  <h3 class="box-title"><i class="fa fa-th-list"></i> List Permintaan Peminjaman Barang</h3>
	</div>
	<div class="box-body">
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="30">No</th>
                    <th width="150">User Request</th>
                    <th>Jabatan</th>
                    <th width="100"><i class="fa fa-calendar"></i> Pinjam</th>
                    <th width="100"><i class="fa fa-calendar-o"></i> Kembali</th>
                    <th width="100">Status Verifikasi</th>
                    <th width="100">Keterlambatan</th>
                    <th width="150">Aksi</th>
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
                }
                else if($row->verifikasi==2){
                    $sts = '<span class="label label-success">Dikembalikan</span>';
					$selisih = '';
					$infoSelisih='';
                }
                else{
                    $sts = '<span class="label label-warning">Menunggu</span>';
					$selisih = '';
					$infoSelisih='';
                }
					$bgBaris = ($selisih > 0 ? 'danger':'');
            ?>
                <tr class="<?php echo $bgBaris?>">
                    <td><?php echo ++$start;?></td>
                    <td>
					<?php
						$qpegawai = $this->db->query("select * from pegawai where idpengguna='".$row->idpengguna."'");
						$cekPegawai = $qpegawai->num_rows();
						if($qpegawai->num_rows() > 0){
							$pegawai = $qpegawai->row();
							$jabatan = $pegawai->jabatan;
							echo anchor('admin/barang/detail_peminjaman/'.$row->id_request.'/detail-request-peminjaman', ucwords($pegawai->nama_lengkap), array('class'=>'small-box-footer tultip', 'title'=>'klik untuk melihat detail request','data-toggle'=>'tooltip'));
						}
						else{
							$jabatan = '';
							echo 'Pegawai Tidak Terdaftar';
						}
					?>
                    </td>
                    <td><?php echo ucfirst($jabatan);?></td>
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
                    <td style="text-align:center" width="">
                    <?php 
                        echo $infoSelisih;
                    ?>
                    </td>
                    <td style="text-align:center" width="150">
                    <?php 
	                    echo anchor('admin/barang/detail_peminjaman/'.$row->id_request.'/detail-request-peminjaman','<i class="fa fa-retweet"></i> verifikasi', array('class'=>'btn btn-info btn-xs tultip','title'=>'update dan verifikasi peminjaman'));
	                    echo '&nbsp;';
	                    echo anchor('admin/barang/delete_peminjaman/'.$row->id_request.'/hapus-request','<i class="fa fa-trash-o"></i> delete', array('class'=>'btn btn-danger btn-xs tultip','title'=>'hapus data','onclick'=>'javasciprt: return confirm(\'Apakah anda yakin menghapus data ini ?\')'));
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