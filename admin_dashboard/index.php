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
                    <?php
                    $pgl_saldoakhir = mysqli_query($con, "SELECT saldo_akhir FROM tbl_data_bank WHERE kode_bank=112");
                    $arrsaldo = mysqli_fetch_assoc($pgl_saldoakhir);
                    $saldo_akhir = $arrsaldo['saldo_akhir'];
                    ?>
                    <h3>BCA</h3>

                    <p>Informasi Saldo : Rp <?=number_format($saldo_akhir,0,",",".")?>,-</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-happy-outline"></i>
                  </div>
                  <button class="small-box-footer btn-block btn-light" data-toggle="modal" data-target="#modal-tambah" data-kode-bank="112">Tambah Saldo <i class="fas fa-plus"></i></button>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <?php
                    $pgl_saldoakhir = mysqli_query($con, "SELECT saldo_akhir FROM tbl_data_bank WHERE kode_bank=111");
                    $arrsaldo = mysqli_fetch_assoc($pgl_saldoakhir);
                    $saldo_akhir = $arrsaldo['saldo_akhir'];
                    ?>
                    <h3>BRI</h3>

                    <p>Informasi Saldo : Rp <?=number_format($saldo_akhir,0,",",".")?>,-</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-happy-outline"></i>
                  </div>
                  <button class="small-box-footer btn-block btn-light" data-toggle="modal" data-target="#modal-tambah" data-kode-bank="111">Tambah Saldo <i class="fas fa-plus"></i></button>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <?php
                    $pgl_saldoakhir = mysqli_query($con, "SELECT saldo_akhir FROM tbl_data_bank WHERE kode_bank=113");
                    $arrsaldo = mysqli_fetch_assoc($pgl_saldoakhir);
                    $saldo_akhir = $arrsaldo['saldo_akhir'];
                    ?>
                    <h3>MANDIRI</h3>

                    <p>Informasi Saldo : Rp <?=number_format($saldo_akhir,0,",",".")?>,-</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-happy-outline"></i>
                  </div>
                  <button class="small-box-footer btn-block btn-light" data-toggle="modal" data-target="#modal-tambah" data-kode-bank="113">Tambah Saldo <i class="fas fa-plus"></i></button>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <?php
                    $pgl_saldoakhir = mysqli_query($con, "SELECT saldo_akhir FROM tbl_data_bank WHERE kode_bank=115");
                    $arrsaldo = mysqli_fetch_assoc($pgl_saldoakhir);
                    $saldo_akhir = $arrsaldo['saldo_akhir'];
                    ?>
                    <h3>BNI</h3>

                    <p>Informasi Saldo : Rp <?=number_format($saldo_akhir,0,",",".")?>,-</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-happy-outline"></i>
                  </div>
                  <button class="small-box-footer btn-block btn-light" data-toggle="modal" data-target="#modal-tambah" data-kode-bank="115">Tambah Saldo <i class="fas fa-plus"></i></button>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <?php
                    $pgl_saldoakhir = mysqli_query($con, "SELECT saldo_akhir FROM tbl_data_bank WHERE kode_bank=114");
                    $arrsaldo = mysqli_fetch_assoc($pgl_saldoakhir);
                    $saldo_akhir = $arrsaldo['saldo_akhir'];
                    ?>
                    <h3>SYARIAH</h3>

                    <p>Informasi Saldo : Rp <?=number_format($saldo_akhir,0,",",".")?>,-</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-happy-outline"></i>
                  </div>
                  <button class="small-box-footer btn-block btn-light" data-toggle="modal" data-target="#modal-tambah" data-kode-bank="114">Tambah Saldo <i class="fas fa-plus"></i></button>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white">
                  <div class="inner">
                    <?php
                    $pgl_saldoakhir = mysqli_query($con, "SELECT saldo_akhir FROM tbl_data_bank WHERE kode_bank=1");
                    $arrsaldo = mysqli_fetch_assoc($pgl_saldoakhir);
                    $saldo_akhir = $arrsaldo['saldo_akhir'];
                    ?>
                    <h3>SALDO CASH</h3>

                    <p>Informasi Saldo : Rp <?=number_format($saldo_akhir,0,",",".")?>,-</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-happy-outline"></i>
                  </div>
                  <button class="small-box-footer btn-block btn-light" data-toggle="modal" data-target="#modal-tambah" data-kode-bank="1">Tambah Saldo <i class="fas fa-plus"></i></button>
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
  <!-- MODAL TAMBAH -->
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#001f3f;">
          <h4 class="modal-title"><font color="#ffffff"><i class="fas fa-file"></i> Tambah Saldo</font></h4>
        </div>
        <?php
        // $kode_bank = @$_GET['kode_bank'];
        ?>
        <form id="modal-tambah" action="proses.php" method="POST">
          <div class="modal-body">
            <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="card card-info">
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                  <div class="form-group row">
                    <label for="data-tanggal" class="col-sm-12 control-label">Tanggal Setor</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" name="tanggal" id="tanggal" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="data-jumlah" class="col-sm-12 control-label">Tambah Saldo</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="saldo_tambah" id="saldo_tambah" onkeypress="return IsNumeric(event);">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" name="tambahsaldo" class="btn btn-primary">Simpan</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $('#modal-tambah').on('show.bs.modal', function(e) {
        var kode_bank = $(e.relatedTarget).data('kode-bank');
        
        // Set the current date to the input field when modal is opened
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;
        $('#tanggal').val(today); // Set today's date

        $(e.currentTarget).find('form').attr('action', 'proses.php?kode_bank=' + kode_bank);
      });

      function IsNumeric(e) {
        var keyCode = (e.which) ? e.which : e.keyCode;
        if (keyCode > 31 && (keyCode < 48 || keyCode > 57)) return false;
        return true;
      }
    </script>
</body>

</html>