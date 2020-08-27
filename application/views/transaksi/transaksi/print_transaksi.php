<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <h2 class="page-header">
                <i class="fas fa-globe"></i> CV. Karya Muda Mandiri
                <small class="float-right">Date: <?= $transaksi->tanggal_transaksi ?></small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <strong>TOKO VALERIUS</strong>
            <address>
                CUPUWATU II RT.06/02<br>
                PURWOMARTANI<br>
                KALASAN SLEMAN YOGYAKARTA<br>
                Telp: 081364226987<br>
                Email: Supriyatno@student.ukrimuniversity.ac.id
            </address>
        </div>
        <div class="col-sm-4 invoice-col">
            <b>No. Transaksi : <?= $transaksi->no_transaksi ?></b><br>
            <br>
            <b>Ksr :</b> <?= $transaksi->nama ?><br>
            <b>Pel :</b> <?= $transaksi->nama_pelanggan ?><br>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Product</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($item as $it) { ?>
                        <tr>
                            <th><?= $it->kode ?></th>
                            <td><?= $it->nama ?></td>
                            <td><?= formatRupiah($it->harga_item_transaksi) ?></td>
                            <td><?= $it->qty_item_transaksi ?></td>
                            <td><?= formatRupiah($it->total_item_transaksi) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-6">
            <h5><i class="fas fa-info"></i> Note:</h5>
            Mohon periksa kembali jumlah barang, harga dan uang kembalian. Trimakasih atas kunjungannya.
        </div>
        <!-- /.col -->
        <div class="col-6">

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%">Total:</th>
                        <td><?= formatRupiah($transaksi->total_harga) ?></td>
                    </tr>
                    <tr>
                        <th>Discount</th>
                        <td><?= formatRupiah($transaksi->diskon) ?></td>
                    </tr>
                    <tr>
                        <th>Grand Total</th>
                        <td><?= formatRupiah($transaksi->grand_total) ?></td>
                    </tr>
                    <tr>
                        <th>Bayar</th>
                        <td><?= formatRupiah($transaksi->bayar) ?></td>
                    </tr>
                    <tr>
                        <th>Kembalian</th>
                        <td><?= formatRupiah($transaksi->kembalian) ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>