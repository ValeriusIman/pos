<a href="<?= base_url('app/tunda') ?>" class="btn btn-info">
    <i class="far fa-list-alt"></i> Transaksi Tertunda
</a>
</p>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card-body">
                        <form id="form-edit-Jenis-Barang" class="form-horizontal">
                            <div class="form-group row">
                                <label for="tanggal" class="col-sm-4 col-form-label">Tanggal</label>
                                <div class="col-lg">
                                    <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y/m/d H:i:s') ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kasir" class="col-sm-4 col-form-label">Kasir</label>
                                <div class="col-lg">
                                    <input type="text" class="form-control" value="<?= $this->session->userdata('nama') ?>" readonly>
                                    <input type="hidden" id="kasir" name="kasir" class="form-control" value="<?= $this->session->userdata('user_id') ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pelanggan" class="col-sm-4 col-form-label">Pelanggan</label>
                                <div class="col-6">
                                    <select id="pelanggan" name="pelanggan" class="form-control select2" style="width: 100%;">
                                        <?php
                                        foreach ($pelanggans as $p) {
                                            echo "<option value='$p->id_pelanggan'> $p->nama_pelanggan </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button type="button" id="btn-pel" class="btn btn-primary">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card-body">
                        <!-- <form id="form-edit-Jenis-Barang" class="form-horizontal"> -->
                        <div class="form-group row">
                            <label for="barcode" class="col-sm-4 col-form-label">Barcode</label>
                            <div class="col-lg">
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="qty" class="col-sm-4 col-form-label">Qty</label>
                            <div class="col-lg">
                                <input type="text" class="form-control" id="qty" name="qty">
                            </div>
                        </div>
                        <!-- </form> -->
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
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Sub Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="cart">
                        <?php $this->view('transaksi/app/item') ?>
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
                        <label for="discount" class="col-sm-4 col-form-label">Discount(F7)</label>
                        <div class="col-lg">
                            <input type="text" class="form-control" id="discount" name="discount">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="grand_total" class="col-sm-4 col-form-label"> Grand Total</label>
                        <div class="col-lg">
                            <input type="text" class="form-control" id="grand_total" name="grand_total" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bayar" class="col-sm-4 col-form-label">Bayar(F8)</label>
                        <div class="col-lg">
                            <input type="text" class="form-control" id="bayar" name="bayar">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kembalian" class="col-sm-4 col-form-label">Kembalian</label>
                        <div class="col-lg">
                            <input type="text" class="form-control" id="kembalian" name="kembalian" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button type="button" id="proses" class="btn btn-success">
                    <i class="fas fa-cash-register"></i> Proses(F9)
                </button>
                <button type="button" id="btn-tunda" class="btn btn-secondary">
                    <i class="fas fa-paperclip"></i> Tunda(F10)
                </button>
                <button type="button" id="btn-batal" class="btn btn-warning">
                    <i class="fas fa-times-circle"></i> Batal
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    $(function() {
        $('#qty').val(1);
        $('#pelanggan').select2().on("change", function() {
            $('#pelanggan').prop("disabled", true);
        });

        $("#btn-pel").click(function() {
            $('#pelanggan').prop("disabled", false);
        })

        $("#btn-tunda").on("click", function() {
            prosesTunda()
        });

        function prosesTunda() {
            var idPegawai = $("#kasir").val()
            var keranjang = $("#cart tr").children().eq(0).html();
            // e.preventDefault();
            if (keranjang == null) {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Barang Tidak Ada',
                });
            } else {
                $.ajax({
                    url: '<?= site_url('app/prosesTransaksi') ?>',
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        'tunda_transaksi': true,
                        'id_user': idPegawai,
                    },
                    success: function(result) {
                        if (result.success) {
                            // e.preventDefault();
                            Swal.fire({
                                type: 'success',
                                text: 'Transaksi Di Tunda',
                            });
                            $('#cart').load('<?= base_url('/app/cartData ') ?>', function() {
                                calculate();
                            })
                            $('#bayar').val("");
                            $('#discount').val("");
                            $('#grand_total').val(0);
                            $('#total').val(0);
                            $('#kembalian').val(0);
                        } else {
                            e.preventDefault();
                            Swal.fire({
                                type: 'error',
                                text: 'Transaksi Gagal',
                            });
                        }
                    }
                });
            }
        }

        // Barcode
        $('#title').keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                event.preventDefault();
                var kode_barang = $(this).val();
                var stock = $(this).val();
                var hpp = $(this).val();
                var is_active = $(this).val();
                var qty = $('#qty').val();

                if (kode_barang == "") {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Belum memasukkan barcode!',
                    });
                } else if (qty < 1) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Stock kurang!',
                    });
                    $("#title").val(barcode);
                } else {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('barang/get_barang') ?>",
                        dataType: "JSON",
                        data: {
                            kode_barang: kode_barang
                        },
                        cache: false,
                        success: function(data) {
                            var idbarang = data.id_barang;
                            var hargaBarang = data.harga_barang;
                            var barcode = data.kode_barang;
                            var namaBarang = data.nama_barang;
                            var stock = data.stock;
                            var hpp = data.hpp;
                            let jumlahBarang = $("#qty").val();
                            let idUser = $("#kasir").val();
                            let subTotal = parseInt(hargaBarang) * parseInt(jumlahBarang);
                            let hppTotal = parseInt(hpp) * parseInt(jumlahBarang);

                            if (parseInt(stock) < jumlahBarang) {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'Stock Tidak Mencukupi!',
                                });
                            } else {
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url('app/proses') ?>",
                                    dataType: "JSON",
                                    data: {
                                        'proses': true,
                                        'barang_id': idbarang,
                                        'total': subTotal,
                                        'qty': jumlahBarang,
                                        'harga': hargaBarang,
                                        'hpp': hpp,
                                        'total_hpp': hppTotal,
                                        'user_id': idUser,
                                    },
                                    success: function(result) {
                                        if (result.success == true) {
                                            $('#cart').load('<?= base_url('app/cartData ') ?>', function() {
                                                calculate();
                                            })
                                            $("#title").val("")
                                            $("#title").val("").focus()
                                        } else {
                                            Swal.fire({
                                                type: 'error',
                                                title: 'Oops...',
                                                text: 'Gagal!',
                                            });
                                        }
                                    }
                                });
                            }

                        },
                        error: function(data) {
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Barang Tidak Ada!',
                            });
                        }
                    });
                }
            }
        });

        function calculate() {
            var subTotal = 0;
            $('#table-item tbody tr').each(function() {
                subTotal += parseInt($(this).find('#subTotal').text())
            })
            isNaN(subTotal) ? $('#total').val(0) : $('#total').val(subTotal)

            var diskon = $('#discount').val()
            var grandTotal = subTotal - diskon
            if (isNaN(grandTotal)) {
                // $('#total').val(0)
                $('#grand_total').val(0)
            } else {
                // $('#total').val(grandTotal)
                $('#grand_total').val(grandTotal)
            }

            var cash = $('#bayar').val()
            var uangKembali = cash - grandTotal
            cash != 0 ? $('#kembalian').val(uangKembali) : $('#kembalian').val(0)

        }
        $(document).on('keyup mouseup', '#discount', function() {
            calculate();
        })
        $(document).on('keyup mouseup', '#bayar', function() {
            calculate();
        })
        $(document).ready(function() {
            calculate();
        })

        $("#proses").on('click', function() {
            prosesTransaksi();
        });

        function prosesTransaksi() {
            let idUser = $("#kasir").val();
            let idPelanggan = $("#pelanggan").val();
            let tanggal = $('#tanggal').val();
            let total = $('#total').val();
            let diskon = $('#discount').val();
            let grandTotal = $('#grand_total').val();
            let bayar = $('#bayar').val();
            let kembalian = $('#kembalian').val();
            if (total < 1) {
                swal({
                    title: 'Barang belum dipilih',
                    type: 'error'
                })
            } else if (diskon < 0) {
                swal({
                    title: 'Diskon Tidak Boleh kurang dari 0',
                    type: 'error'
                })
            } else if (bayar < 1) {
                swal({
                    title: 'Masukan Uang Pembayaran',
                    type: 'error'
                })
            } else if (bayar < grandTotal) {
                swal({
                    title: 'Uang Pembayaran Kurang',
                    type: 'error'
                })
            } else if (diskon > grandTotal) {
                swal({
                    title: 'Diskon Tidak Boleh Melebihi Total Harga',
                    type: 'error'
                })
            } else {
                $.ajax({
                    url: "<?= base_url("app/prosesTransaksi") ?>",
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
                        id_user: idUser,
                        id_pelanggan: idPelanggan,
                        tanggal: tanggal,
                        total: total,
                        diskon: diskon,
                        grand_total: grandTotal,
                        bayar: bayar,
                        kembalian: kembalian,
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
                            window.open("<?= base_url('app/print/') ?>" + result.id_transaksi + "_blank");
                            window.location.replace("<?= base_url("app") ?>");
                        } else {
                            //error
                            alert("Error proses Transaksi");
                        }

                    }
                });
            }
        }

        $('#table-item').on('click', '.hapus', function() {
            var cart_id = $(this).data('id')
            $.ajax({
                type: 'POST',
                url: '<?= base_url('app/cartDel') ?>',
                dataType: 'json',
                data: {
                    'cart_id': cart_id
                },
                success: function(result) {
                    if (result.success == true) {
                        $('#cart').load('<?= base_url('app/cartData ') ?>', function() {
                            calculate();
                        })
                    } else {
                        alert('Gagal Hapus Item Barang');
                    }
                }
            })
        })

        $("#btn-batal").on('click', function() {
            batal();
        });

        function batal() {
            var keranjang = $('#cart tr').children().eq(0).html();
            // e.preventDefault();
            if (keranjang == null) {
                swal({
                    title: 'Tidak Ada Item Barang',
                    type: 'error'
                })
            } else {
                swal({
                    title: 'Konfirmasi',
                    text: "Anda Membatalkan Pesanan",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    cancelButtonText: 'Tidak',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "<?= base_url('app/cartDel') ?>",
                            method: "post",
                            dataType: "JSON",
                            data: {
                                batal: true
                            },
                            success: function(data) {
                                if (data.success == true) {
                                    $('#cart').load('<?= base_url('app/cartData ') ?>', function() {})
                                } else {
                                    alert('Gagal Hapus Item Barang');
                                }
                                calculate();
                                $('#bayar').val("");
                                $('#discount').val("");
                                $('#grand_total').val(0);
                                $('#total').val(0);
                                $('#kembalian').val(0);
                            }
                        })
                    } else if (result.dismiss === swal.DismissReason.cancel) {

                    }
                })
            }
        }

        $(document).on('keydown', function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);

            if (keycode == 118) { //F7
                //request data ke ajax
                event.preventDefault();
                $('#discount').focus()
            }
            if (keycode == 119) { //F8
                //request data ke ajax
                event.preventDefault();
                $('#bayar').focus()
            }
            if (keycode == 120) { //F9
                //request data ke ajax
                event.preventDefault();
                prosesTransaksi();
            }
            if (keycode == 121) { //F10
                //request data ke ajax
                event.preventDefault();
                prosesTunda();
            }
        });
    });
</script>