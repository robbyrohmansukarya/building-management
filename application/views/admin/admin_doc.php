<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Admin List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Lengkap</th>
		<th>Alamat</th>
		<th>No Telp</th>
		<th>Photo</th>
		
            </tr><?php
            foreach ($admin_data as $admin)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $admin->nama_lengkap ?></td>
		      <td><?php echo $admin->alamat ?></td>
		      <td><?php echo $admin->no_telp ?></td>
		      <td><?php echo $admin->photo ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>