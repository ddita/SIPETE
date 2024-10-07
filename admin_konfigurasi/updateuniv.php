<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update Logo App</title>
</head>
<body>
	<?php
	include '../database/config.php';
	session_start();

	if (isset($con, $_POST['updateuniv'])){
		$nama_univ = trim(mysqli_real_escape_string($con, $_POST['universitas']));
		

		$id = "5";
		$update_nama_univ = mysqli_query($con, "UPDATE tbl_konfigurasi SET elemen='$nama_univ' WHERE Id='$id'") or die (mysql_error($con)); 

		

		echo '<script>alert("Nama Universitas App berhasil diupdate")</script>';
		echo '<script>window.location = "../admin_konfigurasi"</script>';


	}
	?>

</body>
</html>