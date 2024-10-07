<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update Logo Title</title>
</head>
<body>
	<?php
	include '../database/config.php';
	session_start();

	if (isset($con, $_POST['updtitle'])){
		$file = $_FILES['logotitle'] ['name'];
		$ekstensi = explode(".", $file); 
		$file_name = "img-logotitle".round(microtime(true)).".".end($ekstensi);
		$temp_file = $_FILES['logotitle']['tmp_name'];
		$target_dir = "../images/";
		$file_upload = $target_dir.$file_name;
		$aksi_upload = move_uploaded_file($temp_file, $file_upload);

		$idlogo = "2";
		$update_logotitle = mysqli_query($con, "UPDATE tbl_konfigurasi SET lokasi_file='$file_upload' WHERE Id='$idlogo'") or die (mysql_error($con));

		echo '<script>alert("Logo Title berhasil diupdate")</script>';
		echo '<script>window.location = "../admin_konfigurasi"</script>';


	}
	?>

</body>
</html>