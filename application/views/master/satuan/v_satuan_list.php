<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Satuan</h3>
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
                                    <a href="<?= base_url('satuan/edit/' . $satuan->id_satuan) ?>" class="btn btn-sm btn-success"><i class="fas fa=fw fa-edit"></i> Edit</a>
                                    <button class="btn btn-sm btn-danger hapus" data-id="<?= $satuan->id_satuan ?>"><i class="fas fa-fw fa-trash-alt"></i> Delete</button>
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
                <h3 class="card-title">Tambah Satuan</h3>
            </div>
            <div class="card-body">
                <form id="form-satuan">
                    <div class="form-group">
                        <input type="text" class="form-control" id="satuanBarang" name="satuanBarang" placeholder="Satuan Barang">
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
        var data = $("#data-satuan").DataTable({
            "responsive": true,
            "autoWidth": false
        });

        $('[data-mask]').inputmask()

        $("#btn-simpan").on('click', function() {
            let validate = $("#form-satuan").valid();
            if (validate) {
                $("#form-satuan");
                prosesTambah();
            }
        });

        $("#form-satuan").validate({
            rules: {
                satuanBarang: {
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
            $("#form-satuan").on('click', function() {
                var satuanBarang = $('#satuanBarang').val();
                $.ajax({
                    type: "post",
                    url: "<?= base_url("satuan/tambah") ?>",
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
                        satuan_barang: satuanBarang
                    },
                    success: function(data) {
                        swal({
                            title: 'Berhasil Menambah Satuan Barang',
                            text: satuanBarang,
                            type: 'success'
                        }).then(function() {
                            location.reload();
                        })
                    }
                })
            });
        }
        $('#data-satuan').on('click', '.hapus', function() {
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
                        url: "<?= base_url('satuan/delete') ?>",
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
                            id_satuan: id
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