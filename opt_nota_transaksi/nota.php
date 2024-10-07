<?php
  require_once '../database/config.php';
   $hari_ini = date('Y-m-d');
   // Memeriksa apakah parameter id_nota ada di URL
   if (isset($_GET['id_nota'])) {
       // Menampung nilai id_nota
       $id_nota = $_GET['id_nota'];
   
   
   
     //panggil jumlah pada hari ini
     $querynota = mysqli_query($con,"SELECT * FROM tbl_nota_transaksi WHERE id_nota='$id_nota'") or die (mysqli_error($con));
     
     //jumlahdata
     $dt_notaa = mysqli_fetch_array($querynota);
     $jmlnotahariini = mysqli_num_rows($querynota);
    //  $idreq = $dt_notaa["id_request"];
     $tglnota = $dt_notaa["tanggal"];
     $kodenota = $dt_notaa["id_nota"];
     $jenis_trx = $dt_notaa["jenis_trx"];
     $tujuan = $dt_notaa["tujuan"];
     $jumlah = $dt_notaa["jumlah"];
     $admin = $dt_notaa["admin"];

    //  $querynota = mysqli_query($con,"SELECT * FROM tbl_request WHERE id_request='$idreq'") or die (mysqli_error($con));
    //  $dt_req = mysqli_fetch_array($querynota);
    //  $idrequest = $dt_req['id_request'];
   }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thermal Printer Receipt</title>
    <style>
        @media print {
            @page {
                margin: 0; /* Removes default page margins */
            }
            body {
                margin: 0;
                padding: 0;
            }
        }

        body, html {
            width: 58mm;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            font-size: 12px;
        }

        .receipt {
            width: 100%;
            padding: 10px;
            text-align: center;
        }

        .header {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }

        .total {
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }

        .thanks {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
        }

        .dashed-line {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="receipt">
    <center>
    <img src="../images/logo.png" height="100px" width="125px">
    </center>
    </div>

    <div class="row">
      <div class="col-12">
        <center>
        <font style="font-size: 15px;"><b> TOKO ALFIKRIS</b></font>
        <br><font style="font-size: 12px;">Desa Pageraji Rt 1 Rw 10</font>
        <br><font style="font-size: 12px;">Kab. Banyumas, WA(081227404040)</font>
        <br><font style="font-size: 12px;">NPWP : 091290.209.09-11.0012</font>  
        <br><font style="font-size: 12px;"><b>- - - - - - - - - - - - - - - - - - - - - - - -</b></font>  
      </center>
      </div>
    </div>
    </div>

    <div class="row">
      <div class="col-12">
       <table class="table table-borderless table-sm">
        <tbody>
            <tr>
                <td><font style="font-size: 12px;">Tgl Trx</font></td>
                <td><font style="font-size: 12px;">:</font></td>
                <td><font style="font-size: 12px;"><?=$tglnota;?></font></td>
            </tr>
            <tr>
                <td><font style="font-size: 12px;">Kode Nota</font></td>
                <td><font style="font-size: 12px;">:</font></td>
                <td><font style="font-size: 12px;"><?=$id_nota;?></font></td>
            </tr>
            <tr>
                <td><font style="font-size: 12px;">Pelanggan</font></td>
                <td><font style="font-size: 12px;">:</font></td>
                <td><font style="font-size: 12px;"><?=$dt_notaa['pelanggan'];?></font></td>
            </tr>
            <tr>
                <td><font style="font-size: 12px;">Jenis Transaksi</font></td>
                <td><font style="font-size: 12px;">:</font></td>
                <td><font style="font-size: 12px;"><?=$dt_notaa['jenis_trx'];?></font></td>
            </tr>
            <tr>
                <td colspan="3"><font style="font-size: 12px;"><b>- - - - - - - - - - - - - - - - - - - - - - - - - - - - -</b></td>
            </tr>
        </tbody>
       </table>
      </div>
    </div>
        <?php
        $id_nota = @$_GET['id_nota'];
        $qr_nota = mysqli_query($con, "SELECT * FROM tbl_nota_transaksi WHERE id_nota='$id_nota'") or die (mysqli_error($con));
        $admin = mysqli_fetch_assoc($qr_nota);
        $byr_admin = $admin['admin'];
        $jumlah = $admin['jumlah'];
        $tujuan = $admin['tujuan'];

        $totalharga = $jumlah+$byr_admin;

        ?>
    <div class="row">
      <div class="col-12">
       <table class="table table-borderless table-sm">
        <tbody>
            <tr>
                <td><font style="font-size: 12px;">Rek Tujuan</font></td>
                <td><font style="font-size: 12px;">:</font></td>
                <td><font style="font-size: 12px;"><?=$tujuan;?></font></td>
            </tr>
            <tr>
                <td><font style="font-size: 12px;">Jumlah</font></td>
                <td><font style="font-size: 12px;">:</font></td>
                <td><font style="font-size: 12px;">Rp <?=number_format($jumlah,0,",",".");?>,-</font></td>
            </tr>
            <tr>
                <td><font style="font-size: 12px;">Biaya Admin</font></td>
                <td><font style="font-size: 12px;">:</font></td>
                <td><font style="font-size: 12px;">Rp <?=number_format($byr_admin,0,",",".");?>,-</font></td>
            </tr>
            <tr>
                <td colspan="3"><font style="font-size: 12px;"><b>- - - - - - - - - - - - - - - - - - - - - - - - - - - - -</b></td>
            </tr>
            <tr>
                <td colspan="2"><font style="font-size: 14px;"><b>TOTAL BAYAR</b></td>
                <td><font style="font-size: 14px;"><b>Rp <?=number_format($totalharga,0,",",".");?>,-</b></td>
            </tr>
            <tr>
                <td colspan="3"><font style="font-size: 12px;"><b>- - - - - - - - - - - - - - - - - - - - - - - - - - - - -</b></td>
            </tr>
        </tbody>
       </table>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <center>
        <font style="font-size: 12px;"><b> Terimakesuh Atas Kepercayaan Anda!</b></font>
        <br><font style="font-size: 12px;">Transaksi anda keuntungan utk kami</font>
        <br><font style="font-size: 12px;">Layanan Komplain WA(081227404040)</font>
        <br><font style="font-size: 12px;"><b>- - - - - - - - - - - - - - - - - - - - - - - -</b></font>  
      </center>
      </div>
    </div>
    </div>

    
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
