<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hapus Data Bank</title>
</head>
<body>
<?php
require_once '../database/config.php';
session_start();
$kode_bank = @$_GET['kode_bank'];


// $saldo = trim(mysqli_real_escape_string($con, $_GET['']));

$hapusdatabank = mysqli_query($con, "DELETE FROM tbl_data_bank WHERE kode_bank='$kode_bank'") or die (mysqli_error($con));
$hapusdetail   = mysqli_query($con, "DELETE FROM tbl_detail_saldo_tambah WHERE kode_bank='$kode_bank'") or die (mysqli_error($con));

?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	    <script>
	    swal("Berhasil", "Data Bank dengan Kode Bank : <?=$kode_bank;?> Berhasil di hapus", "success");
	    setTimeout(function() {
	    window.location.href ="../admin_master_data_bank";
	    }, 1500);
	    </script>
</body>
</html>