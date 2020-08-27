<html moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Print Nota</title>
    <style type="text/css">
        html {
            font-family: "verdana, arial";
        }

        .content {
            width: 80mm;
            font-size: 12px;
            padding: 5px
        }

        .title {
            text-align: center;
            font-size: 13px;
            padding-bottom: 5px;
            border-bottom: 1px dashed;
        }

        .head {
            margin-top: 5px;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid;
        }

        table {
            width: 100%;
            font-size: 12px;
        }

        .thanks {
            margin-top: 10px;
            padding-top: 10px;
            text-align: center;
            border-top: 1px dashed;
        }

        @media print {
            @page {
                width: 80px;
                margin: 0mm;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="content">
        <div class="title">
            <b>TOKO VALERIUS</b>
            <br>
            CUPUWATU II RT.06/02<br>
            PURWOMARTANI<br>
            KALASAN SLEMAN YOGYAKARTA<br>
        </div>

        <div class="head">
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <td style="width: 200px;"><?= $transaksi->tanggal_transaksi ?></td>
                    <td>Ksr</td>
                    <td style="text-align: center; width: 10px">:</td>
                    <td style="text-align: right"><?= $transaksi->nama ?></td>
                </tr>
                <tr>
                    <td><?= $transaksi->no_transaksi ?></td>
                    <td>Pel</td>
                    <td style="text-align: center; width: 10px">:</td>
                    <td style="text-align: right"><?= $transaksi->nama_pelanggan ?></td>
                </tr>
            </table>
        </div>
        <div class="transaction">
            <table class="transaction-table" cellspacing="0" cellpadding="0">
                <?php
                foreach ($item as $it) { ?>
                    <tr>
                        <td style="width: 50px"><?= $it->nama ?></td>
                        <td style="width: 50px"><?= $it->qty_item_transaksi ?> </td>
                        <td style="width: 50px"> X </td>
                        <td> <?= formatRupiah($it->harga_item_transaksi) ?></td>
                        <td><?= formatRupiah($it->total_item_transaksi) ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="thanks">
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <td>Harga Jual</td>
                    <td style="text-align: center; width: 10px">:</td>
                    <td style="text-align: right"><?= formatRupiah($transaksi->total_harga) ?></td>
                </tr>
                <tr>
                    <td>Discount</td>
                    <td style="text-align: center; width: 10px">:</td>
                    <td style="text-align: right"><?= formatRupiah($transaksi->diskon) ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td style="text-align: center; width: 10px">:</td>
                    <td style="text-align: right"><?= formatRupiah($transaksi->grand_total) ?></td>
                </tr>
                <tr>
                    <td>Tunai</td>
                    <td style="text-align: center; width: 10px">:</td>
                    <td style="text-align: right"><?= formatRupiah($transaksi->bayar) ?></td>
                </tr>
                <tr>
                    <td>Kembalian</td>
                    <td style="text-align: center; width: 10px">:</td>
                    <td style="text-align: right"><?= formatRupiah($transaksi->kembalian) ?></td>
                </tr>
            </table>
        </div>
        <div class="thanks">
            Mohon periksa kembali jumlah barang, Harga dan Uang Kembalian.
            <br>
            ***Trimakasih atas kunjungannya***
        </div>
    </div>

</body>

</html>