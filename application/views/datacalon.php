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
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">

  <?php

  $login = $this->session->userdata('status');
  if ($login == 'loginadmin') {
  } else if ($login == 'loginpengawas') {
    redirect(base_url('?pesan=salah'));
  } else if ($login == 'loginsiswa') {
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
          <h2 class="text-dark">Data Calon</h2>
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
              <a href="Datacal" class="nav-link active">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Data Calon
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="Hasilpilih" class="nav-link">
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
              <a href="" data-toggle="modal" data-target="#konfirmkeluar" class="nav-link">
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
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">

          </div>
        </div><!-- /.container-fluid -->
      </section>

      <?php if ($this->session->flashdata('success_msg')) {

      ?>
        <div class="alert alert-success">
          <center>
            <?= $this->session->flashdata('success_msg'); ?>
          </center>
        </div>
      <?php
      } ?>
      <?php if ($this->session->flashdata('error_msg')) {

      ?>
        <div class="alert alert-danger">
          <center>
            <?= $this->session->flashdata('error_msg'); ?>
          </center>
        </div>
      <?php
      } ?>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="row">
                <div class="col-10"></div>
                <div class="col-2">
                  <h3><button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#tambahdata"><i class="fa fa-plus"></i> Tambah Calon</button></h3>
                </div>
              </div>
              <div class="card">

                <hr>

                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nomor Urut</th>
                        <th>Presiden</th>
                        <th>Wakil </th>
                        <th>Visi</th>
                        <th>Misi</th>
                        <th>Foto</th>
                        <th>Vote</th>
                        <th>Aksi</th>
                        <!-- <th width="150"><button class="btn btn-danger" data-toggle="modal" data-target="#truncate" >Kosongkan</button></th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                      foreach ($data->result_array() as $i) :
                        $id = $i['id'];
                        $nomorurut = $i['nomorurut'];
                        $nama1 = $i['nama1'];
                        $nama2 = $i['nama2'];
                        $visi = $i['visi'];
                        $misi = $i['misi'];
                        $foto = $i['foto'];
                        $vote = $i['vote'];
                      ?>
                        <tr>
                          <td><?= "$no" ?></td>
                          <td>0<?= $nomorurut; ?></td>
                          <td><?= $nama1; ?></td>
                          <td><?= $nama2; ?></td>
                          <td><?= $visi; ?> </td>
                          <td><?= $misi; ?> </td>
                          <td><img src="<?= base_url('upload/' . $foto) ?>" width="64"> </td>
                          <td><?= $vote; ?> </td>
                          <td>
                            <a class="btn btn-primary" data-toggle="modal" data-target="#editdata<?= $id; ?>" href=""><i class="fas fa-edit"></i></a>

                            <a class="btn btn-danger" href="<?= 'datacal/delete/' . $id = $i['id']; ?>" onclick="return confirm('Yakin ingin menghapus nomor urut <?= $nomorurut; ?>?');"><i class="fa fa-trash"></i></a>

                          </td>
                        </tr>
                      <?php $no++;
                      endforeach; ?>

                    </tbody>

                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

        <!-- modal tambah -->
        <div class="modal fade" id="tambahdata">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Calon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?= form_open_multipart('datacal/insert'); ?>
                <form action="datacal/insert" method="post">
                  <div class="row form-group">
                    <div class="col col-md-3"><label for="nomorurut" class=" form-control-label">Nomor Urut</label></div>
                    <div class="col-12 col-md-9">
                      <input type="number" id="nomorurut" name="nomorurut" placeholder="Nomor Urut" class="form-control" required min="1">
                    </div>
                  </div>

                  <div class="row form-group">
                    <div class="col col-md-3"><label for="nama1" class=" form-control-label">Presiden BEM</label></div>
                    <div class="col-12 col-md-9">
                      <input type="text" id="nama1" name="nama1" placeholder="Nama Presiden" class="form-control" required>
                    </div>
                  </div>

                  <div class="row form-group">
                    <div class="col col-md-3"><label for="nama2" class=" form-control-label">Wakil Presiden BEM</label></div>
                    <div class="col-12 col-md-9">
                      <input type="text" id="nama2" name="nama2" placeholder="Nama Wakil Presiden" class="form-control" required>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Visi</label></div>
                    <div class="col-12 col-md-9">
                      <textarea class="form-control" name="visi" required></textarea>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Misi</label></div>
                    <div class="col-12 col-md-9">
                      <textarea class="form-control" name="misi" required></textarea></div>
                  </div>
                  <div class="form-group">
                    <label for="upfoto">Foto</label>
                    <input class="form-control-file" type="file" name="upfoto" id="upfoto" required>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /modal tambah -->

        <!-- modal Edit -->
        <?php
        foreach ($data->result_array() as $i) :
          $id = $i['id'];
          $nomorurut = $i['nomorurut'];
          $nama1 = $i['nama1'];
          $nama2 = $i['nama2'];
          $visi = $i['visi'];
          $misi = $i['misi'];
          $foto = $i['foto'];
          $vote = $i['vote'];
        ?>

          <div class="modal fade" id="editdata<?= $id; ?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Calon</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <?= form_open_multipart('datacal/edit/' . $id); ?>
                  <form action="<?= site_url('datacal/edit/' . $id); ?>" method="post">
                    <div class="row form-group">
                      <div class="col col-md-3"><label for="nomorurut" class=" form-control-label">Nomor Urut</label></div>
                      <div class="col-12 col-md-9">
                        <input type="number" id="nomorurut" name="nomorurut" placeholder="Nomor Urut" class="form-control" value="<?= $nomorurut; ?>">
                      </div>
                    </div>

                    <div class="row form-group">
                      <div class="col col-md-3"><label for="nama1" class=" form-control-label">Presiden BEM</label></div>
                      <div class="col-12 col-md-9">
                        <input type="text" id="nama1" name="nama1" placeholder="Nama Presiden" class="form-control" value="<?= $nama1; ?>">
                      </div>
                    </div>

                    <div class="row form-group">
                      <div class="col col-md-3"><label for="nama2" class=" form-control-label">Wakil Presiden BEM</label></div>
                      <div class="col-12 col-md-9">
                        <input type="text" id="nama2" name="nama2" placeholder="Nama Wakil Presiden" class="form-control" value="<?= $nama2; ?>">
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Visi</label></div>
                      <div class="col-12 col-md-9">
                        <textarea class="form-control" name="visi"><?= $visi; ?></textarea>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Misi</label></div>
                      <div class="col-12 col-md-9">
                        <textarea class="form-control" name="misi"><?= $misi; ?></textarea></div>
                    </div>
                    <div class="form-group">
                      <label for="upfoto">Foto</label>
                      <img src="<?= base_url('upload/' . $foto) ?>" width="40"> <br>
                      <input class="form-control-file" type="file" name="upfoto" id="upfoto" />
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="reset" class="btn btn-danger">Reset</button>
                  <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
        <?php endforeach; ?>
        <!-- /modal Edit -->


        <!--Modal Keluar -->
        <div class="modal fade" id="konfirmkeluar" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel">Apakah anda yakin ingin keluar?</h5>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <form action="<?= base_url('index.php/Welcome/logout'); ?>">
                  <input type="submit" class="btn btn-primary" value="Ya">
                </form>
              </div>
            </div>
          </div>
        </div>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.0.5
      </div>
      <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
      reserved.
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
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables -->
  <script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
  <!-- page script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>

</html>