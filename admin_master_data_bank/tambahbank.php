<?php
session_start();
$konstruktor = 'admin_master_data_bank';
require_once '../database/config.php';
if ($_SESSION['status']!=1) {
  $usr = $_SESSION['username'];
  $waktu = date('Y-m-d H:i:s');
  $auth = $_SESSION['status'];
  $nama = $_SESSION['nama_user'];
  if ($auth==2) {
    $tersangka = "Operator";
  }
  
  $ket = "Pengguna dengan username ".$usr.", nama : ".$nama." melakukan cross authority dengan akses sebagai ".$tersangka;
  $querycrossauth = mysqli_query($con, "INSERT INTO tbl_cross_auth VALUES ('', '$usr', '$waktu', '$ket')") or die(mysqli_error($con));
  echo '<script>window.location="../login/logout.php"</script>';

}
else {
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
                  <li class="breadcrumb-item"><a href="#">Admin Dashboard</a></li>
                  <li class="breadcrumb-item active">Tambah Bank</li>
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
              <div class="col-lg-6">
                <!-- general form elements -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title"><i class="nav-icon fas fa-plus"></i> Tambah Bank</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="prosestambah.php" method="post">
                    <div class="card-body">
                      <a href="../admin_master_data_bank" class="btn btn-warning btn-sm"><i class="nav-icon fas fa-chevron-left"></i> Kembali</a>
                      <div class="form-group">
                        <label for="kode_bank">Kode Bank</label>
                        <input type="text" class="form-control" id="kode_bank" name="kode_bank" maxlength="50" onkeypress="return IsNumeric(event);" placeholder="Input kode bank" autofocus required>
                      </div>
                      <div class="form-group">
                        <label for="nama_bank">Nama Bank</label>
                        <input type="text" class="form-control" id="nama_bank" name="nama_bank" maxlength="150" placeholder="Input Nama Bank" required>
                      </div>
                      <div class="form-group">
                        <label for="norek">No Rekening</label>
                        <input type="norek" class="form-control" id="norek" name="norek" maxlength="50" placeholder="Input No. Rekening" onkeypress="return IsNumeric(event);" required>
                      </div>
                      <div class="form-group">
                        <label for="nasabah">Nasabah</label>
                        <input type="text" class="form-control" id="nasabah" name="nasabah" maxlength="15" placeholder="Input Nasabah" required>
                      </div>
                      <div class="form-group">
                        <label for="saldo_awal">Saldo Awal</label>
                        <input type="text" class="form-control" id="saldo_awal" name="saldo_awal" maxlength="15" placeholder="Input Saldo Awal" onkeypress="return IsNumeric(event);" required>
                      </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary btn-block" name="tambahbank"><i class="nav-icon fas fa-plus"></i> Tambah Data Bank</button>
                    </div>
                  </form>
                </div>
                <!-- /.card -->
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

</body>
</html>
