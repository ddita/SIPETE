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
        echo '<script>alert("Data Admin dengan ID [ '.$id.' ] berhasil di hapus")</script>';
        $qrdeladmin = mysqli_query($con, "DELETE FROM tbl_administrator WHERE id = '$id'") or die (mysqli_error($con));
        $qrdelpengguna = mysqli_query($con, "DELETE FROM tbl_pengguna WHERE id = '$id'") or die (mysqli_error($con));

        echo '<script>window.location="../admin_master_administrator"</script>';
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
    if(isset($_POST['tambahadmin'])){
        $id = trim(mysqli_real_escape_string($con, $_POST['id']));
        $username = trim(mysqli_real_escape_string($con, $_POST['username']));
        $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
        $password = sha1($username);
        $stt_admin = "1";

        $querycek = mysqli_query($con, "SELECT * FROM tbl_administrator WHERE id='$id'") or die (mysqli_error($con));
        $returnvalue = mysqli_num_rows($querycek);

        if($returnvalue==0){
            mysqli_query($con, "INSERT INTO tbl_administrator VALUES ('$id','$username','$password','$nama')") or die (mysqli_error($con));
            $querytambahadmin = mysqli_query($con, "INSERT INTO tbl_pengguna VALUES ('$id', '$username','$password','$nama','$stt_admin')") or die (mysqli_error($con));

            echo '<script>alert("Admin dengan ID [ '.$id.' ] - Nama [ '.$nama.' ] berhasil ditambahkan")</script>';
            echo '<script>window.location="../admin_master_administrator"</script>';
        } else{
            echo '<script>alert("Admin dengan ID [ '.$id.' ] sudah ada dalam database")</script>';
            echo '<script>window.location="../admin_master_administrator/tambahadmin.php"</script>';
        }
    }

    // reset data
    // $reset = @$_GET['reset'];
    // if($reset=="reset_data"){

    // // ambil nidn dari tabel dosen
    //     $querynidndosen = mysqli_query($con, "SELECT * FROM tbl_dosen") or die (mysqli_error($con));
    // //return value
    //     $returnvalue = mysqli_num_rows($querynidndosen);

    //     if($returnvalue>0){
    //     // proses perulangan sebanyak record yang ditentukan pada database
    //         while($data = mysqli_fetch_assoc($querynidndosen)){
    //         // menampung nidn pada setiap perulangan di dalam variabel $nidn_dosen
    //             $nidn_dosen = $data['nidn'];
    //             // mengapus data berdasarkan nidn pada setiap perulangan
    //             $qrdelpengguna = mysqli_query($con, "DELETE FROM tbl_pengguna WHERE username = '$nidn_dosen'") or die (mysqli_error($con));
    //         }
    //     } else{

    //     }

    //     $queryresetdosen = mysqli_query($con,"TRUNCATE TABLE tbl_dosen") or die (mysqli_error($con));

    //     echo '<script>alert("Semua data sudah berhasil di reset boyyy... keren")</script>';
    //     echo '<script>window.location = "../admin_master_dosen"</script>';
    // }
    ?>

</body>
</html>