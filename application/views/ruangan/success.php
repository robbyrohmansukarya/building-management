<div class="" style="margin-top:15px">
<?php
	//echo $sukses = $this->uri->segment(4);
	if(($param =='add') || ($param =='delete')){
	?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-thumbs-up"></i> OK !</h4>
		Request anda telah kami terima <br /><br />
        <p>
            <?php echo anchor($level.'/dashboard', '<i class="fa fa-arrow-circle-left"></i> Dashboard', array('class' => 'small-box-footer tultip', 'title'=>'klik untuk kembali ke halaman dashboard','data-toggle'=>'tooltip',''));?>       
      	</p>
	</div>		
	<?php	
	}
?>
</div>