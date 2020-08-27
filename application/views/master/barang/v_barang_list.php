<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Barang</h3>
            </div>
            <div class="card-body">
                <table id="data-barang" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Stock</th>
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
                                <td><?= $barang->stock ?></td>
                                <td>
                                    <a href="<?= base_url('barang/detail/' . $barang->id_barang) ?>" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                    <button class="btn btn-sm btn-danger hapus" data-id="<?= $barang->id_barang ?>"><i class="fas fa-fw fa-trash-alt"></i> Delete</button>
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
                <h3 class="card-title">Tambah Barang</h3>
            </div>
            <div class="card-body">
                <form id="form-barang" class="form-horizontal">
                    <div class="form-group">
                        <input type="text" class="form-control" id="kodeBarang" name="kodeBarang" placeholder="Kode Barang">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="namaBarang" name="namaBarang" placeholder="Nama Barang">
                    </div>
                    <div class="form-group">
                        <select id="jenisBarang" name="jenisBarang" class="form-control select2">
                            <option value=""></option>
                            <?php
                            foreach ($jenisBarangs as $jb) {
                                echo "<option value='$jb->id_jenis_barang'> $jb->jenis_barang </option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="satuanBarang" name="satuanBarang" class="form-control select2">
                            <option value=""></option>
                            <?php
                            foreach ($satuans as $s) {
                                echo "<option value='$s->id_satuan'> $s->satuan_barang </option>";
                            }
                            ?>
                        </select>
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
        var data = $("#data-barang").DataTable({
            "responsive": true,
            "autoWidth": false
        });

        $('#jenisBarang').select2({
            placeholder: "Jenis Barang"
        });
        $('#satuanBarang').select2({
            placeholder: "Satuan"
        });

        $("#btn-simpan").on('click', function() {
            let validate = $("#form-barang").valid();
            if (validate) {
                $("#form-barang");
                prosesTambah();
            }
        });

        $("#form-barang").validate({
            rules: {
                kodeBarang: {
                    alphanumeric: true,
                    required: true
                },
                namaBarang: {
                    required: true
                },
                jenisBarang: {
                    required: true
                },
                satuanBarang: {
                    required: true
                }
            },
            messages: {
                kodeBarang: {
                    alphanumeric: "Hanya Boleh Angka, Huruf dan Undescore"
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

        $('#data-barang').on('click', '.hapus', function() {
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
                        url: "<?= base_url('barang/delete') ?>",
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

        function prosesTambah() {
            $("#form-barang").on('click', function() {
                var kodeBarang = $('#kodeBarang').val();
                var namaBarang = $('#namaBarang').val();
                var jenisBarang = $('#jenisBarang').val();
                var satuanBarang = $('#satuanBarang').val();
                $.ajax({
                    type: "post",
                    url: "<?= base_url("barang/tambah") ?>",
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
                        kodeBarang: kodeBarang,
                        namaBarang: namaBarang,
                        jenisBarang: jenisBarang,
                        satuanBarang: satuanBarang
                    },
                    success: function(data) {
                        swal({
                            title: 'Berhasil Menambah Barang',
                            text: namaBarang,
                            type: 'success'
                        }).then(function() {
                            location.reload();
                        })
                    },
                    error: function(data) {
                        swal({
                            title: 'Kode Barang Sudah Digunakan',
                            text: kodeBarang,
                            type: 'error'
                        }).then(function() {
                            location.reload();
                        })
                    }
                })
            });
        };

    });
</script>