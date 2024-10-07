<!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Export Nota</title>
    <?php
    include '../listlink.php';
    ?>
  </head>
<body>
<table id="tableData" class="table table-bordered table-striped table-sm" style="display:none;">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Jenis Transaksi</th>
            <th>Dari</th>
            <th>Rekening Tujuan</th>
            <th>Jumlah</th>
            <th>Biaya Admin</th>
        </tr>
    </thead>
    <tbody>
        <?php
            require_once '../database/config.php';
            $tanggalterpilih = @$_GET['tanggal'];
            $pgl_tanggal = mysqli_query($con, "SELECT * FROM tbl_nota_transaksi WHERE tanggal = '$tanggalterpilih'") or die(mysqli_error($con));
            $pgl_laba  = mysqli_query($con, "SELECT SUM(admin) as laba FROM tbl_nota_transaksi WHERE tanggal = '$tanggalterpilih'") or die(mysqli_error($con));
            $arrlaba  = mysqli_fetch_array($pgl_laba);
            $totallaba = $arrlaba['laba'];
            $pgl_jml  = mysqli_query($con, "SELECT SUM(jumlah) as jumlah FROM tbl_nota_transaksi WHERE tanggal = '$tanggalterpilih'") or die(mysqli_error($con));
            $arrjml  = mysqli_fetch_array($pgl_jml);
            $totaljml = $arrjml['jumlah'];
            
            $no = 1;
            $rv_transfer = mysqli_num_rows($pgl_tanggal);
            if ($rv_transfer > 0) {
            while ($dt_transfer = mysqli_fetch_assoc($pgl_tanggal)) {
                $id = $dt_transfer['id_nota'];
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $dt_transfer['tanggal']; ?></td>
                <td><?= $dt_transfer['pelanggan']; ?></td>
                <td><?= $dt_transfer['jenis_trx']; ?></td>
                <td>
                    <?php
                    $kode_rekening = $dt_transfer['dari'];
                    if ($kode_rekening == '100') {
                        $dari = "Rekening Pelanggan";
                    } else {
                        $qrbank = mysqli_query($con, "SELECT nama_bank FROM tbl_data_bank WHERE kode_bank='$kode_rekening'") or die(mysqli_error($con));
                        $arrbank = mysqli_fetch_assoc($qrbank);
                        $dari = $arrbank['nama_bank'];
                    }
                    ?>
                    <?= $dari ?>
                </td>
                <td><?= $dt_transfer['tujuan']; ?></td>
                <td>Rp. <?= number_format($dt_transfer['jumlah'], 0, ",", ".") ?> ,-</td>
                <td>Rp. <?= number_format($dt_transfer['admin'], 0, ",", ".") ?> ,-</td>
            </tr>
        <?php
            }
            } else {
        ?>
            <tr>
                <td colspan="9">Tidak ditemukan data detail saldo tambah pada database</td>
            </tr>
        <?php
            }
        ?>
    </tbody>
    <tfoot>
        <td colspan="6" align="right"><font style="font-size: 20px;"><b> TOTAL TRANSAKSI : </b></font></td>
        <td><font style="font-size: 18px;"><b>Rp <?=number_format($totaljml,0,",",".");?>,-</b></font></td>
        <td><font style="font-size: 18px;"><b>Rp <?=number_format($totallaba,0,",",".");?>,-</b></font></td>
    </tfoot>
</table>

    <script>
        function exportTableToExcel(tableID, filename = '') {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
            
            // Specify file name
            filename = filename ? filename + '.xls' : 'excel_data.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                // Triggering the function
                downloadLink.click();
            }
        }

        window.onload = function() {
            exportTableToExcel('tableData', 'Ekspor-Data-<?=$tanggalterpilih;?>');
        };
    </script>
</body>
</html>
