<?php
session_start();
$konstruktor = 'opt_nota_transaksi';
require_once '../database/config.php';
if ($_SESSION['status'] != 2) {
  $usr = $_SESSION['username'];
  $waktu = date('Y-m-d H:i:s');
  $auth = $_SESSION['status'];
  $nama = $_SESSION['nama_user'];
  if ($auth == 1) {
    $tersangka = "Administrator";
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
    <title>SIPETE | Operator</title>
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
            include '../opt_sidebar.php';
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
                <h1 class="m-0">Nota Transaksi</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Nota Transaksi</li>
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
                    <h3 class="card-title"><i class="nav-icon fas fa-list"></i> Transaksi</h3>
                  </div>
                  <div class="card-body">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-transfer"><i class="nav-icon fas fa-upload"></i> Transfer</button>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tariktunai"><i class="nav-icon fas fa-download"></i> Tarik Tunai</button>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-tagihan"><i class="nav-icon fas fa-hand-holding-usd"></i> Bayar Tagihan</button>
                    <br>
                    <br>
                    <table id="example1" class="table table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                          <th width="5%">No</th>
                          <th>Tanggal</th>
                          <th>Pelanggan</th>
                          <th>Jenis Transaksi</th>
                          <th>Dari</th>
                          <th>Rekening Tujuan</th>
                          <th>Jumlah</th>
                          <th>Biaya Admin</th>
                          <th>
                            <center>Aksi</center>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        
                        // $id = @$_GET['id_nota'];
                        $query_transfer = mysqli_query($con, "SELECT * FROM tbl_nota_transaksi") or die(mysqli_error($con));
                        $rv_transfer = mysqli_num_rows($query_transfer);
                        if ($rv_transfer > 0) {
                          while ($dt_transfer = mysqli_fetch_assoc($query_transfer)) {
                            $id = $dt_transfer['id_nota'];


                        ?>
                            <tr>
                              <td><?= $no++; ?></td>
                              <td><?= $dt_transfer['tanggal']; ?></td>
                              <td><?= $dt_transfer['pelanggan']; ?></td>
                              <td><?= $dt_transfer['jenis_trx']; ?></td>
                              <td>
                                <?php
                                $kode_rekening = $dt_transfer['dari'];
                                if ($kode_rekening == '100') {
                                  $dari = "Rekening Pelanggan";
                                } else {
                                  $qrbank = mysqli_query($con, "SELECT nama_bank FROM tbl_data_bank WHERE kode_bank='$kode_rekening'") or die(mysqli_error($con));
                                  $arrbank = mysqli_fetch_assoc($qrbank);

                                  $dari = $arrbank['nama_bank'];
                                }
                                ?>
                                <?= $dari ?></td>
                              <td><?= $dt_transfer['tujuan']; ?></td>

                              <td>Rp. <?= number_format($dt_transfer['jumlah'], 0, ",", ".") ?> ,-</td>
                              <td>Rp. <?= number_format($dt_transfer['admin'], 0, ",", ".") ?> ,-</td>
                              <td>
                                <center>
                                  <?php

                                  ?>
                                  <a href="deletenota.php?id_nota=<?=$dt_transfer['id_nota'];?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda akan menghapus data detail transaksi Tanggal [<?= $dt_transfer['tanggal']; ?>] - Nama Pelanggan : [<?= $dt_transfer['pelanggan']; ?>]')"><i class="nav-icon fas fa-trash"></i></a>
                                  <!-- <button type="submit" class="btn btn-sm btn-info btn-edit" data-toggle="modal" data-target="#modal-edit"
                                    data-tanggal="<?= $dt_transfer['tanggal']; ?>"
                                    data-pelanggan="<?= $dt_transfer['pelanggan']; ?>"
                                    data-jenistrx="<?= $dt_transfer['jenis_trx']; ?>"
                                    data-dari="<?= $dt_transfer['dari']; ?>"
                                    data-tujuan="<?= $dt_transfer['tujuan']; ?>">
                                    <i class="nav-icon fas fa-edit"></i> Edit
                                  </button> -->
                                  <a href="nota.php?id_nota=<?=$dt_transfer['id_nota'];?>" class="btn btn-sm btn-warning" target="_blank"><i class="nav-icon fas fa-file"> Cetak Nota</i></a>
                                </center>
                              </td>
                            </tr>
                          <?php
                          }
                        } else {
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


     <!-- MODAL EDIT -->
    <div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#0b8e47;">
            <h4 class="modal-title">
              <font color="white">Detail Transfer
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></font>
            </button>
          </div>
          <form id="modal-edit" action="transfer.php" method="POST">
            <div class="modal-body">
              <div class="form-group row">
                <label for="data-tanggal" class="col-sm-12 control-label">Tanggal Transfer</label>
                <div class="col-sm-12">
                  <input type="date" class="form-control" name="tanggal" id="tanggal">
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Nama Pelanggan</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="pelanggan" id="pelanggan" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Dari Rekening</label>
                <div class="col-sm-12">
                  <select class="form-control" name="rekening" required>
                    <?php
                    $pglbank = mysqli_query($con, "SELECT kode_bank, nama_bank FROM tbl_data_bank WHERE kode_bank!='1'") or die(mysqli_error($con));  // Gunakan $kode_bank
                    $rvbank = mysqli_num_rows($pglbank);

                    if ($rvbank > 0) {
                      while ($dt_bank = mysqli_fetch_assoc($pglbank)) {
                    ?>
                        <option value="<?= $dt_bank['kode_bank']; ?>">
                          <?= $dt_bank['kode_bank']; ?> - <?= $dt_bank['nama_bank']; ?>
                        </option>
                    <?php
                      }
                    } else {
                      // Penanganan ketika data tidak ditemukan
                      echo "<option value=''>Tidak ada data bank ditemukan</option>";
                    }
                    ?>


                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Rekening Tujuan</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="tujuan" id="tujuan" onkeypress="return IsNumeric(event);" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Jumlah</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="jumlah" id="jumlah" onkeypress="return IsNumeric(event);" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label" name="admin">Biaya Admin</label>

                <div class="col-sm-12">
                  <input type="text" class="form-control" name="admin" id="admin" onkeypress="return IsNumeric(event);" required>
                </div>
              </div>
            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-success" name="transfer"> Submit Transaksi</button>
            </div>
        </div>
        <!-- /.modal-content -->
        </form>
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!-- TRANSFER -->
    <div class="modal fade" id="modal-transfer">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#0b8e47;">
            <h4 class="modal-title">
              <font color="white">Detail Transfer
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></font>
            </button>
          </div>
          <form id="modal-transfer" action="transfer.php" method="POST">
            <div class="modal-body">
              <div class="form-group row">
                <label for="data-tanggal" class="col-sm-12 control-label">Tanggal Transfer</label>
                <div class="col-sm-12">
                  <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?=date('Y-m-d')?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Nama Pelanggan</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="pelanggan" id="pelanggan" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Dari Rekening</label>
                <div class="col-sm-12">
                  <select class="form-control" name="rekening" required>
                    <?php
                    $pglbank = mysqli_query($con, "SELECT kode_bank, nama_bank FROM tbl_data_bank WHERE kode_bank!='1'") or die(mysqli_error($con));  // Gunakan $kode_bank
                    $rvbank = mysqli_num_rows($pglbank);

                    if ($rvbank > 0) {
                      while ($dt_bank = mysqli_fetch_assoc($pglbank)) {
                    ?>
                        <option value="<?= $dt_bank['kode_bank']; ?>">
                          <?= $dt_bank['kode_bank']; ?> - <?= $dt_bank['nama_bank']; ?>
                        </option>
                    <?php
                      }
                    } else {
                      // Penanganan ketika data tidak ditemukan
                      echo "<option value=''>Tidak ada data bank ditemukan</option>";
                    }
                    ?>


                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Rekening Tujuan</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="tujuan" id="tujuan" onkeypress="return IsNumeric(event);" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Jumlah</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="jumlah" id="jumlah" onkeypress="return IsNumeric(event);" required>
                </div>
              </div>
              <!-- <div class="form-group row">
              <label for="data-jumlah" class="col-sm-12 control-label"> Sumber</label>
              <div class="col-sm-12">
                <select class="form-control" name="sumber" required>
                  <option value="">-- Pilih Sumber --</option>
                  <option value="">Cash</option>
                  <option value="">Rekening Pelanggan</option>

                </select>
              </div>
            </div> -->
              <!-- <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Biaya Admin</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="admin" id="admin" onkeypress="return IsNumeric(event);" required>
                </div>
              </div> -->
            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-success" name="transfer"> Submit Transaksi</button>
            </div>
        </div>
        <!-- /.modal-content -->
        </form>
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!-- TARIK TUNAI -->
    <div class="modal fade" id="modal-tariktunai">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#0cb4da;">
            <h4 class="modal-title">
              <font color="white">Detail Tarik Tunai
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></font>
            </button>
          </div>
          <form id="modal-tariktunai" action="tariktunai.php" method="POST">
            <div class="modal-body">
              <div class="form-group row">
                <label for="data-tanggal" class="col-sm-12 control-label">Tanggal Tarik Tunai</label>
                <div class="col-sm-12">
                  <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?=date('Y-m-d')?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Nama Pelanggan</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="pelanggan" id="pelanggan" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Ke Rekening</label>
                <div class="col-sm-12">
                  <select class="form-control" name="rekening" required>
                    <?php
                    $pglbank = mysqli_query($con, "SELECT kode_bank, nama_bank FROM tbl_data_bank WHERE kode_bank!='1'AND kode_bank!='100' ") or die(mysqli_error($con));  // Gunakan $kode_bank
                    $rvbank = mysqli_num_rows($pglbank);

                    if ($rvbank > 0) {
                      while ($dt_bank = mysqli_fetch_assoc($pglbank)) {
                    ?>
                        <option value="<?= $dt_bank['kode_bank']; ?>">
                          <?= $dt_bank['kode_bank']; ?> - <?= $dt_bank['nama_bank']; ?>
                        </option>
                    <?php
                      }
                    } else {
                      // Penanganan ketika data tidak ditemukan
                      echo "<option value=''>Tidak ada data bank ditemukan</option>";
                    }
                    ?>


                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Rekening Pelanggan</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="tujuan" id="tujuan" onkeypress="return IsNumeric(event);" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Jumlah</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="jumlah" id="jumlah" onkeypress="return IsNumeric(event);" required>
                </div>
              </div>
              <!-- <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Biaya Admin</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="admin" id="admin" onkeypress="return IsNumeric(event);" required>
                </div>
              </div> -->
            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-primary" name="tariktunai"> Submit Transaksi</button>
            </div>
        </div>
        <!-- /.modal-content -->
        </form>
      </div>
      <!-- /.modal-dialog -->
    </div>


    <!-- TAGIHAN -->
    <div class="modal fade" id="modal-tagihan">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#f4c328;">
            <h4 class="modal-title">
              <font color="white">Detail Bayar Tagihan
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></font>
            </button>
          </div>
          <form id="modal-tagihan" action="tagihan.php" method="POST">
            <div class="modal-body">
              <div class="form-group row">
                <label for="data-tanggal" class="col-sm-12 control-label">Tanggal Bayar Tagihan</label>
                <div class="col-sm-12">
                  <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?=date('Y-m-d')?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Nama Pelanggan</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="pelanggan" id="pelanggan" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Dari Rekening</label>
                <div class="col-sm-12">
                  <select class="form-control" name="rekening" required>
                    <?php
                    $pglbank = mysqli_query($con, "SELECT kode_bank, nama_bank FROM tbl_data_bank WHERE kode_bank!='1'") or die(mysqli_error($con));  // Gunakan $kode_bank
                    $rvbank = mysqli_num_rows($pglbank);

                    if ($rvbank > 0) {
                      while ($dt_bank = mysqli_fetch_assoc($pglbank)) {
                    ?>
                        <option value="<?= $dt_bank['kode_bank']; ?>">
                          <?= $dt_bank['kode_bank']; ?> - <?= $dt_bank['nama_bank']; ?>
                        </option>
                    <?php
                      }
                    } else {
                      // Penanganan ketika data tidak ditemukan
                      echo "<option value=''>Tidak ada data bank ditemukan</option>";
                    }
                    ?>


                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label"> Transaksi</label>
                <div class="col-sm-12">
                  <!-- <select class="form-control" name="tujuan" required>

                  <option value="">-- Pilih Transaksi --</option>
                  <option value="">Bayar PDAM</option>
                  <option value="">Bayar GAS</option>
                  <option value="">Bayar BPJS</option>
                  <option value="">Pulsa Listrik</option>

                </select> -->

                  <div class="form-row">
                    <div class="col-7">
                    <input id="myText" name="tujuan" type="text" placeholder="Pilih Transaksi" class="form-control" required disabled>
                    </div>
                    <div class="col">
                    <select name="tujuan" class="form-control" onchange="myFunction(event)">
                    <option disabled selected>Jenis Transaksi</option>
                    <hr>
                    <option value="Setor Bank"> Setor Bank</option>
                    <option value="Bayar PDAM"> PDAM</option>
                    <option value="Bayar GAS"> GAS</option>
                    <option value="Bayar BPJS"> BPJS</option>
                    <option value="Token Listrik"> Token Listrik</option>
                    <option value="Sales"> Sales</option>

                  </select>
                    </div>  
                  </div>

                  <!-- <input id="myText" type="text" value="colors" class="form-control">
                  <select name="" class="form-control" onchange="myFunction(event)">
                    <option disabled selected>Choose Database Type</option>
                    <option value="Green">green</option>
                    <option value="Red">red</option>
                    <option value="Orange">orange</option>
                    <option value="Black">black</option>
                  </select> -->
                </div>
              </div>
              <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Jumlah</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="jumlah" id="jumlah" onkeypress="return IsNumeric(event);" required>
                </div>
              </div>
              <!-- <div class="form-group row">
                <label for="data-jumlah" class="col-sm-12 control-label">Biaya Admin</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="admin" id="admin" onkeypress="return IsNumeric(event);" required>
                </div>
              </div> -->
            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-warning" name="tagihan"> Submit Transaksi</button>
            </div>
        </div>
        <!-- /.modal-content -->
        </form>
      </div>
      <!-- /.modal-dialog -->
    </div>

  <?php
  include '../script.php';
}
  ?>
  <script type="text/javascript">
    $('#modal-transfer').on('show.bs.modal', function(e) {
      var tanggal = $(e.relatedTarget).data('tanggal');
      var pelanggan = $(e.relatedTarget).data('pelanggan');
      var rek_tujuan = $(e.relatedTarget).data('tujuan');
      var jumlah = $(e.relatedTarget).data('jumlah');
      var sumber = $(e.relatedTarget).data('sumber');
      var admin = $(e.relatedTarget).data('admin');


      //  $(e.currentTarget).find('input[name="tanggal"]').val(tanggal);
      document.getElementById('tanggal').value = tanggal;
      $(e.currentTarget).find('input[name="pelanggan"]').val(pelanggan);
      $(e.currentTarget).find('input[name="tujuan"]').val(rek_tujuan);
      $(e.currentTarget).find('input[name="jumlah"]').val(jumlah);
      $(e.currentTarget).find('input[name="sumber"]').val(sumber);
      $(e.currentTarget).find('input[name="admin"]').val(admin);



    });
  </script>
  <script>
    function myFunction(e) {
      document.getElementById("myText").value = e.target.value
    }
  </script>

  </body>

  </html>