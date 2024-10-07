<?php
session_start();
$konstruktor = 'admin_master_biaya';
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
              <h1 class="m-0">Master Data Biaya</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Master Data Biaya</li>
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
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><i class="nav-icon fas fa-list"></i> Data Biaya Admin</h3>
                </div>
                <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th width="10%">No</th>
                        <th>Keterangan</th>
                        <th>Biaya</th>
                        <th><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=1;
                      $query_tr = mysqli_query($con, "SELECT * FROM tbl_admin") or die(mysqli_error($con));
                      $rv_tr = mysqli_num_rows($query_tr);
                      if($rv_tr>0) {
                        while ($dt_tr = mysqli_fetch_assoc($query_tr)) {
                          ?>
                          <tr>
                            <td><?=$no++;?></td>
                            <td><?=$dt_tr['ket'];?></td>
                            <td>Rp <?=number_format($dt_tr['bayar'],0,",",".")?>,-</td>
                            <td>
                              <center>
                                <button type="button" class="btn btn-sm btn-info btn-edit" data-toggle="modal" data-target="#modal-edit" data-ket="<?=$dt_tr['ket'];?>" data-bayar="<?=$dt_tr['bayar'];?>">
                                 <i class="nav-icon fas fa-edit"></i></button>
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

<div class="modal fade" id="modal-edit">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#001f3f;">
        <h4 class="modal-title"><font color="#ffffff"><i class="fas fa-file"></i> Edit Biaya Admin</font></h4>
      </div>
      <form id="modal-edit" action="prosesedit.php" method="POST">
        <div class="modal-body">
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <div class="form-group row">
                  <label for="data-ket" class="col-sm-12 control-label">Keterangan</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="ket" id="ket">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="data-bayar" class="col-sm-12 control-label">Biaya</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="bayar" id="bayar" onkeypress="return IsNumeric(event);">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" name="editbiaya" class="btn btn-primary">Simpan Perubahan</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript">
   $('#modal-edit').on('show.bs.modal', function(e) {

     var keterangan = $(e.relatedTarget).data('ket');
     var bayar = $(e.relatedTarget).data('bayar');


     $(e.currentTarget).find('input[name="ket"]').val(keterangan);
     $(e.currentTarget).find('input[name="bayar"]').val(bayar);  

   });
 </script>

</body>
</html>
