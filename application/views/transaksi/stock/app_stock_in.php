<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card-body">
                        <form id="form-edit-Jenis-Barang" class="form-horizontal">
                            <div class="form-group row">
                                <label for="tanggal" class="col-sm-4 col-form-label">Kode Barang</label>
                                <div class="col-lg">
                                    <select id="idBarang" name="idBarang" class="form-control select2">
                                        <option value=""></option>
                                        <?php
                                        foreach ($barangs as $b) {
                                            echo "<option data-nama='$b->nama_barang' "
                                                . "data-stock='$b->stock' "
                                                . "data-kode='$b->kode_barang' "
                                                . "value='$b->id_barang'> "
                                                . "$b->kode_barang / $b->nama_barang"
                                                . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kasir" class="col-sm-4 col-form-label">Nama Barang</label>
                                <div class="col-lg">
                                    <input type="hidden" id="kode" name="kode" readonly>
                                    <input type="text" class="form-control" id="namaBarang" name="namaBarang" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="supplier" class="col-sm-4 col-form-label">Stock Awal</label>
                                <div class="col-lg">
                                    <input type="text" class="form-control" id="stock" name="stock" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card-body">
                        <form id="form-hitung" class="form-horizontal">
                            <div class="form-group row">
                                <label for="satuan" class="col-sm-3 col-form-label">Supplier</label>
                                <div class="col-lg">
                                    <select id="supplier" name="supplier" class="form-control select2" style="width: 100%;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($suppliers as $sp) {
                                            echo "<option data-nama='$sp->nama_supplier' value='$sp->id_supplier'> $sp->nama_supplier </option>";
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" id="namaSupplier" name="namaSupplier">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="isi" class="col-sm-3 col-form-label">Qty</label>
                                <div class="col-lg">
                                    <input type="text" class="form-control" id="qty" name="qty">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-sm-3 col-form-label">In / Out</label>
                                <div class="col-3">
                                    <select id="type" name="type" class="form-control select2" style="width: 100%;">
                                        <option value=""></option>
                                        <option data-type="In/" value="In">In</option>
                                        <option data-type="Out/" value="Out">Out</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button type="button" id="btn-jenis" class="btn btn-primary">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button type="button" id="btn-add-item" class="btn btn-primary"><i class="fas fa-cart-plus"></i> Tambah</button>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <div class="offset-sm-3 col-sm-10">
                                </div>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="table-item" class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Produk</th>
                            <th>Stock Awal</th>
                            <th>Qty</th>
                            <th>Supplier</th>
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
                <form id="form-stock-in">
                    <div class="form-group">
                        <input type="text" class="form-control" id="noStruck" name="noStruck" readonly>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="tgl" name="tgl" value="<?= date("Y/m/d H:i:s") ?>">
                        <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= date("Y-m-d") ?>" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="pegawai" name="pegawai" value="<?= $result['nama'] ?>" placeholder="Nama Barang" readonly>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Keterangan" id="keterangan" name="keterangan"></textarea>
                    </div>
                    <div class="form-group">
                        <button id="btn-proses" type="button" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('#qty').val(1);
        $("#idBarang")
            .select2({
                placeholder: "Kode Barang"
            })
            .on("change", function() {
                var optionSelected = $(this).children("option:selected");
                $("#namaBarang").val(optionSelected.data("nama"));
                $("#stock").val(optionSelected.data("stock"));
                $("#kode").val(optionSelected.data("kode"));
            });

        $('#type')
            .select2({
                placeholder: "type"
            })
            .on("change", function() {
                var optionSelected = $(this).children("option:selected");
                var a = $('#tgl').val();
                $('#type').prop("disabled", true);
                $("#noStruck").val(optionSelected.data("type") + a);
            });

        $("#btn-jenis").click(function() {
            $('#type').prop("disabled", false);
        })

        $('#supplier')
            .select2({
                placeholder: "Supplier"
            })
            .on("change", function() {
                var optionSelected = $(this).children("option:selected");
                $("#namaSupplier").val(optionSelected.data("nama"));
            });

        // function addItem() {

        //     let idBarang = $("#idBarang").val();
        //     let idSupplier = $("#supplier").val();
        //     let kodeBarang = $("#kode").val();
        //     let namaBarang = $("#namaBarang").val();
        //     let stockAwal = $("#stock").val();
        //     let qty = $("#qty").val();
        //     let supplier = $("#namaSupplier").val();

        //     if (kodeBarang != "") {
        //         let tr = `<tr data-barang="${idBarang}" data-supplier="${idSupplier}">`;
        //         tr += `<td>${kodeBarang}</td>`;
        //         tr += `<td>${namaBarang}</td>`;
        //         tr += `<td>${stockAwal}</td>`;
        //         tr += `<td>${qty}</td>`;
        //         tr += `<td>${supplier}</td>`;
        //         tr += `<td>`;
        //         tr += `<button class="btn btn-xs btn-del-item btn-danger"> <i class="fas fa-trash"></i></button>`;
        //         tr += `</td>`;
        //         tr += `</tr>`;
        //         $("#table-item tbody").append(tr);
        //         $("#idBarang").val("").trigger("change");
        //         $("#supplier").val("").trigger("change");
        //         $("#kode").val();
        //         $("#nama").val();
        //         $("#stock").val();
        //         $("#namaSupplier").val();
        //         $("#qty").val(1);
        //         $(".btn-del-item").on("click", function() {
        //             $(this).parent().parent().remove();
        //         });
        //     } else {
        //         Swal.fire({
        //             type: 'error',
        //             title: 'Oops...',
        //             text: 'Gagal!',
        //         });
        //     }
        // }


        function addItem() {
            let idBarang = $("#idBarang").val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('stock/getBarangStock') ?>",
                dataType: "JSON",
                data: {
                    id_barang: idBarang
                },
                cache: false,
                success: function(data) {
                    let stock = data.stock;
                    let idBarang = $("#idBarang").val();
                    let idSupplier = $("#supplier").val();
                    let kodeBarang = $("#kode").val();
                    let namaBarang = $("#namaBarang").val();
                    let stockAwal = $("#stock").val();
                    let qty = $("#qty").val();
                    let supplier = $("#namaSupplier").val();
                    let type = $("#type").val();

                    if (idSupplier == "") {
                        swal({
                            text: 'Pilih Supplier',
                            type: 'error'
                        })
                    } else if (type == "Out") {
                        if (parseInt(stock) < qty) {
                            swal({
                                text: 'Qty Lebih Besar Dari Stock',
                                type: 'error'
                            })
                        } else {
                            if (kodeBarang != "") {
                                let tr = `<tr data-barang="${idBarang}" data-supplier="${idSupplier}">`;
                                tr += `<td>${kodeBarang}</td>`;
                                tr += `<td>${namaBarang}</td>`;
                                tr += `<td>${stockAwal}</td>`;
                                tr += `<td>${qty}</td>`;
                                tr += `<td>${supplier}</td>`;
                                tr += `<td>`;
                                tr += `<button class="btn btn-xs btn-del-item btn-danger"> <i class="fas fa-trash"></i></button>`;
                                tr += `</td>`;
                                tr += `</tr>`;
                                $("#table-item tbody").append(tr);
                                $("#idBarang").val("").trigger("change");
                                $("#supplier").val("").trigger("change");
                                $("#kode").val();
                                $("#nama").val();
                                $("#stock").val();
                                $("#namaSupplier").val();
                                $("#qty").val(1);
                                $(".btn-del-item").on("click", function() {
                                    $(this).parent().parent().remove();
                                });
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'Gagal!',
                                });
                            }
                        }
                    } else {
                        if (kodeBarang != "") {
                            let tr = `<tr data-barang="${idBarang}" data-supplier="${idSupplier}">`;
                            tr += `<td>${kodeBarang}</td>`;
                            tr += `<td>${namaBarang}</td>`;
                            tr += `<td>${stockAwal}</td>`;
                            tr += `<td>${qty}</td>`;
                            tr += `<td>${supplier}</td>`;
                            tr += `<td>`;
                            tr += `<button class="btn btn-xs btn-del-item btn-danger"> <i class="fas fa-trash"></i></button>`;
                            tr += `</td>`;
                            tr += `</tr>`;
                            $("#table-item tbody").append(tr);
                            $("#idBarang").val("").trigger("change");
                            $("#supplier").val("").trigger("change");
                            $("#kode").val();
                            $("#nama").val();
                            $("#stock").val();
                            $("#namaSupplier").val();
                            $("#qty").val(1);
                            $(".btn-del-item").on("click", function() {
                                $(this).parent().parent().remove();
                            });
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Gagal!',
                            });
                        }
                    }
                }
            })
        }


        $("#btn-add-item").on("click", function(event) {
            event.preventDefault();
            addItem();
        });

        $(document).on('keydown', function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);

            if (keycode == 117) { //F6
                //request data ke ajax
                event.preventDefault();
                addItem();
            }
            if (keycode == 118) { //F7
                //request data ke ajax
                event.preventDefault();
                prosesTransaksi();
            }
        });

        $("#btn-proses").on('click', function() {
            prosesTransaksi();
        });

        function prosesTransaksi() {
            let tanggal = $('#tanggal').val();
            let noStruck = $('#noStruck').val();
            let keterangan = $('#keterangan').val();
            let type = $('#type').val();
            let rows = $("#table-item tbody tr");
            let itemStock = [];
            rows.each(function() {
                let row = $(this);
                let item = {
                    barang_id: row.data("barang"),
                    supplier_id: row.data("supplier"),
                    qty: row.children().eq(3).text(),
                };
                itemStock.push(item);
            });
            let dataKirim = JSON.stringify(itemStock);
            if (type == "In") {
                $.ajax({
                    url: "<?= base_url("stock/prosesTambah") ?>",
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
                        item_stock: dataKirim,
                        tanggal: tanggal,
                        noStruck: noStruck,
                        detail: keterangan,
                        type: type,
                        proses_in: true
                    },
                    dataType: "JSON",
                    success: function(result) {

                        if (result.success) {
                            //success
                            swal({
                                title: 'Berhasil',
                                type: 'success'
                            })
                            window.location.replace("<?= base_url("stock/appStock") ?>");
                        } else {
                            //error
                            alert("Proses Error");
                        }
                    }
                });
            } else {
                $.ajax({
                    url: "<?= base_url("stock/prosesTambah") ?>",
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
                        item_stock: dataKirim,
                        tanggal: tanggal,
                        noStruck: noStruck,
                        detail: keterangan,
                        type: type,
                        proses_out: true
                    },
                    dataType: "JSON",
                    success: function(result) {

                        if (result.success) {
                            //success
                            swal({
                                title: 'Berhasil',
                                type: 'success'
                            })
                            window.location.replace("<?= base_url("stock/appStock") ?>");
                        } else {
                            //error
                            alert("Proses Error");
                        }
                    }
                });
            }

        }


    });
</script>