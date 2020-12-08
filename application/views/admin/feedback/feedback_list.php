<!-- Chat box -->
<div class="box box-info" style="margin-top:15px">
    <?php
        $level 		= $this->session->userdata('level');
        $idpengguna	= $this->session->userdata('idpengguna');
        $table 		= $this->keamanan->table_pengguna($level);
        $info_pengguna= $this->login_model->info_pengguna($table, 'idpengguna', $idpengguna);        
    ?>
    <div class="box-header">
        <i class="fa fa-comments-o"></i>
        <h3 class="box-title">Feed Back</h3>
       
        <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
            
            <div class="btn-group" data-toggle="btn-toggle" >
            <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>
            </div>
        </div>
    </div>
    <div class="box-body chat" id="chat-box">	
        <?php
        if($cek_data > 0)
        {
            foreach($feedback_data as $row)
            {		
            ?>
              <!-- chat item -->
              <div class="item">
				<?php
                    $qpegawai = $this->db->query("select * from pegawai where idpengguna='".$row->idpengguna."'");
                    $cekPegawai = $qpegawai->num_rows();
                    if($qpegawai->num_rows() > 0){
                        $pegawai = $qpegawai->row();
                        $nama = ucwords($pegawai->nama_lengkap);
						$photo = $pegawai->photo;
                    }
                    else{
                        $nama = '';
						$photo='';
                    }
					
                ?>
                <img src="<?php echo base_url().'assets/dist/img/pegawai/'.($photo =='' ? 'avatar3.png':$photo);?>" alt="user image" class="online"/>
                <p class="message">
                  <a href="#" class="name">
                  	<?php
                    	$jam 	= $this->Feedback_model->detail_jam($row->idfeedback);
						$tgl	= $this->Feedback_model->detail_tanggal($row->idfeedback);
					?>
                    <small class="text-muted pull-right">
                    <i class="fa fa-calendar-o"></i> 
                    <?php echo $tgl['tgl'];?>
                    &nbsp;&nbsp;
                    <i class="fa fa-clock-o"></i> 
                    <?php echo $jam['jam'];?>
                    </small>
                    <?php echo $nama;?>
                  </a>
                  <?php echo ucfirst($row->feedback);?>
                   <div class=" pull-right">
                   <a href="<?php echo base_url().'admin/feedback/hapus_feedback/'.$row->idfeedback;?>" class="btn btn-danger btn-xs">Hapus</a>
                   </div>
                </p>
              </div><!-- /.item -->
            
            <?php
            }//end foreach
        }else{
        ?>
          <div class="item">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-times-circle"></i> Empty</h4>
                Tidak ada data feedback yang dapat ditampilkan
            </div>
          
          </div>
        <?php	
        }
        ?>
    </div><!-- /.chat -->
</div><!-- /.box (chat box) -->