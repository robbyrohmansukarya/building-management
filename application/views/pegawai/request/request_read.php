<div class="box box-warning color-palette-box" style="margin-top:15px;">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-edit"></i> Detail Request</h3>
        <div class="box-tools pull-right">
			<?php echo anchor(site_url('pegawai/request'), '<< Kembali ', array('class'=>'text-warning tultip','title'=>'Kembali ke halaman sebelumnya')); ?>
        </div>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-striped display responsive nowrap" id="mytable" cellspacing="0" width="100%">
            <tbody>    
                <tr>
                    <td width="250">ID Request</td>
                    <td>: 
                    <?php 
                        echo $id_request;
                    ?>
                    </td>
                </tr>
                <tr>
                    <td width="250">Tanggal Request</td>
                    <td>: 
                    <?php 
                        echo $tanggal_request;
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td>: 
                    <?php 
                        $qkat = $this->db->query("select kategori from kategori_request where id_kategori='".$id_kategori."'")->row();
                        echo ucwords($qkat->kategori);
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>Request</td>
                    <td>: <?php echo ucfirst($request);?></td>
                </tr>
                <tr>
                    <td>Deskripsi Request</td><td>: <?php echo ucfirst($deskripsi_request); ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>: 
                    <?php 
                        $label='';$ico=''; 
                        if($sts_eksekusi == 0){
                            $label = 'label-warning';
                            $ico = '<i class="fa fa-clock-o"></i>';
                        }
                        else if($sts_eksekusi == 1){
                            $label = 'label-info';
                            $ico = '<i class="fa fa-wrench"></i>';
                        }
                        else if($sts_eksekusi == 2){
                            $label = 'label-success';
                            $ico = '<i class="fa fa-check-square"></i>';
                        }
                        else if($sts_eksekusi == 3){
                            $label = 'label-danger';
                            $ico = '<i class="fa fa-times"></i>';
                        }
                        else{
                            $label='';$ico='';
                        }
    
                        $qeksekusi = $this->db->query("select keterangan from sts_eksekusi where sts_eksekusi= '".$sts_eksekusi."'")->row();
                    ?>
                          <small class="label <?php echo $label;?>"><?php echo $ico.' '.ucwords($qeksekusi->keterangan);?></small>
                    </td>
                </tr>
                <tr>
                    <td>Foto</td>
                    <td>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <img src="<?php echo base_url().'assets/dist/img/request/'.($photo =='' ? 'no.jpg':$photo);?>" class="img-thumbnail  img-responsive" alt="User Image" />
                    </div>
                    </td>
                </tr>

            </tbody>
        </table>
        
                
    </div>
</div>