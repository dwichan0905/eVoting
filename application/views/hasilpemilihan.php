<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Pemilihan Online</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <?php

  $login = $this->session->userdata('status');
  if ($login == 'loginadmin') {
  } else if ($login == 'loginsiswa') {
    redirect(base_url('?pesan=salah'));
  } else if ($login == 'loginpengawas') {
    redirect(base_url('?pesan=salah'));
  } else {
    redirect(base_url('?pesan=belumlogin'));
  }

  ?>
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
          <h2 class="text-dark">Rekapitulasi</h2>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <div class="info">
            <a href="" data-toggle="modal" data-target="#konfirmkeluar" class="d-block"> <i class="fa fa-power-off"></i> Log out</a>
          </div>

          <!-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a> -->
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="Dasbor" class="brand-link">
        <img src="<?= base_url() ?>assets/dist/img/ex-logo1.png" alt="eVoting Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Voting</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="Dasbor" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="Datapem" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Data Pemilih
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="Datacal" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Data Calon
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="Hasilpilih" class="nav-link active">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Rekapitulasi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="Datapeng" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Admin
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#konfirmkeluar" data-toggle="modal" class="nav-link">
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>


          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">


          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <a class="btn btn-success" href="<?php echo base_url('Hasilpilih/export'); ?>"><i class="fa fa-print">
            </i> Cetak</a>

          <?php $nototal = 0;
          $belummemilih = 0;
          $sudahmemilih = 0;
          $sudahaktivasi = 0;
          $belumaktivasi = 0;
          $sudahaktivasibelummilih = 0;
          foreach ($datapemilih->result_array() as $j) :
            $id = $j['id'];
            $suara = $j['suara'];
            $aktivasi = $j['aktivasi'];
            if ($suara != 0) {
              $sudahmemilih++;
            }
            if ($suara == 0) {
              $belummemilih++;
            }
            if ($aktivasi != 0) {
              $sudahaktivasi++;
            }
            if ($aktivasi == 0) {
              $belumaktivasi++;
            }
            if ($suara == 0 && $aktivasi != 0) {
              $sudahaktivasibelummilih++;
            };
            $nototal++;
          endforeach;

          ?>
          <hr>
          <div class="container">
            <div class="row">
              <div class="col-4"> Jumlah Pemilih : <?php echo $nototal; ?> <br> Sudah aktivasi belum memilih : <?php echo $sudahaktivasibelummilih; ?> </div>
              <div class="col-4 text-center"> Sudah Memilih : <?php echo $sudahmemilih; ?><br>Sudah Aktivasi : <?php echo $sudahaktivasi; ?></div>
              <div class="col-4 text-right"> Belum Memilih : <?php echo $belummemilih; ?><br>Belum Aktivasi : <?php echo $belumaktivasi; ?></div>
            </div>
          </div>
          <hr>

          <div class="row">

            <?php $no = 1;
            foreach ($data->result_array() as $i) :
              $id = $i['id'];
              $nama1 = $i['nama1'];
              $nama2 = $i['nama2'];
              $visi = $i['visi'];
              $misi = $i['misi'];
              $foto = $i['foto'];
              $vote = $i['vote'];
            ?>
              <div class="col-md-4">
                <aside class="profile-nav alt">
                  <section class="card">
                    <div class="card-header user-header alt bg-dark">
                      <div class="media">
                        <a href="#">
                          <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="<?php echo base_url('upload/' . $foto) ?>">
                        </a>
                        <div class="media-body">
                          <h2 class="text-light display-6"><?php echo $nama1; ?> &</h2>
                          <h2 class="text-light display-6"><?php echo $nama2; ?></h2>
                          <p>Calon No <?php echo $no; ?></p>
                        </div>
                      </div>
                    </div>


                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">
                        <center>
                          <h1><br><?php echo $vote; ?> Suara</h1>
                          <h3><?php $persen = ($vote / $nototal) * 100;
                              echo $persen; ?> %</h3>
                          <br><br>
                        </center>
                      </li>
                    </ul>
                  </section>
                </aside>
              </div>


            <?php $no++;
            endforeach; ?>
          </div>

        </div> <!-- .content -->
        <div class="clearfix"></div>
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!--Modal Keluar -->
  <div class="modal fade" id="konfirmkeluar" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticModalLabel">Apakah anda yakin ingin keluar?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
          <form action="<?php echo base_url('index.php/Welcome/logout'); ?>">
            <input type="submit" class="btn btn-primary" value="Ya">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!--Modal Grafik -->
  <div class="modal fade" id="lihatgrafik" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="largeModalLabel">
            <center>Rekapitulasi</center>
          </h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                  <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                  </div>
                  <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                  </div>
                </div>
                <h4 class="mb-3"> </h4>
                <canvas id="doughutChart" height="300" width="601" class="chartjs-render-monitor" style="display: block; width: 601px; height: 300px;"></canvas>
              </div>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>
  </div>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?= base_url() ?>assets/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?= base_url() ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url() ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url() ?>assets/plugins/moment/moment.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?= base_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?= base_url() ?>assets/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
</body>

</html>
<script>
  $(function() {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = {
      labels: [
        'Suara Masuk',
        'Suara Belum Digunakan',
      ],
      datasets: [{
        data: [75, 55],
        backgroundColor: ['#00a65a', '#eeeeee'],
      }]
    }
    var pieOptions = {
      maintainAspectRatio: false,
      responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })


  })
</script>