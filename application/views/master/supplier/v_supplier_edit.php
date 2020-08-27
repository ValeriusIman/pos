<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    <div class="post">
                        <p class="lead">Supplier</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Nama Supplier</th>
                                    <td><?= $supplier->nama_supplier ?></td>
                                </tr>
                                <tr>
                                    <th>No Telp</th>
                                    <td><?= $supplier->no_telp ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td><?= $supplier->alamat ?></td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td><?= $supplier->keterangan ?></td>
                                </tr>
                            </table>
                            <a href="<?= base_url("supplier") ?>" class="btn btn-primary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Supplier</h3>
            </div>
            <div class="card-body">
                <form id="form-edit-supplier">
                    <div class="form-group">
                        <input type="text" class="form-control" id="namaSupplier" value="<?= $supplier->nama_supplier ?>" name="namaSupplier" placeholder="Nama Supplier">
                        <input type="hidden" id="idSupplier" value="<?= $supplier->id_supplier ?>" name="idSupplier">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="noTelp" value="<?= $supplier->no_telp ?>" name="noTelp" placeholder="No Telp" data-inputmask='"mask": "9999-9999-9999"' data-mask>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="alamat" value="<?= $supplier->alamat ?>" name="alamat" placeholder="Alamat Supplier">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Keterangan" id="keterangan" name="keterangan"><?= $supplier->keterangan ?></textarea>
                    </div>
                    <div class="form-group">
                        <button id="btn-simpan" type="button" class="btn btn-success edit"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('[data-mask]').inputmask()

        $("#btn-simpan").on('click', function() {
            let validate = $("#form-edit-supplier").valid();
            if (validate) {
                $("#form-edit-supplier");
                prosesEdit();
            }
        });
        $("#form-edit-supplier").validate({
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

        function prosesEdit() {
            $("#form-edit-supplier").on('click', function() {
                var namaSupplier = $('#namaSupplier').val();
                var noTelp = $('#noTelp').val();
                var alamat = $('#alamat').val();
                var keterangan = $('#keterangan').val();
                var idSupplier = $('#idSupplier').val();
                $.ajax({
                    type: "post",
                    url: "<?= base_url("supplier/prosesEdit") ?>",
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
                        keterangan: keterangan,
                        id_supplier: idSupplier
                    },
                    success: function(data) {
                        swal({
                            title: 'Berhasil Merubah Supplier',
                            text: namaSupplier,
                            type: 'success'
                        }).then(function() {
                            location.reload();
                        })
                    }
                })
            });
        };

    });
</script>