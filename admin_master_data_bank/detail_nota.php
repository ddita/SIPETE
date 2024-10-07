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
                <li class="breadcrumb-item active">Detail Nota</li>
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
                  <h3 class="card-title"><i class="nav-icon fas fa-list"></i> Detail Nota</h3>
                </div>
                <div class="card-body">
                  <a href="tambahsaldo.php" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-download"></i> Tambah Saldo</a>
                  <a href="proses.php?reset=reset_data" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan mereset data ini?')"><i class="nav-icon fas fa-sync"></i> Reset Data</a>
                  <br>
                  <br>
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th width="10%">No</th>
                        <th>Kode Bank</th>
                        <th>Tanggal Setor</th>
                        <th>Jumlah Tambah</th>
                        <th><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=1;
                      $query_saldo_tambah = mysqli_query($con, "SELECT * FROM tbl_detail_saldo_tambah") or die(mysqli_error($con));
                      $rv_saldo_tambah = mysqli_num_rows($query_saldo_tambah);
                      if($rv_saldo_tambah>0) {
                        while ($dt_saldo = mysqli_fetch_assoc($query_saldo_tambah)) {
                          ?>
                          <tr>
                            <td><?=$no++;?></td>
                            <td><?=$dt_saldo['kode_bank'];?></td>
                            <td><?=$dt_saldo['tgl_setor'];?></td>
                            <td>Rp.<?=$dt_saldo['jumlah_tambah'];?></td>
                            <td>
                              <center>
                                <a href="proses.php?kd_bank=<?=$dt_saldo['kode_bank'];?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda akan menghapus data detail saldo tambah dengan kode [<?=$dt_saldo['kode_bank'];?>] - Jumlah : [<?=$dt_saldo['jumlah_tambah'];?>]')"><i class="nav-icon fas fa-trash"></i></a>
                                <button type="button" class="btn btn-sm btn-info btn-edit" data-toggle="modal" data-target="#modal-edit"data-tanggal="<?= $dt_saldo['tgl_setor']; ?>"data-jumlah="<?= $dt_saldo['jumlah_tambah']; ?>"data-kode="<?= $dt_saldo['kode_bank']; ?>"><i class="nav-icon fas fa-edit"></i> Edit
                                </button>
                              </center>
                            </td>
                          </tr>
                          <?php
                        }
                      }
                      else {
                        ?>
                        <tr>
                          <td colspan="9">Tidak ditemukan data detail saldo tambah pada database</td>
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
          <h4 class="modal-title"><font color="#ffffff"><i class="fas fa-file"></i> Edit Detail Saldo Tambah</font></h4>
        </div>
        <form id="modal-edit" action="editsaldo_tambah.php" method="POST">
          <div class="modal-body">
            <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="card card-info">
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                  <div class="form-group row">
                    <label for="data-kode" class="col-sm-12 control-label">Kode Bank</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="kode_bank" id="kode_bank" onkeypress="return IsNumeric(event);" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="data-tanggal" class="col-sm-12 control-label">Tanggal Setor</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" name="tanggal-setor" id="tanggal-setor" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="data-jumlah" class="col-sm-12 control-label">Jumlah Tambah</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="jumlah_tambah" id="jumlah_tambah" onkeypress="return IsNumeric(event);">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" name="editsaldotambah" class="btn btn-primary">Simpan Perubahan</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script type="text/javascript">
     $('#modal-edit').on('show.bs.modal', function(e) {

       var kode_bank = $(e.relatedTarget).data('kode_bank');
       var tanggal_setor = $(e.relatedTarget).data('tgl_setor');
       var jumlah_tambah = $(e.relatedTarget).data('jumlah_tambah');




       $(e.currentTarget).find('input[name="kode_bank"]').val(kode_bank);
       $(e.currentTarget).find('input[name="tanggal_setor"]').val(tanggal_setor);
       $(e.currentTarget).find('input[name="jumlah_tambah"]').val(jumlah_tambah);  

     });
   </script>

 </body>
 </html>
