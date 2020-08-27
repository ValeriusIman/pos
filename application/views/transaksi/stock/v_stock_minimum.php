<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Stock Minimum</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="stock-min" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($minimum as $min) { ?>
                            <tr>
                                <th><?= $no++ ?></th>
                                <td><?= $min->kode_barang ?></td>
                                <td><?= $min->nama_barang ?></td>
                                <td><?= $min->stock ?></td>
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
        var data = $("#stock-min").DataTable({
            "responsive": true,
            "autoWidth": false
        });
    })
</script>