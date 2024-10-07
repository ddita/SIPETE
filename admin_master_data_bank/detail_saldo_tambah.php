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
                <li class="breadcrumb-item active">Detail Saldo Tambah</li>
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
                  <h3 class="card-title"><i class="nav-icon fas fa-list"></i> Detail Saldo Tambah</h3>
                </div>
                <div class="card-body">
                  <a href="../admin_master_data_bank" class="btn btn-warning btn-sm"><i class="nav-icon fas fa-chevron-left"></i> Kembali</a>
                  <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal-tambah"> Tambah Data</button>
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
                      $kdbank = @$_GET['kode_bank'];
                      
                      $query_saldo_tambah = mysqli_query($con, "SELECT * FROM tbl_detail_saldo_tambah where kode_bank='$kdbank'") or die(mysqli_error($con));
                      $rv_saldo_tambah = mysqli_num_rows($query_saldo_tambah);
                      if($rv_saldo_tambah>0) {
                        while ($dt_saldo = mysqli_fetch_assoc($query_saldo_tambah)) {
                          $kode_bank = $dt_saldo['kode_bank'];
                          $qrnamabank = mysqli_query($con,"SELECT nama_bank FROM tbl_data_bank WHERE kode_bank = '$kode_bank'")or die(mysqli_error($con));
                          $data_namabank  = mysqli_fetch_assoc($qrnamabank);
                          $namabank = $data_namabank['nama_bank']; 

                          ?>
                          <tr>
                            <td><?=$no++;?></td>
                            <td><?=$dt_saldo['kode_bank'];?> - <?=$namabank;?></td>
                            <td><?=$dt_saldo['tgl_setor'];?></td>
                            <td>Rp. <?= number_format($dt_saldo['jumlah_tambah'],0,",",".")?> ,-</td>
                            <td>
                              <center>
                                <?php
                               
                                ?>
                                <a href="delete_saldotambah.php?id=<?=$dt_saldo['id'];?>&kode_bank=<?=$kdbank;?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda akan menghapus data detail saldo tambah Tanggal [<?=$dt_saldo['tgl_setor'];?>] - Jumlah : [<?=$dt_saldo['jumlah_tambah'];?>]')"><i class="nav-icon fas fa-trash"></i></a>
                                <button type="submit" class="btn btn-sm btn-info btn-edit" data-toggle="modal" data-target="#modal-edit" 
                                data-tanggal="<?= $dt_saldo['tgl_setor']; ?>"
                                data-jumlah="<?= $dt_saldo['jumlah_tambah']; ?>"
                                data-kode="<?= $dt_saldo['kode_bank']; ?>"
                                data-id="<?= $dt_saldo['id']; ?>"
                                data-nama = "<?=$namabank;?>">
                                <i class="nav-icon fas fa-edit"></i> Edit
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
    <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#001f3f;">
          <h4 class="modal-title"><font color="#ffffff"><i class="fas fa-file"></i> Edit Saldo</font></h4>
        </div>
        <?php
        $kode_bank = @$_GET['kode_bank'];
        ?>
        <form id="modal-edit" action="editsaldo_tambah.php" method="POST">
          <div class="modal-body">
            <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="card card-info">
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                  <div class="form-group row">
                  <div class="form-group row">
                    <label for="data-nama" class="col-sm-12 control-label">Nama Bank</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="nama_bank" id="nama_bank" disabled>
                      <input type="text" class="form-control" name="id" id="id" hidden>
                    </div>
                  </div>
                    <label for="data-tanggal" class="col-sm-12 control-label">Tanggal Setor</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" name="tanggal_setor" id="tanggalstor" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="data-jumlah" class="col-sm-12 control-label">Saldo Tambah</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="jumlah_tambah" id="jumlah_tambah" onkeypress="return IsNumeric(event);">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" name="editsaldo_tambah" class="btn btn-primary">Simpan Perubahan</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
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
        $kode_bank = @$_GET['kode_bank'];
        ?>
        <form id="modal-tambah" action="proses.php?kode_bank=<?=$kode_bank;?>" method="POST">
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
                      <input type="date" class="form-control" name="tanggal" id="tanggal">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="data-jumlah" class="col-sm-12 control-label">Saldo Tambah</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="saldo_tambah" id="saldo_tambah" onkeypress="return IsNumeric(event);">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" name="tambahsaldo2" class="btn btn-primary">Simpan</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script type="text/javascript">
  // Set tanggal hari ini secara otomatis pada input tanggal
  document.addEventListener('DOMContentLoaded', function () {
    // Ambil elemen input tanggal
    var inputTanggal = document.getElementById('tanggal');
    
    // Dapatkan tanggal hari ini
    var today = new Date();
    var day = String(today.getDate()).padStart(2, '0');
    var month = String(today.getMonth() + 1).padStart(2, '0'); // Januari = 0, jadi tambahkan 1
    var year = today.getFullYear();
    
    // Format tanggal sesuai dengan format input type="date" (YYYY-MM-DD)
    var todayFormatted = year + '-' + month + '-' + day;
    
    // Set nilai input tanggal dengan tanggal hari ini
    inputTanggal.value = todayFormatted;
  });
</script>

<!-- MODAL EDIT -->

  
    <script type="text/javascript">
     $('#modal-edit').on('show.bs.modal', function(e) {
      var id = $(e.relatedTarget).data('id');
       var kode_bank = $(e.relatedTarget).data('kode');
       var tanggal_setor = $(e.relatedTarget).data('tanggal');
       var jumlah_tambah = $(e.relatedTarget).data('jumlah');
       var nama_bank = $(e.relatedTarget).data('nama');

       $(e.currentTarget).find('input[name="id"]').val(id);
       $(e.currentTarget).find('input[name="kode_bank"]').val(kode_bank);
       $(e.currentTarget).find('input[name="nama_bank"]').val(kode_bank+" - " +nama_bank);
       document.getElementById('tanggalstor').value = tanggal_setor;
       $(e.currentTarget).find('input[name="jumlah_tambah"]').val(jumlah_tambah);  

     });
   </script>

 </body>
 </html>
