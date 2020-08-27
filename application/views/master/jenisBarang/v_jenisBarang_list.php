<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data <?= $title ?></h3>
            </div>
            <div class="card-body">
                <table id="data-jenis-barang" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kategori Barang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($jenisBarangs as $jb) { ?>
                            <tr>
                                <th><?= $no++ ?></th>
                                <td><?= $jb->jenis_barang ?></td>
                                <td>
                                    <a href="<?= base_url('jenisBarang/edit/' .  $jb->id_jenis_barang) ?>" class="btn btn-sm btn-success"><i class="fas fa=fw fa-edit"></i> Edit</a>
                                    <button class="btn btn-sm btn-danger hapus" data-id="<?= $jb->id_jenis_barang  ?>"><i class="fas fa-fw fa-trash-alt"></i> Delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Kategori Barang</h3>
            </div>
            <div class="card-body">
                <form id="form-Jenis-Barang" class="form-horizontal">
                    <div class="form-group">
                        <input type="text" class="form-control" id="jenisBarang" name="jenisBarang" placeholder="Jenis Barang">
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btn-simpan" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        var data = $("#data-jenis-barang").DataTable({
            "responsive": true,
            "autoWidth": false
        });

        $("#btn-simpan").on('click', function() {
            let validate = $("#form-Jenis-Barang").valid();
            if (validate) {
                $("#form-Jenis-Barang");
                prosesTambah();
            }
        });

        $("#form-Jenis-Barang").validate({
            rules: {
                jenisBarang: {
                    required: true
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        function prosesTambah() {
            $("#form-Jenis-Barang").on('click', function() {
                var jenisBarang = $('#jenisBarang').val();
                $.ajax({
                    type: "post",
                    url: "<?= base_url("jenisBarang/tambah") ?>",
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
                        jenis_barang: jenisBarang
                    },
                    success: function(data) {
                        swal({
                            title: 'Berhasil Menambah Kategori Barang',
                            text: jenisBarang,
                            type: 'success'
                        }).then(function() {
                            location.reload();
                        })
                    }
                })
            });
        }

        $('#data-jenis-barang').on('click', '.hapus', function() {
            var id = $(this).data('id');
            swal({
                title: 'Konfirmasi',
                text: "Anda ingin menghapus",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Tidak',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?= base_url('JenisBarang/delete') ?>",
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
                            id_jenis_barang: id
                        },
                        success: function(data) {
                            swal({
                                title: 'Hapus',
                                text: 'Berhasil Terhapus',
                                type: 'success'
                            }).then(function() {
                                location.reload();
                            })
                        }
                    })
                } else if (result.dismiss === swal.DismissReason.cancel) {
                    swal(
                        'Batal',
                        'Anda membatalkan penghapusan',
                        'error'
                    )
                }
            })
        });
    });
</script>