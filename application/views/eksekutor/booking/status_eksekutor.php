<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-th-list"></i> Daftar BooKing Ruangan</h3>
	</div>
    
	<div class="box-body">
	 <div class="">   
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                <tr>
                    <th width="10">No</th>
                    <th width="100"><i class="fa fa-user"></i> User</th>
                    <th width="100"><i class="fa fa-asterisk"></i> Jabatan</th>
                    <th width="50"><i class="fa fa-calendar"></i> Mulai</th>
                    <th width="50"><i class="fa fa-calendar-o"></i> Selesai</th>
                    <th width="80"><i class="fa fa-check"></i> Status</th>
                    <th width="100"><i class="fa fa-info-circle"></i> Nama Kegiatan</th>
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
                    <td>
                        <div class="btn-group"> 
						<a 
                            href="javascript:;"
                            data-nama_kegiatan="<?php echo ucwords($row->nama_kegiatan);?>"
                            data-deskripsi_kegiatan="<?php echo ucwords($row->deskripsi_kegiatan); ?>"
                            data-toggle="modal" data-target="#edit-data"
                            class="text-info tultip"
                            title="klik lihat deskripsi kegiatan">
                            <i class="fa fa-search"></i> Deskripsi Kegiatan 
                        </a>
                        </div>
                    </td>
                    <td style="text-align: center;">
                    <?php 
                        echo anchor('eksekutor/ruangan/detail_sts_eksekutor/'.$row->id_request.'/detail-status-eksekutor', '<i class="fa fa-refresh"></i> Update Status', array('class'=>'small-box-footer tultip', 'title'=>'update status','data-toggle'=>'tooltip'));
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
    <!-- EDIT MODAL -->
    <div class="modal edit-data fade" id="edit-data">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Nama Kegiatan Dan Deskripsi Kegiatan</h4>
          </div>
            <div class="modal-body">
                <div class="form-group">
                <label for="recipient-name" class="control-label">Nama Kegiatan</label>
                <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" placeholder="" disabled>
                </div>
                <div class="form-group">
                <label for="recipient-name" class="control-label">Deskripsi Kegiatan</label>
                <input type="text" class="form-control" id="deskripsi_kegiatan" name="deskripsi_kegiatan" placeholder="" disabled>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info pull-right" data-dismiss="modal"><i class='fa fa-times-circle'></i> Close</button>
            </div>
            <?php echo form_close();?>
        </div>
        <!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- // END EDIT MODAL -->
    
</div>
<script>
	$(document).ready(function() {
		// Untuk sunting
		$('#edit-data').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
			var modal          = $(this)

			// Isi nilai pada field
			modal.find('#nama_kegiatan').attr("value",div.data('nama_kegiatan'));
			modal.find('#deskripsi_kegiatan').attr("value",div.data('deskripsi_kegiatan'));
		});
	});
</script>    


