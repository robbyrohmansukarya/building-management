<div style="margin:15px 0 0 0">
<?php $this->load->view('message/message');?>
</div>

<div class="box box-warning color-palette-box" style="margin-top:15px">
	<div class="box-header with-border">
	  <h3 class="box-title"><i class="fa fa-folder-open" ></i> Daftar Request</h3>
	</div>
    
	<div class="box-body table-responsive">
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <thead class="bg-default">
                <tr>
                    <th width="20">No</th>
                    <th width="200"><i class="fa fa-user"></i> Pegawai</th>
                    <th width="150"><i class="fa fa-tags"></i> Klasifikasi</th>
                    <th width="150"><i class="fa fa-calendar"></i> Tanggal Request</th>
                    <th width="150"><i class="fa fa-exclamation-circle"></i> Status </th>
                    <th width="100"><i class="fa fa-arrows-alt"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
				$start = 0;
				$sts = '';
				foreach ($request_data as $row)
				{
					if($row->sts_eksekusi==1){
						$sts = '<span class="label label-info">Sedang Ditangani</span>';
					}
					else if($row->sts_eksekusi==2){
						$sts = '<span class="label label-success">Selesai Ditangani</span>';
					}
					else{
						$sts = '<span class="label label-warning">Waiting List</span>';
					}
				?>
				<tr>
                    <td><?php echo ++$start ?></td>
                    <td>
					<?php
						$qpegawai = $this->db->query("select * from pegawai where idpengguna='".$row->idpengguna."'");
						$cekPegawai = $qpegawai->num_rows();
						if($qpegawai->num_rows() > 0){
							$pegawai = $qpegawai->row();
							echo anchor('eksekutor/request/read/'.$row->id_request.'/detail-request', ucwords($pegawai->nama_lengkap), array('class'=>'small-box-footer tultip', 'title'=>'klik untuk melihat detail request','data-toggle'=>'tooltip'));
						}
						else{
							echo 'Pegawai Tidak Terdaftar';
						}
					?>
                    </td>
                    <td>
					<?php 
						$klasifikasi = $this->Request_model->get_detail('klasifikasi_request', 'id_klasifikasi', $row->id_klasifikasi);
						echo $klasifikasi->klasifikasi;
					?>
                    </td>
                    <td>
					<?php 
						$tglReq			= $this->Request_model->detail_tanggal($row->id_request);
						$jamReq			= $this->Request_model->detail_jam($row->id_request);
						$tgl_request	= $this->tanggal->konversi($tglReq['tgl']);
						echo $tgl_request.' <i class="fa fa-clock-o"></i> '.$jamReq['jam'];
					?>
                    </td>
                    <td><?php echo $sts;?></td>
                    <td>
					<?php 
						echo anchor('eksekutor/request/read/'.$row->id_request.'/detail-request', '<i class="fa fa-refresh"></i> Update Status ', array('class'=>'small-box-footer tultip', 'title'=>'klik untuk melihat detail request','data-toggle'=>'tooltip'));
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

