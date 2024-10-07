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

 if(isset($con, $_POST['tambahsaldo2'])) {
   $kode_bank = @$_GET['kode_bank'];
   $tanggal = trim(mysqli_real_escape_string($con, $_POST['tanggal']));
   $saldo_tambah = trim(mysqli_real_escape_string($con, $_POST['saldo_tambah']));

   $qrtambah = mysqli_query($con, "INSERT INTO tbl_detail_saldo_tambah (kode_bank, tgl_setor, jumlah_tambah) VALUES('$kode_bank','$tanggal', '$saldo_tambah' )") or die(mysqli_error($con));

   $pgl_saldoakhir = mysqli_query($con, "SELECT saldo_akhir FROM tbl_data_bank WHERE kode_bank='$kode_bank'");
   $arrsaldo = mysqli_fetch_assoc($pgl_saldoakhir);
   $saldo_akhir = $arrsaldo['saldo_akhir'];

   $penambahansaldo = $saldo_akhir+$saldo_tambah;

   $update_saldoakhir = mysqli_query($con, "UPDATE tbl_data_bank SET saldo_akhir = '$penambahansaldo' WHERE kode_bank='$kode_bank' ");
   echo '<script>alert("Saldo berhasil ditambahkan.");window.location.href = "../admin_master_data_bank/detail_saldo_tambah.php?kode_bank='.$kode_bank.'";</script>';
 } else {
 	echo '<script>window.location.href = "../admin_master_data_bank/detail_saldo_tambah.php";</script>';
 }

	?>
</body>
</html>