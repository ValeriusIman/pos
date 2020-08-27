<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    <div class="post">
                        <p class="lead">Satuan</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Nama Satuan</th>
                                    <td><?= $satuan->satuan_barang ?></td>
                                </tr>
                            </table>
                            <a href="<?= base_url("satuan") ?>" class="btn btn-primary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Satuan</h3>
            </div>
            <div class="card-body">
                <form id="form-edit-satuan">
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?= $satuan->satuan_barang ?>" id="satuanBarang" name="satuanBarang" placeholder="Satuan Barang">
                        <input type="hidden" value="<?= $satuan->id_satuan ?>" id="idSatuanBarang" name="idSatuanBarang">
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
        $("#btn-simpan").on('click', function() {
            let validate = $("#form-edit-satuan").valid();
            if (validate) {
                $("#form-edit-satuan");
                prosesEdit();
            }
        });
        $("#form-edit-satuan").validate({
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

        function prosesEdit() {
            $("#form-edit-satuan").on('click', function() {
                var satuanBarang = $('#satuanBarang').val();
                var idSatuanBarang = $('#idSatuanBarang').val();
                $.ajax({
                    type: "post",
                    url: "<?= base_url("satuan/prosesEdit") ?>",
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
                        satuan_barang: satuanBarang,
                        id_satuan: idSatuanBarang
                    },
                    success: function(data) {
                        swal({
                            title: 'Berhasil Mengubah Satuan Barang',
                            text: satuanBarang,
                            type: 'success'
                        }).then(function() {
                            location.reload();
                        })
                    }
                })
            });
        }
    });
</script>