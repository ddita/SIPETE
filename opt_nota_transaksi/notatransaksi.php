<!DOCTYPE html>
<html lang="en">
<head>
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
<title>Nota : <?=$id_nota?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>58mm Thermal Printer</title>
    <style>
        @page {
            size: 58mm;
            margin: 0;
        }

        body {
            width: 58mm;
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 10px;
        }

        .receipt {
            padding: 2mm;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .line {
            border-bottom: 1px dashed black;
            margin: 5mm 0;
        }

        .items {
            margin-bottom: 5mm;
        }

        .items .item {
            display: flex;
            justify-content: space-between;
        }

        .footer {
            text-align: center;
            margin-top: 5mm;
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

    <div class="row">
      <div class="col-12">
       <table class="table table-borderless table-sm">
            <thead>
                <th>Rek Tujuan</th>
                <th width="3%">Jumlah</th>
                <th>Admin</th>
                <th>Total Bayar</th>
            </thead>
            <tbody>
            <?php
            $no = 1;
            $id_nota = @$_GET['id_nota'];
            $qr_nota = mysqli_query($con, "SELECT * FROM tbl_nota_transaksi WHERE id_nota='$id_nota'") or die (mysqli_error($con));
            $admin = mysqli_fetch_assoc($qr_nota);
            $byr_admin = $admin['admin'];
            $jumlah = $admin['jumlah'];

            $totalharga = $jumlah+$byr_admin;

            if (mysqli_num_rows($qr_nota)> 0) {
              while ($dt_nota = mysqli_fetch_array($qr_nota)){
                ?>
                <tr>
                <td font style="font-size: 10px;"><?=$no++;?>&nbsp<?= $dt_nota['tujuan']; ?></font></td>
                <td font style="font-size: 10px;"><?= $dt_nota['jumlah']; ?></font></td>
                <td font style="font-size: 10px;"><?= number_format($dt_nota['admin'],0,",",".");?></font></td>
                <td font style="font-size: 10px;"><?= $dt_nota['subtotal']; ?></font></td>
              </tr>
              <?php
              }
            }
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <td font style="font-size: 13px;" colspan="4"> <b>-------------------------------------------------</b> </td>
                </tr>
                <tr>
                    <td font style="font-size: 13px;" colspan="3"> <b>Total Bayar</b> </td>
                    <td font style="font-size: 13px;"> <b><?=number_format($totalharga,0,",",".");?></b> </td>
                </tr>
                <!-- <tr>
                    <td font style="font-size: 13px;" colspan="3"> <b>PPN (11%)</b> </td>
                    <td font style="font-size: 13px;"> <b><?=number_format($ppn,0,",",".");?></b> </td>
                </tr>
                <tr>
                    <td font style="font-size: 13px;" colspan="3"> <b>PPH (2%)</b> </td>
                    <td font style="font-size: 13px;"> <b><?=number_format($pph,0,",",".");?></b> </td>
                </tr> -->
                <!-- <tr>
                    <td font style="font-size: 13px;" colspan="4"> <b>-------------------------------------------------</b> </td>
                </tr>
                <tr>
                    <td font style="font-size: 15px;" colspan="3"> <b>TOTAL BAYAR</b> </td>
                    <td font style="font-size: 16px;"><b><?=number_format($totalharga,0,",",".");?></b> </td>
                </tr> -->
                <tr>
                    <td font style="font-size: 13px;" colspan="4"> <b>-------------------------------------------------</b> </td>
                </tr>
            </tfoot>
            <tbody>

            </tbody>
        </tbody>
       </table>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <center>
        <font style="font-size: 12px;"><b> Terimakesuh atas Transaksi anda!</b></font>
        <br><font style="font-size: 12px;">Rejeki anda sebagian rejeki kami</font>
        <br><font style="font-size: 12px;">Kontak Aduan WA (0838 0739 5440)</font>
        </center>
      </div>
    </div>
</body>
</html>