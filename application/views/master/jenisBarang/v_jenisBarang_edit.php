<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    <div class="post">
                        <p class="lead">Kategori</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Nama Kategori</th>
                                    <td><?= $jenisBarang->jenis_barang ?></td>
                                </tr>
                            </table>
                            <a href="<?= base_url("jenisBarang") ?>" class="btn btn-primary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Kategori Barang</h3>
            </div>
            <div class="card-body">
                <form id="form-edit-Jenis-Barang" class="form-horizontal">
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?= $jenisBarang->jenis_barang ?>" id="jenisBarang" name="jenisBarang" placeholder="Jenis Barang">
                        <input type="hidden" value="<?= $jenisBarang->id_jenis_barang ?>" id="idJenisBarang" name="idJenisBarang">
                    </div>
                    <div class="form-group">
                        <button type="button" id="btn-simpan" class="btn btn-success edit"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#btn-simpan").on('click', function() {
            let validate = $("#form-edit-Jenis-Barang").valid();
            if (validate) {
                $("#form-edit-Jenis-Barang");
                prosesEdit();
            }
        });
        $("#form-edit-Jenis-Barang").validate({
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

        function prosesEdit() {
            $("#form-edit-Jenis-Barang").on('click', function() {
                var jenisBarang = $('#jenisBarang').val();
                var idJenisBarang = $('#idJenisBarang').val();
                $.ajax({
                    type: "post",
                    url: "<?= base_url("jenisBarang/prosesEdit") ?>",
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
                        jenis_barang: jenisBarang,
                        id_jenis_barang: idJenisBarang
                    },
                    success: function(data) {
                        swal({
                            title: 'Berhasil Mengubah Kategori Barang',
                            text: jenisBarang,
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