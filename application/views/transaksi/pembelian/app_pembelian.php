<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card-body">
                        <form id="form-edit-Jenis-Barang" class="form-horizontal">
                            <div class="form-group row">
                                <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-lg">
                                    <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y/m/d') ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kasir" class="col-sm-3 col-form-label">Pembeli</label>
                                <div class="col-lg">
                                    <!-- <select id="pembeli" name="pembeli" class="form-control select2" style="width: 100%;" disabled>
                                        <option value=""></option>
                                        <?php
                                        foreach ($users as $kasir) { ?>
                                            <option value='<?= $kasir->id_user ?>' <?= $kasir->id_user == $result['id_user'] ? "selected" : null ?>><?= $kasir->nama ?></option>
                                        <?php }
                                        ?>
                                    </select> -->
                                    <input type="text" class="form-control" value="<?= $this->session->userdata('nama') ?>" readonly>
                                    <input type="hidden" id="pembeli" name="pembeli" class="form-control" value="<?= $this->session->userdata('user_id') ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="supplier" class="col-sm-3 col-form-label">Supplier</label>
                                <div class="col-7">
                                    <select id="supplier" name="supplier" class="form-control select2" style="width: 100%;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($suppliers as $sp) {
                                            echo "<option value='$sp->id_supplier'> $sp->nama_supplier </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button type="button" id="btn-sup" class="btn btn-primary">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card-body">
                        <form id="form-barang">
                            <div class="form-group row">
                                <label for="barang" class="col-sm-3 col-form-label">Barang</label>
                                <div class="col-lg">
                                    <select id="barang" name="barang" class="form-control select2" style="width: 100%;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($barangs as $br) {
                                            echo "<option data-nama='$br->nama_barang' "
                                                . "data-kode='$br->kode_barang'"
                                                . "value='$br->id_barang'> $br->kode_barang/$br->nama_barang </option>";
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" id="nama" name="nama">
                                    <input type="hidden" id="kode" name="kode">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="qty" class="col-sm-3 col-form-label">Qty</label>
                                <div class="col-lg">
                                    <input type="text" class="form-control" id="qty" name="qty">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                                <div class="col-lg">
                                    <input type="text" class="form-control" id="harga" name="harga">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card-body">
                        <form id="form-hitung" class="form-horizontal">
                            <div class="form-group row">
                                <label for="satuan" class="col-sm-3 col-form-label">Satuan</label>
                                <div class="col-lg">
                                    <select id="satuan" name="satuan" class="form-control select2" style="width: 100%;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($satuans as $s) {
                                            echo "<option data-name='$s->satuan_barang' "
                                                . "value='$s->id_satuan'> $s->satuan_barang </option>";
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" id="namaSatuan" name="namaSatuan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="isi" class="col-sm-3 col-form-label">Isi</label>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="isi" name="isi">
                                </div>
                                <label for="isi" class="col-sm-3 col-form-label">Profit</label>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="profit" name="profit">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg">
                                    <button type="submit" id="btn-add-item" class="btn btn-primary"><i class="fas fa-cart-plus"></i> Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <table id="table-item" class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Isi</th>
                            <th>HPP</th>
                            <th>Profit</th>
                            <th>Harga Jual</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <form id="form-transaksi" class="form-horizontal">
                    <div class="form-group row">
                        <label for="noTransaksi" class="col-sm-4 col-form-label">No. Transaksi</label>
                        <div class="col-lg">
                            <input type="text" class="form-control" id="noTransaksi" value="<?= $noTransaksi ?>" name="noTransaksi" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total" class="col-sm-4 col-form-label">Total</label>
                        <div class="col-lg">
                            <input type="text" class="form-control" id="total" name="total" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <button type="button" id="proses" class="btn btn-success">
                            <i class="fas fa-cash-register"></i> Proses
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('#qty').val(1);
        $('#isi').val(1);
        $('#profit').val(1000);

        $('#supplier').select2({
            placeholder: "Pilih Supplier"
        }).on("change", function() {
            $('#supplier').prop("disabled", true);
        });

        $("#btn-sup").click(function() {
            $('#supplier').prop("disabled", false);
        })

        $('#barang')
            .select2({
                placeholder: "Pilih Barang"
            })
            .on("change", function() {
                var optionSelected = $(this).children("option:selected");
                $("#nama").val(optionSelected.data("nama"));
                $("#kode").val(optionSelected.data("kode"));
            });

        $('#satuan')
            .select2({
                placeholder: "Satuan"
            })
            .on("change", function() {
                var optionSelected = $(this).children("option:selected");
                $("#namaSatuan").val(optionSelected.data("name"));
            });

        $("#form-barang").validate({
            rules: {
                barang: {
                    required: true
                },
                qty: {
                    required: true,
                    digits: true
                },
                harga: {
                    required: true,
                    digits: true
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

        function addItem() {
            let validate = $("#form-barang").valid();
            if (validate) {

                let idBarang = $("#barang").val();
                let idSatuan = $("#satuan").val();
                let satuan = $("#namaSatuan").val();
                let kodeBarang = $("#kode").val();
                let namaBarang = $("#nama").val();
                let hargaBarang = $("#harga").val();
                let jumlahBarang = $("#qty").val();
                let isi = $("#isi").val();
                let profit = $("#profit").val();
                let hpp = parseInt(hargaBarang) / parseInt(jumlahBarang) / parseInt(isi);
                let subTotal = parseInt(hargaBarang) / parseInt(jumlahBarang) / parseInt(isi) + parseInt(profit);
                // event.preventDefault();


                if (jumlahBarang < 1) {
                    swal({
                        text: 'Qty Harus Lebih Dari 1',
                        type: 'error'
                    })
                } else if (isi < 1) {
                    swal({
                        text: 'Isi Harus Lebih Dari 1',
                        type: 'error'
                    })
                } else if (profit < 500) {
                    swal({
                        text: 'Profit Harus Lebih Dari 500',
                        type: 'error'
                    })
                } else if (kodeBarang != "") {
                    let tr = `<tr data-barang="${idBarang}" data-satuan="${idSatuan}">`;
                    tr += `<td>${namaBarang}</td>`;
                    tr += `<td id="Total">${hargaBarang}</td>`; //1
                    tr += `<td>${jumlahBarang}</td>`;
                    tr += `<td>${satuan}</td>`;
                    tr += `<td>${isi}</td>`;
                    tr += `<td>${hpp}</td>`;
                    tr += `<td>${profit}</td>`;
                    tr += `<td>${subTotal}</td>`;
                    tr += `<td>`;
                    tr += `<button class="btn btn-xs btn-del-item btn-danger"> <i class="fas fa-trash"></i></button>`;
                    tr += `</td>`;
                    tr += `</tr>`;
                    $("#table-item tbody").append(tr);
                    $("#barang").val("").trigger("change");
                    $("#satuan").val("").trigger("change");
                    $("#kode").val();
                    $("#nama").val();
                    $("#harga").val("");
                    $("#namaSatuan").val();
                    $("#qty").val(1);
                    $(".btn-del-item").on("click", function() {
                        $(this).parent().parent().remove();
                        calculate();
                    });
                    calculate();
                }
            }
        }
        $("#btn-add-item").on("click", function(event) {
            event.preventDefault();
            addItem();
        });

        function calculate() {
            var Total = 0;
            $('#table-item tbody tr').each(function() {
                Total += parseInt($(this).find('#Total').text())
            })
            isNaN(Total) ? $('#total').val(0) : $('#total').val(Total)
        }
        $(document).ready(function() {
            calculate();
        })

        $(document).on('keydown', function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);

            if (keycode == 117) { //F6
                //request data ke ajax
                event.preventDefault();
                addItem();
            }
            if (keycode == 120) { //F9
                //request data ke ajax
                event.preventDefault();
                prosesTransaksi();
            }
        });

        $("#proses").on('click', function() {
            prosesTransaksi();
        });

        function prosesTransaksi() {
            let idUser = $("#pembeli").val();
            let idSupplier = $("#supplier").val();
            let tanggal = $('#tanggal').val();
            let total = $('#total').val();
            let rows = $("#table-item tbody tr");
            let itemTransaksiBeli = [];
            rows.each(function() {
                let row = $(this);
                let item = {
                    barang_id: row.data("barang"),
                    satuan_id: row.data("satuan"),
                    harga_item_beli: row.children().eq(1).text(),
                    qty_item_beli: row.children().eq(2).text(),
                    isi: row.children().eq(4).text(),
                    HPP: row.children().eq(5).text(),
                    profit: row.children().eq(6).text(),
                    harga_jual: row.children().eq(7).text(),
                };
                itemTransaksiBeli.push(item);
            });
            let dataKirim = JSON.stringify(itemTransaksiBeli);
            $.ajax({
                url: "<?= base_url("pembelian/prosesTransaksi") ?>",
                type: "POST",
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
                    item_beli: dataKirim,
                    id_user: idUser,
                    id_supplier: idSupplier,
                    tanggal: tanggal,
                    total: total,
                    proses: true
                },
                dataType: "JSON",
                success: function(result) {

                    if (result.success) {
                        //success
                        swal({
                            title: 'Transaksi Berhasil',
                            type: 'success'
                        })
                        window.location.replace("<?= base_url("pembelian") ?>");
                    } else {
                        //error
                        alert("Error proses Transaksi");
                    }

                }
            });
        }


    });
</script>