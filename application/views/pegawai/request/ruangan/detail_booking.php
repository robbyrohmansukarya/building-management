<div style="margin:15px 0 0 0"><?php $this->load->view('message/message');?></div>

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-th-list"></i> List Ruangan</h3>
        <div class="box-tools pull-right">              
			<?php echo anchor(site_url('pegawai/ruangan/cek_ruangan'), '<i class="fa fa-plus-square" aria-hidden="true"></i> Daftar Satatus ', array('class'=>'tultip','title'=>'daftar ruangan yang dibooking')); ?>
        </div>
	</div>
    
	<div class="box-body">
	 <div class="">   
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="20">No</th>
                    <th width="30">Kode</th>
                    <th>Ruangan</th>
                    <th>Nama Kegiatan</th>
                    <th width="50" style="text-align: center;"><i class="fa fa-calendar"></i> Booking</th>
                    <th width="30" style="text-align: center;"><i class="fa fa-clock-o"></i> Mulai</th>
                    <th width="30" style="text-align: center;"><i class="fa fa-clock-o"></i> Selesai</th>
                    <th width="30" style="text-align: center;">Aksi</th>
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
                    <td><?php echo ucwords($row->kode_ruangan);?></td>
                    <td><?php echo ucwords($row->nama_ruangan); ?></td>
                    <td><?php echo ucwords($row->nama_kegiatan); ?></td>
                    <td style="text-align: center;"><?php echo $this->tanggal->konversi($row->tanggal_kegiatan); ?></td>
                    <td style="text-align: center;"><?php echo $row->jam_mulai; ?></td>
                    <td style="text-align: center;"><?php echo $row->jam_selesai; ?></td>
                    <td style="text-align: center;">
                        <?php
                        echo anchor(site_url('pegawai/ruangan/delete_booking/'.$row->id.'/'.$row->id_request.'/delete-request-ruangan'),'<i class="fa fa-trash-o text-danger"></i>', array('class'=>'tultip','title'=>'hapus data','onclick'=>'javasciprt: return confirm(\'Data ruangan ini akan dihapus, Apakah anda yakin menghapus data ini ?\')')); 
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

