<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Satuan Terhapus</h3>
            </div>
            <div class="card-body">
                <table id="data-satuan" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Satuan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($satuans as $satuan) { ?>
                            <tr>
                                <th><?= $no++ ?></th>
                                <td><?= $satuan->satuan_barang ?></td>
                                <td>
                                    <button class="btn btn-sm btn-danger hapus" data-id="<?= $satuan->id_satuan ?>"><i class="fas fa-fw fa-trash-restore"></i> Restore</button>
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
        var data = $("#data-satuan").DataTable({
            "responsive": true,
            "autoWidth": false
        });

        $('#data-satuan').on('click', '.hapus', function() {
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
                        url: "<?= base_url('satuan/restore') ?>",
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