<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Supplier Terhapus</h3>
            </div>
            <div class="card-body">
                <table id="data-supplier" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Supplier</th>
                            <th>No Telp</th>
                            <th>Alamat</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($suppliers as $supplier) { ?>
                            <tr>
                                <th><?= $no++ ?></th>
                                <td><?= $supplier->nama_supplier ?></td>
                                <td><?= $supplier->no_telp ?></td>
                                <td><?= $supplier->alamat ?></td>
                                <td><?= $supplier->keterangan ?></td>
                                <td>
                                    <button class="btn btn-sm btn-danger hapus" data-id="<?= $supplier->id_supplier ?>"><i class="fas fa-fw fa-trash-restore"></i> Restore</button>
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
        var data = $("#data-supplier").DataTable({
            "responsive": true,
            "autoWidth": false
        });

        $('#data-supplier').on('click', '.hapus', function() {
            var id = $(this).data('id');
            swal({
                title: 'Konfirmasi',
                text: "Anda ingin mengembalikan data ini?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Tidak',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?= base_url('supplier/restore') ?>",
                        method: "post",
                        beforeSend: function() {
                            swal({
                                title: 'Menunggu',
                                html: 'Memproses data',
                                onOpen: () => {
                                    swal.showLoading()
                                }
                            })
                        },
                        data: {
                            id: id
                        },
                        success: function(data) {
                            swal({
                                title: 'Berhasil',
                                text: 'Berhasil Restore Data',
                                type: 'success'
                            }).then(function() {
                                location.reload();
                            })
                        }
                    })
                } else if (result.dismiss === swal.DismissReason.cancel) {
                    swal(
                        'Batal',
                        'Anda membatalkan Pengembalian Data',
                        'error'
                    )
                }
            })
        });

    });
</script>