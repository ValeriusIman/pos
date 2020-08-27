<div class="row">
    <div class="col-9">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Supplier</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="data-supplier" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Supplier</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($suppliers as $sp) { ?>
                            <tr>
                                <th><?= $no++ ?></th>
                                <td><?= $sp->nama_supplier ?></td>
                                <td><?= $sp->keterangan ?></td>
                                <td>
                                    <a href="<?= base_url('supplier/edit/' . $sp->id_supplier) ?>" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                    <button class="btn btn-sm btn-danger hapus" data-id="<?= $sp->id_supplier ?>"><i class="fas fa-fw fa-trash-alt"></i> Delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Supplier</h3>
            </div>
            <div class="card-body">
                <form id="form-supplier">
                    <div class="form-group">
                        <input type="text" class="form-control" id="namaSupplier" name="namaSupplier" placeholder="Nama Supplier">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="noTelp" name="noTelp" placeholder="No Telp" data-inputmask='"mask": "9999-9999-9999"' data-mask>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Supplier">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Keterangan" id="keterangan" name="keterangan"></textarea>
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
        var data = $("#data-supplier").DataTable({
            "responsive": true,
            "autoWidth": false
        });
        $('[data-mask]').inputmask()

        $("#btn-simpan").on('click', function() {
            let validate = $("#form-supplier").valid();
            if (validate) {
                $("#form-supplier");
                prosesTambah();
            }
        });
        $("#form-supplier").validate({
            rules: {
                namaSupplier: {
                    required: true
                },
                noTelp: {
                    required: true
                },
                alamat: {
                    required: true
                },
                keterangan: {
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
            $("#form-supplier").on('click', function() {
                var namaSupplier = $('#namaSupplier').val();
                var noTelp = $('#noTelp').val();
                var alamat = $('#alamat').val();
                var keterangan = $('#keterangan').val();
                $.ajax({
                    type: "post",
                    url: "<?= base_url("supplier/tambah") ?>",
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
                        nama_supplier: namaSupplier,
                        no_telp: noTelp,
                        alamat: alamat,
                        keterangan: keterangan
                    },
                    success: function(data) {
                        swal({
                            title: 'Berhasil Menambah Supplier',
                            text: namaSupplier,
                            type: 'success'
                        }).then(function() {
                            location.reload();
                        })
                    }
                })
            });
        }
        $('#data-supplier').on('click', '.hapus', function() {
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
                        url: "<?= base_url('supplier/delete') ?>",
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
                            id_supplier: id
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