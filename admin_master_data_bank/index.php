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
              <h1 class="m-0">Master Data Bank</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Master Data Bank</li>
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
            <div class="col-lg-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><i class="nav-icon fas fa-list"></i> Data Bank</h3>
                </div>
                <div class="card-body">
                  <a href="tambahbank.php" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-download"></i> Tambah Bank</a>
                  <!-- <a href="proses.php?reset=reset_data" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan mereset data ini?')"><i class="nav-icon fas fa-sync"></i> Reset Data</a> -->
                  <br>
                  <br>
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th width="5%">No</th>
                        <th>Bank</th>
                        <th>Atas Nama</th>
                        <th>Saldo Awal</th>
                        <th>Saldo Akhir</th>
                        <th><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=1;
                      // $kode_bank = @$_SESSION['kode_bank'];
                      $query_bank = mysqli_query($con, "SELECT * FROM tbl_data_bank") or die(mysqli_error($con));
                      $rv_data_bank = mysqli_num_rows($query_bank);
                      if($rv_data_bank>0) {
                        while ($dt_bank = mysqli_fetch_assoc($query_bank)) {
                          ?>
                          <tr>
                            <td><?=$no++;?></td>
                            <td><?=$dt_bank['kode_bank'];?> - <?=$dt_bank['nama_bank'];?>
                                <br>Norek : <b><?=$dt_bank['no_rekening'];?></b>
                            </td>
                            <td><?=$dt_bank['atas_nama'];?></td>
                            <td>Rp. <?= number_format($dt_bank['saldo_awal'],0,",",".")?> ,-</td>
                            <td>Rp. <?= number_format($dt_bank['saldo_akhir'],0,",",".")?> ,-</td>
                            <td>
                              <center>
                                 <a href="detail_saldo_tambah.php?kode_bank=<?=$dt_bank['kode_bank'];?>" class="btn btn-sm btn-success"> <i class="nav-icon fas fa-hand-holding-usd"></i></a>
                                <a href="delete_bank.php?kode_bank=<?=$dt_bank['kode_bank'];?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda akan menghapus data bank dengan kode [<?=$dt_bank['kode_bank'];?>] - Bank : [<?=$dt_bank['nama_bank'];?>]')">
                                  <i class="nav-icon fas fa-trash"></i></a>
                                </center>
                              </td>
                            </tr>
                            <?php
                          }
                        }
                        else {
                          ?>
                          <tr>
                            <td colspan="9">Tidak ditemukan data angkatan pada database</td>
                          </tr>
                          <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
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

  </body>
  </html>
