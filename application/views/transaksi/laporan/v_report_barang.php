<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <form id="pencarian" method="POST" action="<?= base_url('barang/printBarang') ?>">
                    <div class="form-group">
                        <div class="row">
                            <label for="filter" class="col-1 col-form-label">Kategori</label>
                            <div class="col-4">
                                <select id="filter" name="filter" class="form-control select2" style="width: 100%;">
                                    <option value=""></option>
                                    <option value="0">All</option>
                                    <?php
                                    foreach ($jenisBarangs as $jb) {
                                        echo "<option value='$jb->id_jenis_barang'> $jb->jenis_barang </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <button type="button" id="btn-filter" class="btn btn-success"><i class="fab fa-sistrix"></i></i> Tampilkan</button>
                            </div>
                            <div class="col">
                                <button type="submit" id="download" class="btn btn-primary"><i class="fas fa-file-pdf"></i> PDF</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">

                <table id="data-barang" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>HPP</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody id="barang">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        var data = $("#data-barang").DataTable({
            "responsive": true,
            "autoWidth": false
        });
        $('#filter').select2({
            placeholder: "Filter Kategori Barang"
        });

        $('#btn-filter').on('click', function(event) {
            event.preventDefault();
            var filter = $('#filter').val();
            $.ajax({
                url: "<?= base_url('barang/filter') ?>",
                type: "post",
                data: {
                    filter: filter,
                    proses: true
                },
                dataType: "JSON",
                success: function(data) {
                    var baris = '';
                    for (var i = 0; i < data.length; i++) {
                        var no = i + 1;
                        baris += '<tr>' +
                            '<td>' + no + '</td>' +
                            '<td>' + data[i].kode_barang + '</td>' +
                            '<td>' + data[i].nama_barang + '</td>' +
                            '<td>' + data[i].jenis_barang + '</td>' +
                            '<td>' + data[i].HPP + '</td>' +
                            '<td>' + data[i].stock + '</td>' +
                            '</tr>';
                    }
                    $('#barang').html(baris);
                    if (baris == '') {
                        swal({
                            title: 'Data Tidak Ada',
                            type: 'error'
                        })
                    }
                }
            })
        });
    });
</script>