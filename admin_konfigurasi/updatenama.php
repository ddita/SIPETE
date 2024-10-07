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

	if (isset($con, $_POST['gantinama'])){
		$nama = trim(mysqli_real_escape_string($con, $_POST['appname']));
		

		$id = "3";
		$update_name = mysqli_query($con, "UPDATE tbl_konfigurasi SET elemen='$nama' WHERE Id='$id'") or die (mysql_error($con)); 

		

		echo '<script>alert("Nama App berhasil diupdate")</script>';
		echo '<script>window.location = "../admin_konfigurasi"</script>';


	}
	?>

</body>
</html>