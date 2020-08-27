<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card-body">
                        <form id="tanggal-transaksi" method="POST" action="<?= base_url('transaksi/downloadReport') ?>">
                            <div class="form-group row">
                                <label for="tanggal" class="col-sm-4 col-form-label">Tanggal Awal</label>
                                <div class="col-lg">
                                    <input type="text" id="tanggalAwal" name="tanggalAwal" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kasir" class="col-sm-4 col-form-label">Tanggal Akhir</label>
                                <div class="col-lg">
                                    <input type="text" id="tanggalAkhir" name="tanggalAkhir" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-4 col-sm-8">
                                    <button type="button" id="btn-tanggal" class="btn btn-success"><i class="fab fa-sistrix"></i></i> Tampilkan</button>
                                    <button type="button" id="download" class="btn btn-primary"><i class="fas fa-file-pdf"></i> PDF</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laporan Transaksi</h3>
            </div>
            <div class="card-body">

                <table id="data-transaksi" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Transaksi</th>
                            <th>Tanggal</th>
                            <th>Discount</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="laporan">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        var data = $("#data-transaksi").DataTable({
            "responsive": true,
            "autoWidth": false
        });
        $('#tanggalAwal').datepicker({
            format: "yyyy-mm-dd"
        });
        $('#tanggalAkhir').datepicker({
            format: "yyyy-mm-dd"
        });

        $("#download").on('click', function() {
            let awal = $("#tanggalAwal").val();
            let akhir = $("#tanggalAkhir").val();
            if (awal > akhir) {
                swal({
                    title: 'Tanggal Awal Lebih Besar',
                    type: 'error'
                })
            } else {
                $('#tanggal-transaksi').submit();
            }
        });

        $('#btn-tanggal').on('click', function(event) {
            event.preventDefault();
            var awal = $('#tanggalAwal').val();
            var akhir = $('#tanggalAkhir').val();
            if (awal > akhir) {
                swal({
                    title: 'Tanggal Awal Lebih Besar',
                    type: 'error'
                })
            } else {
                $.ajax({
                    url: "<?= base_url('transaksi/getReport') ?>",
                    type: "post",
                    data: {
                        tanggal_awal: awal,
                        tanggal_akhir: akhir,
                        proses: true
                    },
                    dataType: "JSON",
                    success: function(data) {
                        var baris = '';
                        for (var i = 0; i < data.length; i++) {
                            var no = i + 1;
                            baris += '<tr>' +
                                '<td>' + no + '</td>' +
                                '<td>' + data[i].no_transaksi + '</td>' +
                                '<td>' + data[i].tanggal_transaksi + '</td>' +
                                '<td>' + data[i].diskon + '</td>' +
                                '<td>' + data[i].grand_total + '</td>' +
                                '</tr>';
                        }
                        $('#laporan').html(baris);
                        if (baris == '') {
                            swal({
                                title: 'Data Tidak Ada',
                                type: 'error'
                            })
                        }
                    }
                })
            }
        });

    });
</script>