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
        <h2>Request List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Kategori</th>
		<th>Id Klasifikasi</th>
		<th>Idpengguna</th>
		<th>Request</th>
		<th>Deskripsi Request</th>
		<th>Baca Admin</th>
		<th>Baca Solver</th>
		<th>Sts Baca Admin</th>
		<th>Sts Baca Solver</th>
		<th>Sts Eksekusi</th>
		
            </tr><?php
            foreach ($request_data as $request)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $request->id_kategori ?></td>
		      <td><?php echo $request->id_klasifikasi ?></td>
		      <td><?php echo $request->idpengguna ?></td>
		      <td><?php echo $request->request ?></td>
		      <td><?php echo $request->deskripsi_request ?></td>
		      <td><?php echo $request->baca_admin ?></td>
		      <td><?php echo $request->baca_eksekutor ?></td>
		      <td><?php echo $request->sts_baca_admin ?></td>
		      <td><?php echo $request->sts_baca_eksekutor ?></td>
		      <td><?php echo $request->sts_eksekusi ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>