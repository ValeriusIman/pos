<html moznomarginboxes mozdisallowselectionprint>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN LABA RUGI</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <table style="width: 100%;">
        <tr>
            <td align="center">
                <span style="line-height: 1.6; font-weight: bold;">
                    LAPORAN LABA RUGI PRIODE <?= $awal ?> s/d <?= $akhir ?>
                    <br>TOKO VALERIUS
                </span>
            </td>
        </tr>
    </table>
    <hr class="line-title">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Product</th>
                <th>HPP</th>
                <th>Penjualan</th>
                <th>Qty</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($items as $item) {
                $subTotal = $item->harga_barang * $item->qty_item_transaksi ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $item->tanggal_transaksi ?></td>
                    <td><?= $item->nama ?></td>
                    <td><?= formatRupiah($item->HPP) ?></td>
                    <td><?= formatRupiah($item->harga_barang) ?></td>
                    <td><?= $item->qty_item_transaksi ?></td>
                    <td><?= formatRupiah($subTotal) ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="6" align="center">Total</td>
                <?php foreach ($jumlah as $jml) { ?>
                    <td><?= formatRupiah($jml->total) ?></td>
                <?php } ?>
            </tr>
            <tr>
                <td colspan="6" align="center">Discount</td>
                <?php foreach ($jumlah as $jml) { ?>
                    <td><?= formatRupiah($jml->diskon) ?></td>
                <?php } ?>
            </tr>
            <tr>
                <td colspan="6" align="center">HPP</td>
                <?php foreach ($jumlah as $jml) { ?>
                    <td><?= formatRupiah($jml->hpp_total) ?></td>
                <?php } ?>
            </tr>
            <tr>
                <td colspan="6" align="center">Laba Kotor</td>
                <?php foreach ($jumlah as $jml) {
                    $labaKotor = ($jml->total - $jml->hpp_total) - $jml->diskon ?>
                    <td><?= formatRupiah($labaKotor) ?></td>
                <?php } ?>
            </tr>
            <tr>
                <td colspan="6" align="center">Potongan</td>
                <td><?= formatRupiah($biaya) ?></td>
            </tr>
            <tr>
                <td colspan="6" align="center">Laba Bersih</td>
                <?php foreach ($jumlah as $jml) {
                    $labaKotor = ($jml->total - $jml->hpp_total) - $jml->diskon;
                    $labaBersih = $labaKotor - $biaya ?>
                    <td><?= formatRupiah($labaBersih) ?></td>
                <?php } ?>
            </tr>
        </tbody>
        <br>
    </table>
</body>

</html>