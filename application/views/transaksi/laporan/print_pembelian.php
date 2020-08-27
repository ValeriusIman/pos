<html moznomarginboxes mozdisallowselectionprint>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN PEMBELIAN</title>
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
                    LAPORAN TRANSAKSI PEMBELIAN PRIODE <?= $awal ?> s/d <?= $akhir ?>
                    <br>TOKO VALERIUS
                </span>
            </td>
        </tr>
    </table>
    <hr class="line-title">

    <?php
    foreach ($pembelians as $pembelian) {
    ?>
        No.Pembelian :<?= $pembelian->no_pembelian ?><br>
        Penanggung Jawab :<?= $pembelian->nama ?><br>
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Isi</th>
                    <th>Harga</th>
                    <th>HPP</th>
                    <th>Profit</th>
                    <th>harga Jual</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item) {
                    if ($item->transaksi_beli_id == $pembelian->id_pembelian) { ?>
                        <tr>
                            <td><?= $item->kode ?></td>
                            <td><?= $item->nama ?></td>
                            <td><?= $item->qty_item_beli ?></td>
                            <td><?= $item->isi ?></td>
                            <td><?= formatRupiah($item->harga_item_beli) ?></td>
                            <td><?= formatRupiah($item->HPP) ?></td>
                            <td><?= formatRupiah($item->profit) ?></td>
                            <td><?= formatRupiah($item->harga_jual) ?></td>
                        </tr>
                <?php }
                } ?>
                <tr>
                    <td colspan="7" align="center">Total</td>
                    <td><?= formatRupiah($pembelian->biaya) ?></td>
                </tr>
            </tbody>
            <br>
        </table>
    <?php } ?>
</body>

</html>