<section class="content">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <a href="<?= site_url('app') ?>" class="btn btn-primary">
                        <i class="fas fa-arrow-alt-circle-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width:1px;">No</th>
                        <th>No Tunda</th>
                        <th>Nama Kasir</th>
                        <th style="width:10%;">Tanggal</th>
                        <th style="text-align:center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($tunda as $t) {
                    ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= $t->no_tunda ?></td>
                            <td><?= $t->nama ?></td>
                            <td><?= $t->tanggal ?></td>
                            <td>
                                <button class="btn btn-success" id="btn-proses-tunda" data-tundaid="<?= $t->id_tunda ?>" data-title="Edit">
                                    Proses Transaksi
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script>
    $(document).on('click', '#btn-proses-tunda', function() {
        var id_transaksi_tunda = $(this).data('tundaid');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('app/prosesTunda') ?>",
            dataType: "JSON",
            data: {
                id_transaksi_tunda: id_transaksi_tunda
            },
            cache: false,
            success: function(result) {
                if (result.success == true) {
                    window.location.replace("<?= base_url("app") ?>");
                    $('#cart').load('<?= site_url('app/cartData ') ?>', function() {
                        calculate();
                    })
                    $("#title").val("")
                    $("#title").val("").focus()
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal!',
                    });
                }
            }
        });
    });
</script>