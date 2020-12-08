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
	  <h3 class="box-title"><i class="fa fa-info-circle"></i> Tracking <?php echo ucwords($nama_barang);?></h3>
	</div>
	<div class="box-body">
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="30">No</th>
                    <th width="100"><i class="fa fa-calendar"></i> Pinjam</th>
                    <th width="100"><i class="fa fa-calendar-o"></i> Kembali</th>
                    <th>User Request</th>
                    <th>Jabatan</th>
                    <th width="100" style="text-align:center">QTY</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $start = 0;
            foreach ($pinjam_data as $row)
            {
                if($row->verifikasi==1){
                    $sts = '<span class="label label-info">Siap</span>';
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
                    <td style="text-align:center" width="">
                    <?php 
                        echo $row->qty;
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