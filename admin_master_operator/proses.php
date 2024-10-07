<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
    <?php
    session_start();
    require_once '../database/config.php';

    // Delet Data
    $id = @$_GET['id'];
    $hapus = @$_GET['hapus'];
    if(@$hapus=='hapus'){
        echo '<script>alert("Data Operator dengan ID [ '.$id.' ] berhasil di hapus")</script>';
        $qrdelopt = mysqli_query($con, "DELETE FROM tbl_operator WHERE id = '$id'") or die (mysqli_error($con));
        $qrdelpengguna = mysqli_query($con, "DELETE FROM tbl_pengguna WHERE id = '$id'") or die (mysqli_error($con));

        echo '<script>window.location="../admin_master_operator"</script>';
    }
    
    // //reset password
    // $resetpw = @$_GET['resetpw'];
    // if($resetpw=='resetpw'){
    //     $passreset = sha1($kd_dosen);
    //     $qrresetpw = mysqli_query($con, "UPDATE tbl_pengguna SET password='$passreset' WHERE username='$kd_dosen'") or die (mysqli_error($con));

    //     echo '<script>alert("password dengan NIDN [ '.$kd_dosen.' ] berhasil di reset")</script>';
    //     echo '<script>window.location="../admin_master_dosen"</script>';
    // }

    // Tambah data
    if(isset($_POST['tambahopt'])){
        $id = trim(mysqli_real_escape_string($con, $_POST['id']));
        $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
        $kontak = trim(mysqli_real_escape_string($con, $_POST['kontak']));
        $foto = trim(mysqli_real_escape_string($con, $_POST['foto']));
        $username = trim($nama);
        $password = sha1($nama);
        $stt_opt = "2";

        $querycek = mysqli_query($con, "SELECT * FROM tbl_operator WHERE id='$id'") or die (mysqli_error($con));
        $returnvalue = mysqli_num_rows($querycek);

        if($returnvalue==0){
            mysqli_query($con, "INSERT INTO tbl_operator VALUES ('$id','$nama','$kontak','$foto')") or die (mysqli_error($con));
            $querytambahadmin = mysqli_query($con, "INSERT INTO tbl_pengguna VALUES ('$id','$username','$password','$nama','$stt_opt')") or die (mysqli_error($con));

            echo '<script>alert("Operator dengan ID [ '.$id.' ] - Nama [ '.$nama.' ] berhasil ditambahkan")</script>';
            echo '<script>window.location="../admin_master_operator"</script>';
        } else{
            echo '<script>alert("Operator dengan ID [ '.$id.' ] sudah ada dalam database")</script>';
            echo '<script>window.location="../admin_master_operator/tambahopt.php"</script>';
        }
    }
    ?>

</body>
</html>