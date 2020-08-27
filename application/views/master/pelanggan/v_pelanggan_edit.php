<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    <div class="post">
                        <p class="lead">Pelanggan</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Nama Pelanggan</th>
                                    <td><?= $pelanggan->nama_pelanggan ?></td>
                                </tr>
                                <tr>
                                    <th>No Telp</th>
                                    <td><?= $pelanggan->no_telp ?></td>
                                </tr>
                            </table>
                            <a href="<?= base_url("pelanggan") ?>" class="btn btn-primary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Pelanggan</h3>
            </div>
            <div class="card-body">
                <form id="form-edit-pelanggan">
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?= $pelanggan->nama_pelanggan ?>" id="namaPelanggan" name="namaPelanggan" placeholder="Nama Pelanggan">
                        <input type="hidden" value="<?= $pelanggan->id_pelanggan ?>" id="idPelanggan" name="idPelanggan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?= $pelanggan->no_telp ?>" id="noTelp" name="noTelp" placeholder="No Telp" data-inputmask='"mask": "9999-9999-9999"' data-mask>
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
            let validate = $("#form-edit-pelanggan").valid();
            if (validate) {
                $("#form-edit-satuan");
                prosesEdit();
            }
        });
        $("#form-edit-pelanggan").validate({
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

        function prosesEdit() {
            $("#form-edit-pelanggan").on('click', function() {
                var namaPelanggan = $('#namaPelanggan').val();
                var noTelp = $('#noTelp').val();
                var idPelanggan = $('#idPelanggan').val();
                $.ajax({
                    type: "post",
                    url: "<?= base_url("pelanggan/prosesEdit") ?>",
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
                        no_telp: noTelp,
                        id_pelanggan: idPelanggan
                    },
                    success: function(data) {
                        swal({
                            title: 'Berhasil Mengubah Pelanggan',
                            text: namaPelanggan,
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