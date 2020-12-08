<div style="margin:15px 0 0 0"><?php $this->load->view('message/message');?></div>

<div class="box box-warning color-palette-box" style="margin-top:15px">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-th-list"></i> Daftar BooKing Ruangan</h3>
        <div class="box-tools pull-right">              
            <?php echo anchor(site_url('pegawai/ruangan/booking'), '<i class="fa fa-plus-square" aria-hidden="true"></i> Input Booking', array('class'=>'tultip','title'=>'klik untuk input booking ruangan')); ?>
        </div>
    </div>
    
    <div class="box-body">
     <div class="">   
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="10">No</th>
                    <th width="150">Nama Kegiatan</th>
                    <th width="80"><i class="fa fa-calendar"></i> Mulai</th>
                    <th width="80"><i class="fa fa-calendar-o"></i> Selesai</th>
                    <th width="80">Status</th>
                    <th width="70" style="text-align: center;">Aksi</th>
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
                else if($row->sts_eksekusi==3){
                    $sts = '<span class="label label-danger">Ditolak</span>';
                }
                else{
                    $sts = '<span class="label label-warning">Menunggu</span>';
                }                
            ?>
                <tr>
                    <td><?php echo ++$start;?></td>
                    <td><?php echo ucwords($row->nama_kegiatan);?></td>
                    <td><?php echo $this->tanggal->konversi($row->tanggal_kegiatan); ?></td>
                    <td><?php echo $this->tanggal->konversi($row->tanggal_selesai); ?></td>
                    <td><?php echo $sts;?></td>
                    <td style="text-align: center;">
                    <?php 
                        echo anchor('pegawai/ruangan/detail_booking/'.$row->id_request.'/detail-status','<i class="fa fa-search-plus"></i> detail status', array('class'=>'tultip','title'=>'klik untuk lihat detail status'));
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