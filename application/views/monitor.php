<?php if(!defined('BASEPATH')) exit('No Direct Script Allowed');?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Sisem Informasi Logistik</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="shortcut icon" href="<?php echo base_url();?>assets/dist/img/favicon1.ico">
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css';?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url().'assets/plugins/fontawesome/css/font-awesome.min.css';?>" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url().'assets/plugins/ionicons/css/ionicons.min.css';?>" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.css';?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url().'assets/plugins/datatables/responsive.dataTables.min.css';?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css';?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css';?>" rel="stylesheet" type="text/css" />
    
    <link href="<?php echo base_url().'assets/plugins/wysiwyg/summernote.css';?>" rel="stylesheet">
	<!-- Bootstrap time Picker -->
    <link href="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.css';?>" rel="stylesheet">
	<!-- daterange picker -->
    <link href="<?php echo base_url().'assets/plugins/daterangepicker/daterangepicker-bs3.css';?>" rel="stylesheet">
 
    <link href="<?php echo base_url().'assets/plugins/iCheck/all.css';?>" rel="stylesheet">
    
    <link href="<?php echo base_url().'assets/gaya/gaya.css';?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url().'assets/plugins/jQuery/jQuery-2.1.3.min.js';?>"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js';?>" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js';?>" type="text/javascript"></script>    
    <!-- FastClick -->
    <script src='<?php echo base_url().'assets/plugins/fastclick/fastclick.min.js';?>'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url().'assets/dist/js/app.min.js';?>" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js';?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/plugins/datatables/dataTables.responsive.js';?>" type="text/javascript"></script>
    
    <!-- ./wrapper -->
	<script src="<?php echo base_url().'assets/plugins/daterangepicker/daterangepicker.js';?>"></script>
    <!-- bootstrap time picker -->
	<script src="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.js';?>"></script>
    
	<script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.js';?>"></script>
	<script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.date.extensions.js';?>"></script>
	<script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.extensions.js';?>"></script>
	
   <!-- iCheck 1.0.1 -->
	<script src="<?php echo base_url().'assets/plugins/iCheck/icheck.min.js';?>"></script>

	<style>
    	.quick-link{
			margin:15px 0px 0px 0px; 	
		}
    </style>
  </head>
  <body class="skin-blue fixed sidebar-collapse">
    <div class="wrapper">
    <!-- ====================== MENU ATAS========================= -->
    <?php 
		$level = $this->session->userdata('level');
		//$this->load->view($level.'/top-menu2.php');
	?>
    <!-- //end menu atas-->
    <!-- ====================== MENU KIRI========================= -->
    <?php //$this->load->view($level.'/left-menu.php');?>
    <!-- //end menu kiri-->
    <!-- Full Width Column -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <ol class="breadcrumb">
          <li class="active"><a href="<?php echo base_url().$level.'/dashboard';?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">

        <?php $this->load->view($view);?>
        
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>KOmplain Online</b> 1.2
      </div>
      <strong>Copyright &copy; 2021 <a href="<?php echo base_url().$level.'dashboard';?>">Rajawali Hiyoto</a>.</strong> All rights reserved.
    </footer>

    </div>
    <script>
		$(function () {
			//Date range picker
			$('#estimasi').daterangepicker();
			//Date range picker with time picker
			$('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
			//Date range as a button
			$('#daterange-btn').daterangepicker(
					{
					  ranges: {
						'Today': [moment(), moment()],
						'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
						'Last 7 Days': [moment().subtract('days', 6), moment()],
						'Last 30 Days': [moment().subtract('days', 29), moment()],
						'This Month': [moment().startOf('month'), moment().endOf('month')],
						'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
					  },
					  startDate: moment().subtract('days', 29),
					  endDate: moment()
					},
				function (start, end) {
				  $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
				}
			);
			//Timepicker
			$(".mulai").timepicker({
			  showInputs: false
			});
			//Timepicker
			$(".selesai").timepicker({
			  showInputs: false
			});

		});
		// datepicker dalam textbox
		$(".dpTxt").datepicker({
			format: 'yyyy-mm-dd',
			autoclose: true,
			todayHighlight: true
		});


        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

				
		$(window).load(function() {
			$(".overlay").fadeOut("200");
		});
		
    </script>
    
    <script>
		$('.tultip').tooltip();
        $('#mytable').dataTable({
			responsive:true,
			paging: true,
			lengthChange: false,
			searching: true,
			ordering: true,
			info: true,
			autoWidth: false
		}); 
    </script>
	<script src="<?php echo base_url(); ?>assets/plugins/validation/bootstrapValidator.min.js"></script>
    <!--<script src="<?php echo base_url(); ?>assets/plugins/wysiwyg/summernote.min.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/plugins/validation/setting.js"></script>
  </body>
</html>                    