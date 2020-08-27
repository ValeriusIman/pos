<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data <?= $title ?></h3>
            </div>
            <div class="card-body">

                <table id="dataPelanggan" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>No Telp</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pelanggans as $pelanggan) { ?>
                            <tr>
                                <th><?= $no++ ?></th>
                                <td><?= $pelanggan->nama_pelanggan ?></td>
                                <td><?= $pelanggan->no_telp ?></td>
                                <td>
                                    <?php if ($pelanggan->id_pelanggan != 12) { ?>
                                        <a href="<?= base_url('pelanggan/edit/' . $pelanggan->id_pelanggan) ?>" class="btn btn-sm btn-success"><i class="fas fa=fw fa-edit"></i> Edit</a>
                                        <button class="btn btn-sm btn-danger hapus" data-id="<?= $pelanggan->id_pelanggan ?>"><i class="fas fa-fw fa-trash-alt"></i> Delete</button>
                                    <?php } ?>
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
                <h3 class="card-title">Tambah Pelanggan</h3>
            </div>
            <div class="card-body">
                <form id="form-pelanggan">
                    <div class="form-group">
                        <input type="text" class="form-control" id="namaPelanggan" name="namaPelanggan" placeholder="Nama Pelanggan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="noTelp" name="noTelp" placeholder="No Telp" data-inputmask='"mask": "9999-9999-9999"' data-mask>
                    </div>
                    <div class="form-group">
                        <button id="btn-simpan" type="button" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        var data = $("#dataPelanggan").DataTable({
            "responsive": true,
            "autoWidth": false
        });
        $('[data-mask]').inputmask()

        $("#btn-simpan").on('click', function() {
            let validate = $("#form-pelanggan").valid();
            if (validate) {
                $("#form-pelanggan");
                prosesTambah();
            }
        });

        $("#form-pelanggan").validate({
            rules: {
                namaPelanggan: {
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
            $("#form-pelanggan").on('click', function() {
                var namaPelanggan = $('#namaPelanggan').val();
                var noTelp = $('#noTelp').val();
                $.ajax({
                    type: "post",
                    url: "<?= base_url("pelanggan/tambah") ?>",
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
                        nama_pelanggan: namaPelanggan,
                        no_telp: noTelp
                    },
                    success: function(data) {
                        swal({
                            title: 'Berhasil Menambah Pelanggan',
                            text: namaPelanggan,
                            type: 'success'
                        }).then(function() {
                            location.reload();
                        })
                        $('#tambahPelanggan').modal('hide');
                        $('#namaPelanggan').val('');
                        $('#noTelp').val('');
                    }
                })
            });
        }

        $('#dataPelanggan').on('click', '.hapus', function() {
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
                        url: "<?= base_url('pelanggan/delete') ?>",
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
                            id_pelanggan: id
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