<!--box sortcut-->
<div class="row" style="margin-top:15px">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php echo $jmlWaiting;?></h3>
          <p>Waiting List</p>
        </div>
        <div class="icon">
          <i class="fa fa-clock-o"></i>
        </div>
        <?php echo anchor($level.'/ticket/all/all-ticket', '<i class="fa fa-arrow-circle-right"></i>', array('class' => 'small-box-footer tultip', 'title'=>'klik untuk melihat request anda hari ini','data-toggle'=>'tooltip'));?>
        </div>
    </div><!-- ./col -->
    
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?php echo $jmlSedang;?></h3>
          <p>Sedang Ditangani</p>
        </div>
        <div class="icon">
          <i class="fa fa-wrench"></i>
        </div>
        <?php echo anchor($level.'/knowledge/all_knowledge', '<i class="fa fa-arrow-circle-right"></i>', array('class' => 'small-box-footer tultip', 'title'=>'klik untuk melihat request sedang dikerjakan','data-toggle'=>'tooltip'));?>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php echo $jmlSelesai;?></h3>
          <p>Selesai Dikerjakan</p>
        </div>
        <div class="icon">
          <i class="fa fa-check-square"></i>
        </div>
        <?php echo anchor($level.'/repository', '<i class="fa fa-arrow-circle-right"></i>', array('class' => 'small-box-footer tultip', 'title'=>'klik untuk melihat request selesai dikerjakan','data-toggle'=>'tooltip'));?>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?php echo $allRequest;?></h3>
          <p>All Request</p>
        </div>
        <div class="icon">
          <i class="fa fa-folder-open"></i>
        </div>
        <?php echo anchor($level.'/repository', '<i class="fa fa-arrow-circle-right"></i>', array('class' => 'small-box-footer tultip', 'title'=>'klik untuk melihat request selesai dikerjakan','data-toggle'=>'tooltip'));?>
      </div>
    </div><!-- ./col -->
</div><!--//end row-->


<div class="row" style="margin-top:15px">
    <div class="col-md-12" style="padding:0px">
        <div class="col-md-6">
            <!-- TO DO List -->
            <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>
              <h3 class="box-title">Request Hari Ini</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <ul class="todo-list">
				<?php
				$label='';$ico='';$sts='';
				if($cekRequestHariIni > 0){
					foreach($requestHariIni as $rowReq)
					{
						if($rowReq->sts_eksekusi == 0){
							$label = 'label-warning';
							$sts = 'waiting list';
							$ico = '<i class="fa fa-clock-o"></i>';
						}
						else if($rowReq->sts_eksekusi == 1){
							$label = 'label-info';
							$sts = 'sedang ditangani';
							$ico = '<i class="fa fa-wrench"></i>';
						}
						else if($rowReq->sts_eksekusi == 2){
							$label = 'label-success';
							$sts = 'selesai dikerjakan';
							$ico = '<i class="fa fa-check-square"></i>';
						}
						else{
							$label='';$ico='';$sts='';
						}
				?>
                    <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <span class="text"><?php echo ucwords($rowReq->request);?></span>
                      <small class="label <?php echo $label?>"><?php echo $rowReq->tanggal_request.' '.$ico.' '.$sts;?></small>
                      <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                      </div>
                    </li>
					<?php	
					}//end for
				?>
          </ul>
			<?php					
				}//end if cek
				else{
			?>
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info-circle"></i></h4>
                    Anda tidak mengirimkan request hari ini<br /><br />
                </div>
				<?php	
				}
				?>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix no-border">
            </div>
            </div><!-- /.box -->
        </div><!-- /.col (LEFT)col-md-6 -->
        
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-folder-o" aria-hidden="true"></i> History Request</h3>
                </div>
                <div class="box-body">
                    <ul class="todo-list">
					<?php
                    if($cekHRequest > 0){
						$label='';$ico='';$sts='';
                        foreach($HRequest as $rowHReq)
						{
                            if($rowHReq->sts_eksekusi == 0){
                                $label = 'label-warning';
                                $sts = 'waiting list';
                                $ico = '<i class="fa fa-clock-o"></i>';
                            }
                            else if($rowHReq->sts_eksekusi == 1){
                                $label = 'label-info';
                                $sts = 'sedang ditangani';
                                $ico = '<i class="fa fa-wrench"></i>';
                            }
                            else if($rowHReq->sts_eksekusi == 2){
                                $label = 'label-success';
                                $sts = 'selesai dikerjakan';
                                $ico = '<i class="fa fa-check-square"></i>';
                            }
                            else{
                                $label='';$ico='';$sts='';
                            }
                    ?>
                        <li>
                          <span class="handle">
                            <i class="fa fa-ellipsis-v"></i>
                            <i class="fa fa-ellipsis-v"></i>
                          </span>
                          <span class="text"><?php echo ucwords($rowHReq->request);?></span>
                          <small class="label  <?php echo $label?>">
						  	<?php echo $rowHReq->tanggal_request.' '.$ico.' '.$sts;?>
                          </small>
                          <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                          </div>
                        </li>
					<?php	
					}//end foreach
				?>
          </ul>
			<?php					
				}//endif
				else{
			?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i></h4>
                    Tidak ada informasi history request untuk Anda <br /><br />
                </div>
				<?php	
				}
				?>
                </div><!-- /.box-body-->
                <div class="box-footer clearfix no-border"></div>
            </div><!-- /.box -->
        </div><!-- /.col (RIGHT)col-md-6 -->
    </div>
</div>
