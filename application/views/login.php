<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Sistem Komplain Online</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/dist/img/bi_logo.png">
    
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css';?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url().'assets/bootstrap/css/font-awesome.min.css';?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css';?>" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url().'assets/plugins/iCheck/square/blue.css';?>" rel="stylesheet" type="text/css" />
    <link rel="manifest" href="/manifest.json">
    <script>
  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body class="login-page" style="background-color: #333333 !important">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo base_url();?>"><b><span class="glyphicon glyphicon-off"></span> Login Pengguna</b></a>
      </div><!-- /.login-logo -->
    
      <div class="login-box-body">
        <?php 
            echo validation_errors('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>','</div>');
			if($error === TRUE):
				echo '<div class="alert alert-danger"> username dan password tidak sesuai<button class="close" data-dismiss="alert" type="button">×</button>','</div>';
			endif;
			
            echo form_open($action); 
        ?>
          <div class="form-group has-feedback">
              <input type="email" name="username" 
                     class="form-control" placeholder="Email" />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <input type="password" name="password" 
                     class="form-control" placeholder="Password" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
        <div class="row">
            <div class="col-xs-8">    
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
        </div>
        <?php echo form_close();?>
        
        <div class="social-auth-links text-center">
          <hr class="often" style="margin:0px 0 10px 0px" />
          <p>Sistem Komplain Online <br /> <strong> Rajawali Hoyoto &copy; 2021</strong></p>
        </div><!-- /.social-auth-links -->
      </div><!-- /.login-box-body -->
      
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url().'assets/plugins/jQuery/jQuery-2.1.3.min.js';?>"></script>
    <script>
    if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('sw.js');
    });
  }
</script> 
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js';?>" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url().'assets/plugins/iCheck/icheck.min.js';?>" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
     
  </body>
  
</html>
<?php

/* 
 * ***************************************************************
 * Script : login
 * Version : 1
 * Date : 14/04/2017
 * Author : Lalan Jaelani.
 * Email : lanz8665@gmail.com
 * Description : 
 * ***************************************************************
 */

