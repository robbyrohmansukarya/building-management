<?php
	$sukses = $this->uri->segment(3);
	$suksess = $this->uri->segment(4);
	$suksesss = $this->uri->segment(5);
	if(($sukses =='extension')||($suksess == 'extension')||($suksesss == 'extension')){
	?>
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-times"></i> Error !</h4>
		file yang diterima hanya .jpg atau .png 
	</div>
    <?php
	}
	if(($sukses =='insert')||($suksess =='insert')){
	?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-thumbs-up"></i> OK !</h4>
		Data baru berhasil ditambahkan
	</div>		
	<?php	
	}
	if(($suksess == 'update')||($suksesss == 'success')){
	?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-thumbs-up"></i> OK !</h4>
		Data berhasil di rubah
	</div>		
	<?php	
	}
	if(($sukses =='delete')||($suksess =='delete')||($suksesss =='delete')){
	?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-thumbs-up"></i> OK !</h4>
		1 Data berhasil dihapus
	</div>		
	<?php	
	}
?>
