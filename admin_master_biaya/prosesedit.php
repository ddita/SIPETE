<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Operator</title>
</head>

<body>
    <?php
    require_once '../database/config.php';

    if (isset($_POST['editbiaya'])) {
        $ket = $_POST['ket'];
        $bayar = $_POST['bayar'];


        $query = "UPDATE tbl_admin SET bayar='$bayar' WHERE ket='$ket'";

        if (mysqli_query($con, $query)) {
            echo '<script>alert("Data berhasil diperbarui");
            window.location.href="../admin_master_biaya";
              </script>';
        } else {
            echo '<script>
                alert("Data gagal diperbarui");
                window.location.href="../admin_master_biaya";
              </script>';
        }
    }
    ?>

</body>
</html>