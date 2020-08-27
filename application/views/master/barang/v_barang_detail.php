<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    <p class="lead">Barang</p>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Kode Barang</th>
                                <td><?= $barang->kode_barang ?></td>
                            </tr>
                            <tr>
                                <th>Barcode</th>
                                <td>
                                    <?php $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                    echo $generator->getBarcode($barang->kode_barang, $generator::TYPE_CODE_128);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="width:50%">Nama Barang</th>
                                <td><?= $barang->nama_barang ?></td>
                            </tr>
                            <tr>
                                <th>HPP</th>
                                <td><?= formatRupiah($barang->HPP) ?></td>
                            </tr>
                            <tr>
                                <th>Profit</th>
                                <td><?= formatRupiah($barang->profit) ?></td>
                            </tr>
                            <tr>
                                <th>Harga Jual</th>
                                <td><?= formatRupiah($barang->harga_barang) ?></td>
                            </tr>
                            <tr>
                                <th>Stock</th>
                                <td><?= $barang->stock ?></td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td><?= $barang->kategori ?></td>
                            </tr>
                            <tr>
                                <th>Satuan</th>
                                <td><?= $barang->satuan ?></td>
                            </tr>
                        </table>
                        <a href="<?= base_url('barang') ?>" class="btn btn-primary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                        <a href="<?= base_url('barang/printBarcode/') . $barang->id_barang ?>" target="_blank" id="cetak" class="btn btn-success"><i class="fas fa-print"></i> Cetak Barcode</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Barang</h3>
            </div>
            <div class="card-body">
                <form id="form-edit-barang" class="form-horizontal">
                    <div class="form-group row">
                        <label for="kodeBarang" class="col-sm-4 col-form-label">Kode Barang</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="kodeBarang" name="kodeBarang" value="<?= $barang->kode_barang ?>" readonly>
                            <input type="hidden" class="form-control" id="idBarang" name="idBarang" value="<?= $barang->id_barang ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="namaBarang" class="col-sm-4 col-form-label">Nama Barang</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="namaBarang" name="namaBarang" value="<?= $barang->nama_barang ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-sm-4 col-form-label">Kategori</label>
                        <div class="col-sm-6">
                            <select id="kategori" name="kategori" class="form-control select2" style="width: 100%;">
                                <?php
                                foreach ($jenisBarangs as $jb) { ?>
                                    <option value='<?= $jb->id_jenis_barang ?>' <?= $jb->id_jenis_barang == $barang->jenis_barang_id ? "selected" : null ?>> <?= $jb->jenis_barang ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="satuan" class="col-sm-4 col-form-label">Satuan</label>
                        <div class="col-sm-6">
                            <select id="satuan" name="satuan" class="form-control select2" style="width: 100%;">
                                <?php
                                foreach ($satuans as $s) { ?>
                                    <option value='<?= $s->id_satuan ?>' <?= $s->id_satuan == $barang->satuan_id ? "selected" : null ?>> <?= $s->satuan_barang ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-4 col-sm-8">
                            <button type="button" id="btn-simpan" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#kategori').select2();
        $('#satuan').select2();

        $('#btn-simpan').on('click', function() {
            let validate = $("#form-edit-barang").valid();
            if (validate) {
                $("#form-edit-barang");
                prosesEdit();
            }
        })

        $("#form-edit-barang").validate({
            rules: {
                namaBarang: {
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
            var namaBarang = $('#namaBarang').val();
            var kategori = $('#kategori').val();
            var satuan = $('#satuan').val();
            var idBarang = $('#idBarang').val();
            $.ajax({
                type: "post",
                url: "<?= base_url("barang/prosesEdit") ?>",
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
                    nama_barang: namaBarang,
                    kategori: kategori,
                    satuan: satuan,
                    id: idBarang
                },
                success: function(data) {
                    swal({
                        title: 'Berhasil Mengubah Barang',
                        type: 'success'
                    }).then(function() {
                        location.reload();
                    })
                }
            })
        }

    });
</script>