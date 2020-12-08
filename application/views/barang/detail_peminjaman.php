<?php
    $sukses = $this->uri->segment(5);
    if(($sukses =='success')){
    ?>
    <div class="alert alert-success alert-dismissable" style="margin-top:15px">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-thumbs-up"></i> OK !</h4>
        Request permintaan peminjaman barang berhasil diverifikasi
    </div>      
    <?php
    }
?>

<div class="row">
    <div style="margin-left:30px; z-index:1000;position:absolute">
        <img src="<?php echo base_url();?>assets/dist/img/help/user.png" class="" alt="" />
    </div>
    <div class="callout callout-warning" style="margin:15px 15px 15px 100px;">											
      <h4><i class="fa fa-arrow-circle-right"></i> Hii, I'm Is Your Help Deks ... </h4>
    
      Hallo Operator, Saat ini anda sedang melihat detail peminjaman barang. Pada konten ini anda dapat memperbaharui status verifikasi dan Jika di Ijinkan Anda bisa mencetak bukti pengambilan barang. <br> 
      Salam & Terimakasih
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-xs-12">
        <div class="box box-info color-palette-box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-info-circle"></i> Detail Info</h3>
            </div>
            <div class="box-body">
                <table class="table" id="" cellspacing="0" width="100%">
                    <tbody>
                        <tr>
                            <td width="150"><i class="fa fa-user"></i> User Request</td>
                            <td width="2">:</td>
                            <td>
                            <?php
                                $qpegawai = $this->db->query("select * from pegawai where idpengguna='".$info->idpengguna."'");
                                $cekPegawai = $qpegawai->num_rows();
                                if($qpegawai->num_rows() > 0){
                                    $pegawai = $qpegawai->row();
                                    $jabatan = $pegawai->jabatan;
                                    echo ucwords($pegawai->nama_lengkap).' / '.$jabatan;
                                }
                                else{
                                    $jabatan = '';
                                    echo 'Pegawai Tidak Terdaftar';
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="150"><i class="fa fa-calendar"></i> Tanggal Pinjam</td>
                            <td width="2">:</td>
                            <td>
                            <?php 
                                $tanggal_peminjaman    = $this->tanggal->konversi($info->tanggal_peminjaman);
                                echo $tanggal_peminjaman;
                            ?>                
                            </td>
                        </tr>
                        <tr>
                            <td width="150"><i class="fa fa-calendar-o"></i> Tanggal Kembali</td>
                            <td width="2">:</td>
                            <td>
                            <?php 
                                $tanggal_pengembalian    = $this->tanggal->konversi($info->tanggal_pengembalian);
                                echo $tanggal_pengembalian;
                            ?>                
                            </td>
                        </tr>
                        <tr>
                            <td width="150"><i class="fa fa-retweet"></i> Status Verifikasi</td>
                            <td width="2">:</td>
                            <td>
                            <?php 
                                if($info->verifikasi==1){
                                    $sts = '<span class="label label-info">Dipinjamkan</span>';
                                }
                                else if($info->verifikasi==2){
                                    $sts = '<span class="label label-success">Diambil</span>';
                                }
                                else{
                                    $sts = '<span class="label label-warning">Menunggu</span>';
                                }
                                echo $sts;
                            ?>                
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                            <div class="pull-right">
                            <?php 
								echo anchor(site_url('admin/barang/cetak/'.$id_request.'/cetak-bukti-pengambilan'), '<i class="fa fa-print" aria-hidden="true"></i> Cetak Bukti Pengambilan Barang', array('class'=>'tultip','title'=>'Cetak Faktur Pengambilan', 'target'=>'_blank'));
                            ?>
                            </div>                
                            </td>
                        </tr>
                    </tbody>
                </table>
        
            </div>
        </div>
    </div><!--//col-md-6 col-xs-12 -->    
    
    <div class="col-md-6 col-xs-12">
        <div class="box box-warning color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>             
                <div class="box-tools pull-right"> 
                    <?php echo form_open($action, array('role'=>'form', 'id'=>'validForm'));?>
                        <div class="form-group" style="padding-left:100px;">
                            <div class="input-group input-group-sm">
                                <select class="form-control" name="verifikasi" required data-bv-trigger="blur" 
                                data-bv-notempty-message="<i class='fa fa-times-circle'></i> Silahkan pilih verifikasi peminjaman">
                                    <option value="">--Verifikasi Peminjaman--</option>
                                    <option value="0">Menuggu</option>
                                    <option value="1">Dipinjamkan</option>
                                    <option value="2">Diambil</option>
                                </select>       
                                <span class="input-group-btn">
                                  <button class="btn btn-info btn-flat" type="submit"><i class="fa fa-retweet"></i> Update </button>
                                </span>
                            </div><!-- /input-group --> 
                        </div>              
                    <?php echo form_close();?>
                </div>
        
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped display responsive nowrap" id="" cellspacing="0" width="100%">
                    <thead class="bg-default">
                        <tr>
                            <th width="30">No</th>
                            <th width="150">Kode Barang</th>
                            <th>Nama Barang</th>
                            <th width="150" style="text-align: center;">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $start = 0;
                    foreach ($pinjam_data as $row)
                    {
                        if($row->verifikasi==1){
                            $sts = '<span class="label label-info">Dipinjamkan</span>';
                        }
                        else if($row->verifikasi==2){
                            $sts = '<span class="label label-success">Dikembalikan</span>';
                        }
                        else{
                            $sts = '<span class="label label-warning">Menunggu</span>';
                        }
        
                    ?>
                        <tr>
                            <td><?php echo ++$start;?></td>
                            <td><?php echo $row->kode_barang;?></td>
                            <td><?php echo ucwords($row->nama_barang); ?></td>
                            <td style="text-align: center;"><?php echo $row->qty; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>    
    </div><!--//col-md-6 col-xs-12 -->    
</div><!--//row -->
