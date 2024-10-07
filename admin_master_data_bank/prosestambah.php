<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Proses Master Data Bank</title>
</head>
<body>
<?php
require_once '../database/config.php';
session_start();

//trigger button tambahmhs dari halaman tambahmahasiswa.php
if(isset($con, $_POST['tambahbank'])){
	$kode_bank = trim(mysqli_real_escape_string($con, $_POST['kode_bank']));
	$nama_bank = trim(mysqli_real_escape_string($con, $_POST['nama_bank']));
	$no_rekening = trim(mysqli_real_escape_string($con, $_POST['norek']));
	$nasabah = trim(mysqli_real_escape_string($con, $_POST['nasabah']));
	$saldo_awal = trim(mysqli_real_escape_string($con, $_POST['saldo_awal']));


	$querycek = mysqli_query($con, "SELECT kode_bank FROM tbl_data_bank WHERE kode_bank='$kode_bank'") or die(mysqli_error($con));
	$rvbank = mysqli_num_rows($querycek);

	if($rvbank>0) {
		?>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Duplikat Data", "Data Bank dengan Kode Bank : <?=$kode_bank;?>, Nama Bank : <?=$nama_bank;?> sudah ada dalam database", "error");
            setTimeout(function(){
                window.location.href = "../admin_master_data_bank";
            }, 1500);
        </script>
		<?php
	} else {
		$tambahbank = mysqli_query($con, "INSERT INTO tbl_data_bank VALUES ('$kode_bank', '$nama_bank', '$no_rekening', '$nasabah', '$saldo_awal','$saldo_awal' )  ") or die(mysqli_error($con));
		?>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Data Bank dengan Kode Bank : <?=$kode_bank;?>, Nama Bank : <?=$nama_bank;?> berhasil ditambahkan", "success");
            setTimeout(function(){
                window.location.href = "../admin_master_data_bank";
            }, 1500);
        </script>
        <?php
	}
}

?>
</body>
</html>