<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Administrator</title>
</head>

<body>
    <?php
    require_once '../database/config.php';

    if (isset($_POST['editadmin'])) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $nama = $_POST['nama'];


        $query = "UPDATE tbl_administrator SET username='$username', nama='$nama' WHERE id='$id'";

        if (mysqli_query($con, $query)) {
            echo '<script>alert("Data berhasil diperbarui");
            window.location.href="../admin_master_administrator";
              </script>';
        } else {
            echo '<script>
                alert("Data gagal diperbarui");
                window.location.href="../admin_master_administrator";
              </script>';
        }
    }
    ?>

</body>
</html>