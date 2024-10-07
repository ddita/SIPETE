<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hapus Mahasiswa</title>
</head>
<body>
<?php
require_once '../database/config.php';
session_start();
$id = @$_GET['id'];
$qrdtlsaldotambah=mysqli_query($con,"SELECT kode_bank , jumlah_tambah FROM tbl_detail_saldo_tambah WHERE id='$id'")or die(mysqli_error($con));

$dt_saldotambah = mysqli_fetch_assoc($qrdtlsaldotambah);
$kode_bank = $dt_saldotambah['kode_bank'];
$jumlahtambah = $dt_saldotambah['jumlah_tambah'];

$qrdtbank=mysqli_query($con,"SELECT saldo_akhir  FROM tbl_data_bank WHERE kode_bank='$kode_bank'")or die(mysqli_error($con));
$dt_bank = mysqli_fetch_assoc($qrdtbank);
$saldo_akhir = $dt_bank['saldo_akhir'];

$newsaldo_akhir = $saldo_akhir - $jumlahtambah;

$update_saldoakhir = mysqli_query($con,"UPDATE tbl_data_bank SET saldo_akhir='$newsaldo_akhir' WHERE kode_bank='$kode_bank'")or die (mysqli_error($con));


// $saldo = trim(mysqli_real_escape_string($con, $_GET['']));

$hapusdetailsaldo = mysqli_query($con, "DELETE FROM tbl_detail_saldo_tambah  WHERE id='$id'") or die (mysqli_error($con));

?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	    <script>
	    swal("Berhasil", "Data detail saldo dengan kode bank : <?=$kode_bank;?> Berhasil di hapus", "success");
	    setTimeout(function() {
	    window.location.href ="../admin_master_data_bank/detail_saldo_tambah.php?kode_bank=";
	    }, 1500);
	    </script>
</body>
</html>