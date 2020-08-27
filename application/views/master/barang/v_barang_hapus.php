<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Barang Terhapus</h3>
            </div>
            <div class="card-body">
                <table id="data-barang" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($barangs as $barang) { ?>
                            <tr>
                                <th><?= $no++ ?></th>
                                <td><?= $barang->kode_barang ?></td>
                                <td><?= $barang->nama_barang ?></td>
                                <td><?= $barang->kategori ?></td>
                                <td><?= $barang->satuan ?></td>
                                <td>
                                    <button class="btn btn-sm btn-danger hapus" data-id="<?= $barang->id_barang ?>"><i class="fas fa-fw fa-trash-restore"></i> Restore</button>
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
        var data = $("#data-barang").DataTable({
            "responsive": true,
            "autoWidth": false
        });

        $('#data-barang').on('click', '.hapus', function() {
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
                        url: "<?= base_url('barang/restore') ?>",
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