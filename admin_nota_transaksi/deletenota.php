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
$id_nota = @$_GET['id_nota'];


// $saldo = trim(mysqli_real_escape_string($con, $_GET['']));

$deletenota = mysqli_query($con, "DELETE FROM tbl_nota_transaksi WHERE id_nota='$id_nota'") or die (mysqli_error($con));

?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	    <script>
	    swal("Berhasil", "Data Transaksi dengan ID Nota : <?=$id_nota;?> Berhasil di hapus", "success");
	    setTimeout(function() {
	    window.location.href ="../admin_nota_transaksi";
	    }, 1500);
	    </script>
</body>
</html>