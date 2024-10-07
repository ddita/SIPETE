<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Proses Tambah Saldo</title>
</head>
<body>
  <?php
  session_start();
  require_once '../database/config.php';

  if(isset($con, $_POST['tambahsaldo'])) {
    // Ambil kode_bank dari parameter GET
    $kode_bank = @$_GET['kode_bank'];
    
    // Amankan data input dari user
    $tanggal = trim(mysqli_real_escape_string($con, $_POST['tanggal']));
    $saldo_tambah = trim(mysqli_real_escape_string($con, $_POST['saldo_tambah']));

    // Insert ke tbl_detail_saldo_tambah
    $qrtambah = mysqli_query($con, "INSERT INTO tbl_detail_saldo_tambah (kode_bank, tgl_setor, jumlah_tambah) VALUES('$kode_bank','$tanggal', '$saldo_tambah' )") or die(mysqli_error($con));

    // Ambil saldo terakhir dari tbl_data_bank
    $pgl_saldoakhir = mysqli_query($con, "SELECT saldo_akhir FROM tbl_data_bank WHERE kode_bank='$kode_bank'");
    
    // Jika ditemukan saldo akhir
    if(mysqli_num_rows($pgl_saldoakhir) > 0) {
      $arrsaldo = mysqli_fetch_assoc($pgl_saldoakhir);
      $saldo_akhir = $arrsaldo['saldo_akhir'];

      // Tambahkan saldo baru ke saldo akhir
      $penambahansaldo = $saldo_akhir + $saldo_tambah;

      // Update saldo akhir pada tbl_data_bank
      $update_saldoakhir = mysqli_query($con, "UPDATE tbl_data_bank SET saldo_akhir = '$penambahansaldo' WHERE kode_bank='$kode_bank' ");

      // Redirect ke admin_dashboard setelah berhasil update saldo
      echo '<script>alert("Saldo berhasil ditambahkan."); window.location.href = "../opt_dashboard/index.php";</script>';
      
    } else {
      echo '<script>alert("Kode bank tidak ditemukan."); window.location.href = "../opt_dashboard/index.php";</script>';
    }

  } else {
    // Redirect jika tidak ada submit form
    echo '<script>window.location = "../opt_dashboard/index.php"</script>';
  }

  ?>
</body>
</html>
