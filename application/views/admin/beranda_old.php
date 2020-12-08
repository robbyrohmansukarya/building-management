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
          <i class="fa fa-edit"></i>
        </div>
      </div>
    </div><!-- ./col -->
</div><!--//end row-->


<div class="row" style="margin-top:15px">
    <div class="col-md-12" style="padding:0px">
        <div class="col-md-6">
            <!-- TO DO List -->
            <div class="box box-primary" style="min-height:385px">
            <div class="box-header">
              <i class="fa fa-edit"></i>
              <h3 class="box-title">Request</h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">

            <table class="table table-bordered display responsive nowrap" id="" cellspacing="0" width="100%">
                <thead class="bg-default">
                    <tr>
                        <th width="20">No</th>
                        <th width=""><i class="fa fa-user"></i> Pegawai</th>
                        <th><i class="fa fa-envelope-o"></i> Request</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $start = 0;
                    $qr = $this->db->query("select * from request order by id_request desc limit 0,5")->result();
                    foreach ($qr as $qrs)
                    {
                    ?>
                    <tr>
                        <td><?php echo ++$start;?></td>
                        <td>
                        <?php
                            $qpegawai = $this->db->query("select * from pegawai where idpengguna='".$qrs->idpengguna."'");
                            $cekPegawai = $qpegawai->num_rows();
                            if($qpegawai->num_rows() > 0){
                                $pegawai = $qpegawai->row();
           							echo ucwords($pegawai->nama_lengkap);
                            }
                            else{
                                echo 'Pegawai Tidak Terdaftar';
                            }
                        ?>
                        </td>
                        <td>
						<?php 
							$kategori = $this->Request_model->get_kategori($qrs->id_kategori)->row();
							echo $kategori->kategori;
						?>
                        </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>

            </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col (LEFT)col-md-6 -->
        
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-bar-chart-o" aria-hidden="true"></i> Request Per Kategori</h3>
                </div>
                <div class="box-body">
				<?php
                    
                    $kr01 = $this->db->query("select id_kategori FROM request where id_kategori='KR01'")->num_rows();
                    $kr02 = $this->db->query("select id_kategori FROM request where id_kategori='KR02'")->num_rows();
                    $kr03 = $this->db->query("select id_kategori FROM request where id_kategori='KR03'")->num_rows();
                ?>
                    <table style="position:absolute;top:50px;right:30px;;font-size:smaller;color:#545454">
                        <tbody>
                            <tr>
                                <td class="legendColorBox"><div style="padding:5px"><div style="width:4px;height:0;border:5px solid #f56954;overflow:hidden"></div></div></td><td class="legendLabel"> <?php echo $kr01; ?> Perbaikan</td>
                            </tr>
                            <tr>
                                <td class="legendColorBox"><div style="padding:5px"><div style="width:4px;height:0;border:5px solid #00c0ef;overflow:hidden"></div></div></td><td class="legendLabel"><?php echo $kr02; ?> Permintaan</td>
                            </tr>
                            <tr>
                                <td class="legendColorBox"><div style="padding:5px"><div style="width:4px;height:0;border:5px solid #FFFF00;overflow:hidden"></div></div></td><td class="legendLabel"><?php echo $kr03; ?> Penyedia Ruangan</td>
                            </tr>
                        </tbody>
                    </table>                
                  <div id="donut-chart" style="height: 300px;"></div>

                </div><!-- /.box-body-->
                <div class="box-footer clearfix no-border"></div>
            </div><!-- /.box -->
        </div><!-- /.col (RIGHT)col-md-6 -->
    </div>
</div>
<!-- FLOT CHARTS -->
<script src="<?php echo base_url().'assets/plugins/flot/jquery.flot.min.js';?>" type="text/javascript"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?php echo base_url().'assets/plugins/flot/jquery.flot.resize.min.js';?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/plugins/flot/jquery.flot.pie.min.js';?>" type="text/javascript"></script>
 <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="<?php echo base_url().'assets/plugins/flot/jquery.flot.categories.min.js';?>" type="text/javascript"></script>
<script type="text/javascript">

      $(function () {
        var donutData = [
          {label: "Perbaikan", data: <?php echo $kr01;?>, color: "#f56954"},
          {label: "Permintaan", data: <?php echo $kr02;?>, color: "#00c0ef"},
          {label: "Penyedia", data: <?php echo $kr03;?>, color: "#FFFF00"}
        ];
        $.plot("#donut-chart", donutData, {
          series: {
            pie: {
              show: true,
              radius: 1,
              innerRadius: 0.5,
              label: {
                show: true,
                radius: 2 / 3,
                //formatter: labelFormatter,
                threshold: 0.1
              }

            }
          },
          legend: {
            show: false
          }
        });
        /*
         * END DONUT CHART
         */

      });

      /*
       * Custom Label formatter
       * ----------------------
       */
      function labelFormatter(label, series) {
        return "<div style='font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>"
                + label
                + "<br/>"
                + Math.round(series.percent) + "</div>";
      }
    </script>  