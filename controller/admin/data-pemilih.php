<!DOCTYPE html>
<html>
<head>
<?php
    include "../../api/config/database.php";
    include "../cek-admin.php";
?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Pemilihan Online</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <h2 class="text-dark">Data Pemilih</h2>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
        <div class="info">
        <a href="../logout.php" class="d-block"> <i class="fa fa-power-off"></i> Log out</a>
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
    <a href="#" class="brand-link">
      <img src="../../dist/img/ex-logo1.png" alt="eVoting Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
            </li>
          
          <li class="nav-item">
            <a href="data-pemilih.php" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Data Pemilih
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="data-calon.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Data Calon
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="rekapitulasi.php" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Rekapitulasi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Admin
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../logout.php" class="nav-link">
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
    <?php
    if(isset($_REQUEST['command'])) {
      
      if($_REQUEST['command']=='unlock' && isset($_REQUEST['nim'])){
        $nim = $_REQUEST['nim'];
        @mysqli_query($kon, "UPDATE pemilih set status ='1' where nim = '$nim'");
      } elseif($_REQUEST['command']=='lock' && isset($_REQUEST['nim'])){
        $nim = $_REQUEST['nim'];
        @mysqli_query($kon, "UPDATE pemilih set status ='0' where nim = '$nim'");
      }
    }
    ?>
    <script type="text/javascript">
    function unlock(nim){
      if(confirm('Ini akan membuka kunci suara pemilih. Sudah yakin?')){
        document.form1.command.value='unlock';
        document.form1.nim.value=nim;
        document.form1.submit();
      }
    }
    function lock(nim){
      if(confirm('Ini akan mengunci suara pemilih. Sudah yakin?')){
        document.form1.command.value='lock';
        document.form1.nim.value=nim;
        document.form1.submit();
      }
    }
  </script>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-6"></div>
              <div class="col-4">
              <form action="import-pemilih.php" method="post" enctype="multipart/form-data">
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Import Data Pemilih</label>
                  </div>
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-info"><i class="fa fa-upload"></i></button>
                    <button type="button" onClick="location.href='../../dist/import/formulir.xls';" class="btn btn-danger"><i class="fa fa-download"></i></button>
                  </div>
                  
                </div>
                </form>
              </div>
              <div class="col-2">
                <h3><button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#tambah-pemilih"><i class="fa fa-plus"></i> Tambah Pemilih</button></h3>
              </div>
            </div>
            <div class="card">

            <!-- HIDDEN FORM FOR UN/LOCK -->
            <form name="form1">
              <input type="hidden" name="command">
              <input type="hidden" name="nim">
            </form>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" style="display:none">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Password</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    require_once "../../api/config/database.php";
                    $query = mysqli_query($kon, "SELECT * FROM pemilih");
                    $i = 1;
                    while($hasil = mysqli_fetch_array($query)){
                  ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $hasil['nim']; ?></td>
                        <td><?php echo $hasil['nama']; ?></td>
                        <td><?php echo $hasil['kelas']; ?></td>
                        <td>
                          <div class="btn-group btn-group-sm">
                          <?php
                           $stat = $hasil['status'];
                           $nim = $hasil['nim'];
                            if($stat == 0){
                          ?>
                            <a href="javascript:unlock('<?php echo $nim; ?>')" class="btn btn-warning"><i class="fas fa-lock"></i></a>
                            <?php
                            } elseif ($stat == 1){
                            ?>	
                            <a href="javascript:lock('<?php echo $nim; ?>')" class="btn btn-success"><i class="fas fa-unlock"></i></a>
                            <?php
                                }
                            ?>
                            <a onClick="return confirm('Yakin menghapus pemilih ini?')" href="delete-pemilih.php?nim=<?php echo $hasil['nim']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                          </div>
                        </td>
                      </tr>
                    <?php $i++; } ?>
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
      <!-- modal area -->
      <div class="modal fade" id="tambah-pemilih">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Pemilih</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" action="tambah-pemilih.php" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="email">NIM:</label>
                    <input name="nim" class="form-control" id="nim" placeholder="Masukan NIM" autofocus required>
                </div>
                <div class="form-group">
                    <label for="email">Nama:</label>
                    <input name="nama" class="form-control" id="nama" placeholder="Masukan Nama" required>
                </div>
                <div class="form-group">
                    <label for="email">Kelas:</label>
                    <input name="kelas" class="form-control" id="kelas" placeholder="Masukan Kelas" required>
                </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-danger" >Reset</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
              </form>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /modal area -->
      
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
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "order": [[ 0, 'asc' ]],
    });
    setTimeout(function () { $("#example1").show() }, 50);
  });
</script>
</body>
</html>
