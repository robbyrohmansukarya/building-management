<div style="margin:15px 0 0 0"><?php $this->load->view('message/message');?></div>
<div class="row">
    <div style="margin-left:30px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
    <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
      <h4><i class="fa fa-arrow-circle-right"></i> Hii, I'm Is Your Help Deks ... </h4>
      Hallo, saat ini anda sedang melihat daftar ruangan yang bisa anda booking untuk rapat
    </div>
</div>

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-th-list"></i> Daftar Ruangan</h3>
        <div class="box-tools pull-right">              
        </div>
	</div>    
	<div class="box-body">
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="30">No</th>
                    <th width="50">Kode</th>
                    <th>Nama Ruangan</th>
                    <th>Keterangan Ruangan</th>
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
                    <td><?php echo $row->kode_ruangan;?></td>
                    <td><?php echo ucwords($row->nama_ruangan); ?></td>
                    <td><?php echo ucfirst($row->keterangan); ?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
	</div>
</div>

