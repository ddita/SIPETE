<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Proses Detail Saldo</title>
</head>
<body>
	<?php
	session_start();
	require_once '../database/config.php';

 if(isset($con, $_POST['transfer'])) {
   // $kode_bank = @$_GET['kode_bank'];
   $tanggal = trim(mysqli_real_escape_string($con, $_POST['tanggal']));
   $nama_pelanggan = trim(mysqli_real_escape_string($con, $_POST['nama_pelanggan']));
   $jenis_transaksi = trim(mysqli_real_escape_string($con, $_POST['jenis_transaksi']));
   $tujuan = trim(mysqli_real_escape_string($con, $_POST['tujuan']));
   $jumlah = trim(mysqli_real_escape_string($con, $_POST['jumlah']));

   $qrtambah = mysqli_query($con, "INSERT INTO tbl_transaksi (tanggal, nama_pelanggan, jenis_transaksi, tujuan, jumlah) VALUES('$tanggal', '$nama_pelanggan', '$jenis_transaksi', '$tujuan', '$jumlah' )") or die(mysqli_error($con));

 }
 else {
 	echo '<script>window.location = "../admin_master_data_bank/detail_saldo_tambah.php"</script>';
 }

	?>
</body>
</html>