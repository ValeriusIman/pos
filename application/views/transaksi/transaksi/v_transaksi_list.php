<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Transaksi</h3>
            </div>
            <div class="card-body">
                <table id="data-transaksi" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Transaksi</th>
                            <th>Tanggal</th>
                            <th>Kasir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($transaksis as $tr) { ?>
                            <tr>
                                <th><?= $no++ ?></th>
                                <td><?= $tr->no_transaksi ?></td>
                                <td><?= $tr->tanggal_transaksi ?></td>
                                <td><?= $tr->nama_user ?></td>
                                <td>
                                    <a href="<?= base_url('transaksi/detail/' . $tr->id_transaksi) ?>" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                    <!-- <button class="btn btn-sm btn-danger hapus" data-id="<?= $tr->id_barang ?>"><i class="fas fa-fw fa-trash-alt"></i> Delete</button> -->
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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