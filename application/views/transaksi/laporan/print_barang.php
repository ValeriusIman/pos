<html moznomarginboxes mozdisallowselectionprint>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN DATA BARANG</title>
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
                    LAPORAN DATA BARANG
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
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>HPP</th>
                <th>Profit</th>
                <th>Harga Jual</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($barang as $br) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $br->kode_barang ?></td>
                    <td><?= $br->nama_barang ?></td>
                    <td><?= formatRupiah($br->HPP) ?></td>
                    <td><?= formatRupiah($br->profit) ?></td>
                    <td><?= formatRupiah($br->harga_barang) ?></td>
                    <td><?= $br->stock ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <br>
    </table>
</body>

</html>