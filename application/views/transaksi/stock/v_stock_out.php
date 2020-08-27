<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Stock Out</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="stock-in" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Struck</th>
                            <th>tanggal</th>
                            <th>Penanggung Jawab</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($stocks as $stock) { ?>
                            <tr>
                                <th><?= $no++ ?></th>
                                <td><?= $stock->no_struck ?></td>
                                <td><?= $stock->date ?></td>
                                <td><?= $stock->user_nama ?></td>
                                <td>
                                    <a href="<?= base_url('stock/detail/' . $stock->id_stock) ?>" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-fw fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>