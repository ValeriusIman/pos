<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <h2 class="page-header">
                <i class="fas fa-globe"></i> CV. Karya Muda Mandiri
                <small class="float-right">Date: <?= $stock->date ?></small>
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
            <b>No. Transaksi : <?= $stock->no_struck ?></</b> <br>
                <b>Penanggung Jawab : <?= $stock->nama ?></</b> <br>
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
                        <th>Supplier</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($stock->type == "In") { ?>
                        <?php
                        foreach ($stockIn as $si) { ?>
                            <tr>
                                <th><?= $si->kode_barang ?></th>
                                <td><?= $si->nama_barang ?></td>
                                <td><?= $si->nama_supplier ?></td>
                                <td><?= $si->qty ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <?php
                        foreach ($stockOut as $so) { ?>
                            <tr>
                                <th><?= $so->kode_barang ?></th>
                                <td><?= $so->nama_barang ?></td>
                                <td><?= $so->nama_supplier ?></td>
                                <td><?= $so->qty ?></td>
                            </tr>
                        <?php } ?>
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
            <?= $stock->detail ?>
        </div>
    </div>
    <!-- /.row -->
</section>
<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>