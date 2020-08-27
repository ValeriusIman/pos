<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= formatRupiah($perhari->total) ?></h3>

                <p>Pemasukan Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= formatRupiah($perbulan->total) ?></h3>

                <p>Pemasukan Bulan Ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= formatRupiah($tahun->total) ?></h3>

                <p>Pemasukan Tahun Ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= formatRupiah($total->total) ?></h3>

                <p>Seluruh Pemasukan</p>
            </div>
            <div class="icon">
                <!-- <i class="ion ion-person-add"></i> -->
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="nav-icon fas fa-people-carry"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Supplier</span>
                <span class="info-box-number"><?= $supplier ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="nav-icon fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Pelanggan</span>
                <span class="info-box-number"><?= $pelanggan ?></span>
            </div>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="nav-icon fas fa-user-tie"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Karyawan</span>
                <span class="info-box-number"><?= $karyawan ?></span>
            </div>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Penjualan Hari Ini</span>
                <span class="info-box-number"><?= $penjualan ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<div class="row">
    <div class="col-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Pemasukan</h3>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="pendapatan" style="min-height: 250px; height: 250px; max-height: 350px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Pengeluaran</h3>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="pengeluaran" style="min-height: 250px; height: 250px; max-height: 350px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">10 produk Terlaris</h3>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="jumlah" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Pemasukan dan Pengeluaran</h3>
            </div>
            <div class="card-body">
                <form id="tanggal-transaksi">
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
                            <button type="button" id="pemasukan" class="btn btn-success"><i class="fas fa-file-import"></i> Pemasukan</button>
                            <button type="button" id="btn-pengeluaran" class="btn btn-primary"><i class="fas fa-file-export"></i> Pengeluaran</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <table id="data-pendapatan" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="daftar-list">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        var data = $("#data-pendapatan").DataTable({
            "responsive": true,
            "autoWidth": false
        });

        $('#tanggalAwal').datepicker({
            format: "yyyy-mm-dd"
        });
        $('#tanggalAkhir').datepicker({
            format: "yyyy-mm-dd"
        });

        var ctx = document.getElementById('pendapatan').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php
                    if (count($pendapatan) > 0) {
                        foreach ($pendapatan as $data) {
                            echo "'" . bulan($data->Bulan) . "',";
                        }
                    }


                    ?>
                ],
                datasets: [{
                    label: 'Pemasukan',
                    backgroundColor: '#f56954',
                    borderColor: 'rgb(210, 214, 222, 1)',
                    data: [
                        <?php
                        if (count($pendapatan) > 0) {
                            foreach ($pendapatan as $data) {
                                echo "'" . $data->total . "',";
                            }
                        }

                        ?>
                    ]
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctx = document.getElementById('pengeluaran').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php
                    if (count($pengeluaran) > 0) {
                        foreach ($pengeluaran as $data) {
                            echo "'" . bulan($data->bln) . "',";
                        }
                    }

                    ?>
                ],
                datasets: [{
                    label: 'Pengeluaran',
                    backgroundColor: '#3c8dbc',
                    borderColor: 'rgb(210, 214, 222, 1)',
                    data: [
                        <?php
                        if (count($pengeluaran) > 0) {
                            foreach ($pengeluaran as $data) {
                                echo "'" . $data->biaya . "',";
                            }
                        }
                        ?>
                    ]
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctx = document.getElementById('jumlah').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    <?php
                    if (count($produk) > 0) {
                        foreach ($produk as $data) {
                            echo "'" . bulan($data->barang) . "',";
                        }
                    }

                    ?>
                ],
                datasets: [{
                    label: 'Jumlah',
                    backgroundColor: ['#ffce56',
                        '#cc65fe',
                        '#36a2eb',
                        '#ff6384',
                        '#f56954',
                        '#00a65a',
                        '#f39c12',
                        '#00c0ef',
                        '#3c8dbc',
                        '#DEB887',
                    ],
                    borderColor: 'rgb(210, 214, 222, 1)',
                    data: [
                        <?php
                        if (count($produk) > 0) {
                            foreach ($produk as $data) {
                                echo "'" . $data->Total . "',";
                            }
                        }

                        ?>
                    ]
                }]
            },
            options: {}
        });

        $('#btn-pengeluaran').on('click', function(event) {
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
                    url: "<?= base_url('user/getPengeluaran') ?>",
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
                                '<td>' + data[i].tanggal + '</td>' +
                                '<td>' + to_rupiah(data[i].total) + '</td>' +
                                '</tr>';
                        }
                        $('#daftar-list').html(baris);
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

        $('#pemasukan').on('click', function(event) {
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
                    url: "<?= base_url('user/getPendapatan') ?>",
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
                                '<td>' + data[i].tanggal_transaksi + '</td>' +
                                '<td>' + to_rupiah(data[i].total) + '</td>' +
                                '</tr>';
                        }
                        $('#daftar-list').html(baris);
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

        function to_rupiah(angka) {
            var rev = parseInt(angka, 10).toString().split('').reverse().join('');
            var rev2 = '';
            for (var i = 0; i < rev.length; i++) {
                rev2 += rev[i];
                if ((i + 1) % 3 === 0 && i !== (rev.length - 1)) {
                    rev2 += '.';
                }
            }
            return 'Rp. ' + rev2.split('').reverse().join('');
        }
    })
</script>