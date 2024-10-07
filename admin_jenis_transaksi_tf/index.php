<?php
session_start();
$konstruktor = 'admin_dashboard';
require_once '../database/config.php';
if ($_SESSION['status'] != 1) {
  $usr = $_SESSION['username'];
  $waktu = date('Y-m-d H:i:s');
  $auth = $_SESSION['status'];
  $nama = $_SESSION['nama_user'];
  if ($auth == 2) {
    $tersangka = "Operator";
  }

  $ket = "Pengguna dengan username " . $usr . ", nama : " . $nama . " melakukan cross authority dengan akses sebagai " . $tersangka;
  $querycrossauth = mysqli_query($con, "INSERT INTO tbl_cross_auth VALUES ('', '$usr', '$waktu', '$ket')") or die(mysqli_error($con));
  echo '<script>window.location="../login/logout.php"</script>';
} else {
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPETE | Administrator</title>
    <?php
    include '../listlink.php';
    ?>
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="../images/UP.png" alt="Monev-Skripsi" height="60" width="60">
      </div>

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <?php
        include '../navbar.php';
        ?>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="../images/profile.png" alt="Monev-Skripsi" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">SIPETE</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <?php
            include '../admin_sidebar.php';
            ?>
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
              <div class="col-sm-6">
                <h1 class="m-0">Dashboard Administrator</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>BCA</h3>

                    <p>Informasi Saldo :</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">Tambah Saldo <i class="fas fa-plus"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>BRI</h3>

                    <p>Informasi Saldo :</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">Tambah Saldo <i class="fas fa-plus"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>MANDIRI</h3>

                    <p>Informasi Saldo :</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="#" class="small-box-footer">Tambah Saldo <i class="fas fa-plus"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>BNI</h3>

                    <p>Informasi Saldo :</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">Tambah Saldo <i class="fas fa-plus"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3>SYARIAH</h3>

                    <p>Informasi Saldo :</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">Tambah Saldo <i class="fas fa-plus"></i></a>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white">
                  <div class="inner">
                    <h3>SALDO CASH</h3>

                    <p>Informasi Saldo :</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">Tambah Saldo <i class="fas fa-plus"></i></a>
                </div>
              </div>
            </div>
            <!-- /.row (main row) -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <?php
      include '../footer.php';
      ?>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <?php
    include '../script.php';
  }
  ?>

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">TRANSFER</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php
        // $kode_bank = @$_GET['kode_bank'];
        ?>
        <form id="modal-default" action="proses.php" method="POST">
          <div class="modal-body">
            <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="card card-info">
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                  <div class="row">
                    
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <label for="tanggal" class="col-sm-12 control-label">Tanggal</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" name="tanggal" id="tanggal">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nama_pelanggan" class="col-sm-12 control-label">Nama Pelanggan</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="jenis_transaksi" class="col-sm-12 control-label">jenis Transaksi</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="jenis_transaksi" id="jenis_transaksi">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tujuan" class="col-sm-12 control-label">Tujuan</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="tujuan" id="tujuan" onkeypress="return IsNumeric(event);">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="jumlah" class="col-sm-12 control-label">Jumlah</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="jumlah" id="jumlah" onkeypress="return IsNumeric(event);">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" name="transfer" class="btn btn-primary">Simpan</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      $(window).on('load', function(){
        $('#modal-default').modal('show');
        var tanggal = $(e.relatedTarget).data('tanggal');
        var nama_pelanggan = $(e.relatedTarget).data('nama_pelanggan');
        var jenis_transaksi = $(e.relatedTarget).data('jenis_transaksi');
        var tujuan = $(e.relatedTarget).data('tujuan');
        var jumlah = $(e.relatedTarget).data('jumlah');

        $(e.currentTarget).find('input[name="tanggal"]').val(tanggal);
        $(e.currentTarget).find('input[name="nama_pelanggan"]').val(nama_pelanggan);
        $(e.currentTarget).find('input[name="jenis_transaksi"]').val(jenis_transaksi);
        $(e.currentTarget).find('input[name="tujuan"]').val(tujuan);
        $(e.currentTarget).find('input[name="jumlah"]').val(jumlah);  
      });
    </script>

  </body>

  </html>