<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pembelian</h3>
            </div>
            <div class="card-body">
                <table id="data-transaksi" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Transaksi</th>
                            <th>Tanggal</th>
                            <th>Pembeli</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pembelians as $pb) { ?>
                            <tr>
                                <th><?= $no++ ?></th>
                                <td><?= $pb->no_pembelian ?></td>
                                <td><?= $pb->tanggal ?></td>
                                <td><?= $pb->nama_user ?></td>
                                <td>
                                    <a href="<?= base_url('pembelian/detail/' . $pb->id_pembelian) ?>" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        var data = $("#data-transaksi").DataTable({
            "responsive": true,
            "autoWidth": false
        });
    });
</script>