<?php
session_start();
$konstruktor = 'laporan_laba';
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
                                <h1 class="m-0">Laporan Laba</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Laporan Laba</li>
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
                                        <h3 class="card-title"><i class="nav-icon fas fa-file"></i> Laporan Laba Transaksi</h3>
                                    </div>
                                    <div class="card-body">
                                     <form action="" method="POST">
                                        <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="data-tanggal" class="control-label">Pilih Tanggal</label>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <input type="date" class="form-control" name="tanggal" id="tanggal">
                                                    </div>
                                                    <div class="col-lg-7">
                                                         <button type="submit" name="carilaba" class="btn btn-sm btn-info"><i class="nav-icon fas fa-search"></i> Cari Data</button>
                                                        </div>
                                                </div>
                                        </form>
                                        <?php
                                            if (isset($con, $_POST['carilaba'])) {
                                                $tanggalterpilih = mysqli_real_escape_string($con, $_POST['tanggal']);
                                                $pgl_tanggal = mysqli_query($con, "SELECT * FROM tbl_nota_transaksi WHERE tanggal = '$tanggalterpilih'") or die(mysqli_error($con));
                                                $pgl_laba  = mysqli_query($con, "SELECT SUM(admin) as laba FROM tbl_nota_transaksi WHERE tanggal = '$tanggalterpilih'") or die(mysqli_error($con));
                                                $arrlaba  = mysqli_fetch_array($pgl_laba);
                                                $totallaba = $arrlaba['laba'];
                                                $pgl_jml  = mysqli_query($con, "SELECT SUM(jumlah) as jumlah FROM tbl_nota_transaksi WHERE tanggal = '$tanggalterpilih'") or die(mysqli_error($con));
                                                $arrjml  = mysqli_fetch_array($pgl_jml);
                                                $totaljml = $arrjml['jumlah'];
                                                ?>
                                                <br>
                                                <a href="export-excel.php?tanggal=<?=$tanggalterpilih;?>" class="btn btn-sm btn-success" target="_blank"><i class="nav-icon fas fa-file-excel"></i> Export Data ke Excel</a>
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $rv_transfer = mysqli_num_rows($pgl_tanggal);
                                                    if ($rv_transfer > 0) {
                                                    while ($dt_transfer = mysqli_fetch_assoc($pgl_tanggal)) {
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
                                                <tfoot>
                                                    <td colspan="6" align="center"><font style="font-size: 20px;"><b> TOTAL TRANSAKSI  </b></font></td>
                                                    <td><font style="font-size: 18px;"><b>Rp <?=number_format($totaljml,0,",",".");?>,-</b></font></td>
                                                    <td><font style="font-size: 18px;"><b>Rp <?=number_format($totallaba,0,",",".");?>,-</b></font></td>
                                                </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                                <?php
                                            }
                                            ?>
                                        <br>
                                     
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