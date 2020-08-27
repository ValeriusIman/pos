<html moznomarginboxes mozdisallowselectionprint>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN TRANSAKSI</title>
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
                    LAPORAN TRANSAKSI PENJUALAN PRIODE <?= $awal ?> s/d <?= $akhir ?>
                    <br>TOKO VALERIUS
                </span>
            </td>
        </tr>
    </table>
    <hr class="line-title">

    <?php
    foreach ($transaksis as $transaksi) {
        // for ($i = $transaksi->id_transaksi; $i <= $transaksi->transaksi_id; $i++) {
    ?>
        No.Transaksi :<?= $transaksi->no_transaksi ?><br>
        Kasir :<?= $transaksi->nama ?><br>
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Product</th>
                    <th>harga</th>
                    <th>Qty</th>
                    <th>SubTotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item) {
                    if ($item->transaksi_id == $transaksi->id_transaksi) { ?>
                        <tr>
                            <td><?= $item->kode ?></td>
                            <td><?= $item->nama ?></td>
                            <td><?= formatRupiah($item->harga) ?></td>
                            <td><?= $item->qty_item_transaksi ?></td>
                            <td><?= formatRupiah($item->total_item_transaksi) ?></td>
                        </tr>
                <?php }
                } ?>
                <tr>
                    <td colspan="4" align="center">Total</td>
                    <td><?= formatRupiah($transaksi->total_harga) ?></td>
                </tr>
                <tr>
                    <td colspan="4" align="center">Discount</td>
                    <td><?= formatRupiah($transaksi->diskon) ?></td>
                </tr>
                <tr>
                    <td colspan="4" align="center">Grand Total</td>
                    <td><?= formatRupiah($transaksi->grand_total) ?></td>
                </tr>
            </tbody>
            <br>
        </table>
    <?php } ?>
</body>
<!-- <script type="text/javascript">
    window.addEventListener("load", window.print());
</script> -->

</html>