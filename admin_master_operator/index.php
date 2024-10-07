<?php
session_start();
$konstruktor = 'admin_master_operator';
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
              <h1 class="m-0">Master Data Operator</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Master Data Operator</li>
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
                  <h3 class="card-title"><i class="nav-icon fas fa-list"></i> Data Operator</h3>
                </div>
                <div class="card-body">
                  <a href="tambahopt.php" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-download"></i> Tambah Data</a>
                  <a href="proses.php?reset=reset_data" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan mereset data ini?')"><i class="nav-icon fas fa-sync"></i> Reset Data</a>
                  <br>
                  <br>
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th width="10%">No</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Foto</th>
                        <th><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=1;
                      $query_opt = mysqli_query($con, "SELECT * FROM tbl_operator") or die(mysqli_error($con));
                      $rv_opt = mysqli_num_rows($query_opt);
                      if($rv_opt>0) {
                        while ($dt_opt = mysqli_fetch_assoc($query_opt)) {
                          ?>
                          <tr>
                            <td><?=$no++;?></td>
                            <td><?=$dt_opt['id']?></td>
                            <td><?=$dt_opt['nama']?></td>
                            <td><?=$dt_opt['kontak'];?></td>
                            <td>
                              <?php
                              if ($dt_opt['foto']=='') {
                                ?>
                                <center>
                                  <button type="button"class="btn btn-sm btn-info" style="background-color:transparent;" data-toggle="modal" data-target="#modal-foto" data-kontak="<?=$dt_opt['kontak'];?>" data-foto="../images/profile.png"> <img src="../images/profile.png" height="50px" width="50px">
                                  </button>
                                </center>
                                <?php
                              } else {
                                ?>
                                <center>
                                  <button type="button"class="btn btn-sm btn-info" style="background-color:transparent;" data-toggle="modal" data-target="#modal-foto" data-kontak="<?=$dt_opt['kontak'];?>" data-foto="<?=$dt_opt['foto'];?>"> <img src="<?=$dt_opt['foto'];?>" height="50px" width="50px">
                                  </button>
                                </center>
                                <?php
                              }
                              ?>
                            </td>
                            <td>
                              <center>
                                <button type="button" class="btn btn-sm btn-info btn-edit" data-toggle="modal" data-target="#modal-edit" data-id="<?= $dt_opt['id']; ?>" data-nama="<?= $dt_opt['nama'];?>" data-kontak="<?= $dt_opt['kontak']; ?>" data-foto="<?= $dt_opt['foto'];?>" >
                                 <i class="nav-icon fas fa-edit"></i></button>
                                 <a href="proses.php?id=<?=$dt_opt['id'];?>&hapus=hapus" class="btn btn-sm btn-danger" onclick="return confirm('Anda akan menghapus data admin dengan Kontak [<?=$dt_opt['kontak'];?>] - Nama : [<?=$dt_opt['nama'];?>]')">
                                  <i class="nav-icon fas fa-trash"></i>
                                </a>
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

  <div class="modal fade" id="modal-foto">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#001f3f;">
          <h4 class="modal-title"><font color="#ffffff"><i class="fas fa-file"></i> Edit Foto Operator</font></h4>
        </div>
        <form class="form-horizontal" id="modal-foto" action="editfoto.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="card card-info">
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                  <div class="form-group row">
                    <label for="data-foto" class="col-sm-12 control-label">Upload Foto</label>
                    <div class="col-sm-12">
                      <center>
                        <img src="" id="fotodosen" height="100px" width="100px">
                        <input type="file" name="fotodosen" class="form-control" accept="image/*" required>
                        <br>
                        <input type="text" class="form-control" name="nidn" id="nidn" hidden>
                      </center>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" name="editfoto" class="btn btn-primary">Simpan Perubahan</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript">
   $('#modal-foto').on('show.bs.modal', function(e) {

     var nidn = $(e.relatedTarget).data('nidn');
     var foto = $(e.relatedTarget).data('foto');

     $(e.currentTarget).find('input[name="nidn"]').val(nidn);
     document.getElementById('fotodosen').src= foto;

   });
 </script>

<div class="modal fade" id="modal-edit">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#001f3f;">
        <h4 class="modal-title"><font color="#ffffff"><i class="fas fa-file"></i> Edit Data Dosen</font></h4>
      </div>
      <form id="modal-edit" action="editopt.php" method="POST">
        <div class="modal-body">
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <div class="form-group row">
                  <label for="data-id" class="col-sm-12 control-label">ID</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="id" id="id" disabled>
                    <input type="text" class="form-control" name="id" id="id" hidden>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="data-nama" class="col-sm-12 control-label">Nama Operator</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="nama" id="nama">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="data-kontak" class="col-sm-12 control-label">Kontak</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="kontak" id="kontak">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" name="editopt" class="btn btn-primary">Simpan Perubahan</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript">
   $('#modal-edit').on('show.bs.modal', function(e) {

     var id = $(e.relatedTarget).data('id');
     var nama = $(e.relatedTarget).data('nama');
     var kontak = $(e.relatedTarget).data('kontak');


     $(e.currentTarget).find('input[name="id"]').val(id);
     $(e.currentTarget).find('input[name="nama"]').val(nama);
     $(e.currentTarget).find('input[name="kontak"]').val(kontak);  

   });
 </script>

</body>
</html>
