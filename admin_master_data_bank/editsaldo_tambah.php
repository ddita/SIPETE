<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once '../database/config.php';

    if (isset($_POST['editsaldo_tambah'])) {
        $id = $_POST['id'];
        $kode_bank = $_POST['kode_bank'];
        $tanggal_setor = $_POST['tanggal_setor'];
        $inputjumlah_tambah = $_POST['jumlah_tambah'];

        $qrdtlsaldotambah=mysqli_query($con,"SELECT kode_bank , jumlah_tambah FROM tbl_detail_saldo_tambah WHERE id='$id'")or die(mysqli_error($con));

        $dt_saldotambah = mysqli_fetch_assoc($qrdtlsaldotambah);
        $kode_bank = $dt_saldotambah['kode_bank'];
        $jumlahtambah = $dt_saldotambah['jumlah_tambah'];

        $qrdtbank=mysqli_query($con,"SELECT saldo_akhir  FROM tbl_data_bank WHERE kode_bank='$kode_bank'")or die(mysqli_error($con));
        $dt_bank = mysqli_fetch_assoc($qrdtbank);
        $saldo_akhir = $dt_bank['saldo_akhir'];

        $newsaldo_akhir = $saldo_akhir - $jumlahtambah + $inputjumlah_tambah;
        $update_saldoakhir = mysqli_query($con,"UPDATE tbl_data_bank SET saldo_akhir='$newsaldo_akhir' WHERE kode_bank='$kode_bank'")or die (mysqli_error($con));

        $queryupdate = mysqli_query($con,"UPDATE tbl_detail_saldo_tambah SET tgl_setor='$tanggal_setor', jumlah_tambah='$inputjumlah_tambah' WHERE kode_bank='$kode_bank'") or die (mysqli_error($con));
        ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
          <script>
            swal("Berhasil !", "Detail Saldo Tambah Berhasil di Edit", "success");
            setTimeout(function() {
            window.location.href ="../admin_master_data_bank/detail_saldo_tambah.php?kode_bank=<?=$dt_saldotambah['kode_bank'];?>";
          }, 2000);
          </script>
          <!-- <script>
            alert("pppppp");
            window.location.href ="../admin_master_data_bank/detail_saldo_tambah.php?kode_bank=<?=$dt_saldotambah['kode_bank'];?>";

          </script> -->
        <?php
        }
        ?>

</body>
</html>