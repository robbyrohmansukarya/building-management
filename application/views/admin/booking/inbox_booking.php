<div class="row">
    <div style="margin-left:30px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
      <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
          <h4><i class="fa fa-arrow-circle-right"></i> Hii, Perkenalkan Saya Mr.BI ... </h4>
        
          Hallo Operator, Saat ini anda sedang melihat tabel permintaan baru untuk peminjaman ruangan yang belum diteruskan ke eksekutor, 
		  <br> silahkan segera eksekusi untuk diteruskan. Salam & Terimakasih
      </div>
</div>
  
<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-envelope-o"></i> Daftar Booking Baru</h3>
	</div>  
	<div class="box-body">
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="10">No</th>
                    <th width="100"><i class="fa fa-user"></i> User</th>
                    <th width="100"><i class="fa fa-asterisk"></i> Jabatan</th>
                    <th width="50"><i class="fa fa-calendar"></i> Mulai</th>
                    <th width="50"><i class="fa fa-calendar-o"></i> Selesai</th>
                    <th width="80"><i class="fa fa-check"></i> Status</th>
                    <th width="120" style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $start = 0;
            foreach ($ruangan_data as $row)
            {
                if($row->sts_eksekusi==1){
                    $sts = '<span class="label label-info">Siap</span>';
                }
                else if($row->sts_eksekusi==2){
                    $sts = '<span class="label label-danger">Ditolak</span>';
                }
                else{
                    $sts = '<span class="label label-warning">Menunggu</span>';
                }                
            ?>
                <tr>
                    <td><?php echo ++$start;?></td>
                    <td><?php echo ucwords($row->nama_lengkap);?></td>
                    <td><?php echo ucwords($row->jabatan); ?></td>
                    <td><?php echo $this->tanggal->konversi($row->tanggal_kegiatan); ?></td>
                    <td><?php echo $this->tanggal->konversi($row->tanggal_selesai); ?></td>
                    <td><?php echo $sts;?></td>
                    <td style="text-align: center;">
                    <?php 
                        echo anchor('admin/ruangan/forward/'.$row->id_request.'/detail-request', '<i class="fa fa-mail-forward"></i> Forward ', array('class'=>'small-box-footer tultip', 'title'=>'klik untuk meneruskan request','data-toggle'=>'tooltip'));
                        echo '&nbsp;&nbsp; | &nbsp;&nbsp;'; 
                        echo anchor('admin/ruangan/delete_request/'.$row->id_request.'/hapus-request','<i class="fa fa-trash-o text-danger"></i> <span class="text-danger">Delete</span>', array('class'=>'tultip','title'=>'hapus data','onclick'=>'javasciprt: return confirm(\'Apakah anda yakin menghapus data ini ?\')')); 
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

