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

	if (isset($con, $_POST['updatecopy'])){
		$nama_copy = trim(mysqli_real_escape_string($con, $_POST['copyright']));
		

		$id = "4";
		$update_copy = mysqli_query($con, "UPDATE tbl_konfigurasi SET elemen='$nama_copy' WHERE Id='$id'") or die (mysql_error($con)); 

		

		echo '<script>alert("Copyright App berhasil diupdate")</script>';
		echo '<script>window.location = "../admin_konfigurasi"</script>';


	}
	?>

</body>
</html>