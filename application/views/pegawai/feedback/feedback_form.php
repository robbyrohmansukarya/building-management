<?php
    $message_send = $this->uri->segment(4);
    if(($message_send =='message_send')){
    ?>
        <div style="margin-top:15px;">
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-thumbs-up"></i> OK !</h4>
                Feedback anda telah berhasil dikirimkan ke operator.
            </div>
        </div>          
    <?php
    }
?>

<div class="row">
	<div>
        <div style="margin-left:30px; z-index:1000;position:absolute">
            <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
        </div>
      <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
          <h4><i class="fa fa-arrow-circle-right"></i> Hallo, Perkenalkan Saya Mr.BI</h4>        
      Aplikasi Sistem Informasi Logistik membantu Pegawai Bank Indonesia dalam memudahkan penanganan permasalahan teknis atau non teknis. Anda dapat menggunakan fasilitas Request untuk penanganan segera terkait permaslahan yang Anda miliki.
      </div>
  </div>
</div>

<div class="row" style="margin-top:10px;">
	<div class="col-md-12 col-xs-12">  	
		<?php
		$level 		= $this->session->userdata('level');
		$idpengguna	= $this->session->userdata('idpengguna');
		$table 		= $this->keamanan->table_pengguna($level);
		$info_pengguna= $this->login_model->info_pengguna($table, 'idpengguna', $idpengguna);
		?>
        <!-- Chat box -->
        <div class="box box-info">
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
                        <img src="<?php echo base_url().'assets/dist/img/pegawai/'.($info_pengguna->photo =='' ? 'avatar3.png':$info_pengguna->photo);?>" alt="user image" class="online"/>
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
                            <?php echo ucwords($info_pengguna->nama_lengkap);?>
                          </a>
                          <?php echo ucfirst($row->feedback);?>
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
            <div class="box-footer">
                <?php echo form_open($action, array('role'=>'form', 'id'=>'validForm'));?>    
                <div class="form-group">
                  <div class="input-group">
                    <input class="form-control" name="feedback" placeholder="feedback message..." required data-bv-trigger="blur" data-bv-notempty-message="<i class='fa fa-times-circle'></i> silahkan isi feedback"  />
                    <div class="input-group-btn">
                      <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                </div>
                <?php echo form_close();?>      
            </div>
        </div><!-- /.box (chat box) -->
    </div><!--//col-md-12 col-xs-12-->
</div><!-- /.row -->