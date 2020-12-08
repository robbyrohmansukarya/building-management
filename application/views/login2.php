<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>ANDROMEDA BANK INDONESIA</title>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/dist/img/bi_logo.png">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
  <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css';?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url().'assets/bootstrap/css/font-awesome.min.css';?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css';?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url().'assets/login/style2.css';?>" rel="stylesheet" type="text/css" />
   
</head>

<body>
<div class="container">
  <div class="login-wrap">

	<div class="login-html">
        <?php 
            echo validation_errors('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>','</div>');
			if($error === TRUE):
				echo '<div class="alert alert-danger"> username dan password tidak sesuai<button class="close" data-dismiss="alert" type="button">×</button>','</div>';
			endif;			
        ?>
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked ><label for="tab-1" class="tab" style="margin-left:21%">ANDROMEDA </label>
    
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
		<div class="login-form">
        <?php 			
            echo form_open($action); 
        ?>
			<div class="sign-in-htm">
				<div class="group" style="margin-top:15px">
					<label for="pass" class="label" style="text-align:left">Username</label>
                    <input type="email" name="username" 
                    class="input" placeholder="Email" />
				</div>
				<div class="group">
					<label for="pass" class="label" style="text-align:left">Password</label>
                    <input type="password" name="password" 
                    class="input" placeholder="*****" />
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign In" style="background-color: #cca000 !important">
				</div>
				<div class="foot-lnk">
                  <p><strong> BANK INDONESIA BANDUNG &copy; 2020</strong></p>
				</div>
			</div>
        <?php echo form_close();?>
		</div>
	</div>
</div>
    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url().'assets/plugins/jQuery/jQuery-2.1.3.min.js';?>"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js';?>" type="text/javascript"></script>

</body>
</html>
