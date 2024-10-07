<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proses Transfer</title>
</head>

<body>
    <?php
    session_start();
    require_once '../database/config.php';

    if (isset($con, $_POST['tariktunai'])) {
        $tanggal = trim(mysqli_real_escape_string($con, $_POST['tanggal']));
        $pelanggan = trim(mysqli_real_escape_string($con, $_POST['pelanggan']));
        $kode_bank = trim(mysqli_real_escape_string($con, $_POST['rekening']));
        $jenis_trx = "Tarik Tunai";
        $tujuan = trim(mysqli_real_escape_string($con, $_POST['tujuan']));
        $jumlah = trim(mysqli_real_escape_string($con, $_POST['jumlah']));
        // $admin = trim(mysqli_real_escape_string($con, $_POST['admin']));

        $sqlbiaya_admin = mysqli_query($con, "SELECT bayar FROM tbl_admin 
        WHERE 
        ($jumlah BETWEEN 0 AND 50000 AND id = 1) OR 
        ($jumlah BETWEEN 50001 AND 100000 AND id = 2) OR
        ($jumlah BETWEEN 100001 AND 500000 AND id = 3) OR
        ($jumlah > 1000000 AND id = 4)") or die(mysqli_error($con));

            if (mysqli_num_rows($sqlbiaya_admin) > 0) {
                // Menampilkan hasil
              $result = mysqli_fetch_assoc($sqlbiaya_admin);
              $biayaadmin = $result['bayar'];

            } else {
                echo "Biaya admin tidak ditemukan untuk transaksi ini.";
            }

        $qrtransfer = mysqli_query($con, "INSERT INTO tbl_nota_transaksi  VALUES('','$pelanggan', '$tanggal', '$jenis_trx', '$kode_bank', '$tujuan', '$jumlah','$biayaadmin')") or die(mysqli_error($con));

        if ($kode_bank != '100') {
            //PENGURANGAN SALDO BANK
            $pgl_saldoakhir = mysqli_query($con, "SELECT saldo_akhir FROM tbl_data_bank WHERE kode_bank='$kode_bank'");
            $arrsaldo = mysqli_fetch_assoc($pgl_saldoakhir);
            $saldo_akhir = $arrsaldo['saldo_akhir'];

            $penambahansaldo = $saldo_akhir + $jumlah;

            $update_saldoakhir = mysqli_query($con, "UPDATE tbl_data_bank SET saldo_akhir = '$penambahansaldo' WHERE kode_bank='$kode_bank' ");

            //PENAMBAHAN SALDO CASH
            $pgl_saldocash = mysqli_query($con, "SELECT saldo_akhir FROM tbl_data_bank WHERE kode_bank='1'");
            $arrsaldocash = mysqli_fetch_assoc($pgl_saldocash);
            $saldo_cash = $arrsaldocash['saldo_akhir'];

            $penambahansaldocash = $saldo_cash - $jumlah + $biayaadmin;

            $update_saldocash = mysqli_query($con, "UPDATE tbl_data_bank SET saldo_akhir = '$penambahansaldocash' WHERE kode_bank='1' ");

            // $qrtambah_tblnota = mysqli_query($con, " INSERT into tbl_nota_transaksi VALUES ('','pelanggan', )")or die (mysqli_error($con));
            echo "<script>alert('Transaksi berhasil.'); window.location = '../opt_nota_transaksi/index.php';</script>";           
        } else {
            echo "<script>window.location = '../opt_nota_transaksi/index.php';</script>";
        }
    } else {
        // echo 'pppppppppppppp';
        // echo '<script>window.location = "../admin_nota_transaksi/index.php"</script>';
    }
    ?>
</body>

</html>