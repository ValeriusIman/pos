<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/default.jpg') ?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= $user->nama ?></h3>

                        <p class="text-muted text-center"><?= $user->email ?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Aktif</b> <a class="float-right"><?= date('d F Y', $user->date_created) ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Level</b> <a class="float-right"><?= $user->level == 1 ? "Admin" : "Kasir" ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>No Telp</b> <a class="float-right"><?= $user->no_telp ?></a>
                            </li>
                        </ul>
                        <div class="form-group row">
                            <a href="<?= base_url('user') ?>" type="button" class="btn btn-success"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab"><i class="far fa-id-card"></i> Info</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab"><i class="fas fa-cogs"></i> Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="post">
                                    <p class="lead">Biodata</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Tanggal Lahir</th>
                                                <td><?= $user->tanggal_lahir ?></td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th>
                                                <td><?= $user->jenis_kelamin ?></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td><?= $user->alamat ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="settings">
                                <form id="form-edit-profil" class="form-horizontal" action="<?= base_url('user/edit') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" name="name" value="<?= $user->nama ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" name="email" value="<?= $user->email ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="noTelp" class="col-sm-2 col-form-label">No Telp</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="noTelp" name="noTelp" data-inputmask='"mask": "9999-9999-9999"' value="<?= $user->no_telp ?>" data-mask>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="<?= $user->tanggal_lahir ?>" id="tanggal" name="tanggal">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-10">
                                            <select id="jenis-kelamin" name="jenisKelamin" class="form-control select2" style="width: 100%;">
                                                <option <?= $user->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' ?> value="Laki-Laki">Laki-Laki</option>
                                                <option <?= $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' ?> value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="alamat" name="alamat"><?= $user->alamat ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="button" id="btn-simpan" class="btn btn-success"><i class="fas fa-save"></i> Submit</button>
                                        </div>
                                    </div>
                                    <input type="hidden" id="idUser" nama="idUser" value="<?= $user->id_user ?>" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function() {
        // placeholder: "Pilih Jenis Kelamin"
        $('#jenis-kelamin').select2();
        $('#tanggal').datepicker({
            format: "yyyy-mm-dd",
            // startDate: '+2y'
            endDate: '-17y'
        });
        $('[data-mask]').inputmask()

        $("#btn-simpan").on('click', function() {
            $("#form-edit-profil").on('click', function() {
                var name = $('#name').val();
                var noTelp = $('#noTelp').val();
                var tanggal = $('#tanggal').val();
                var jenisKelamin = $('#jenis-kelamin').val();
                var alamat = $('#alamat').val();
                var idUser = $('#idUser').val();
                $.ajax({
                    type: "post",
                    url: "<?= base_url("user/edit") ?>",
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
                        nama: name,
                        no_telp: noTelp,
                        tanggal: tanggal,
                        jenis_kelamin: jenisKelamin,
                        alamat: alamat,
                        idUser: idUser
                    },
                    success: function(data) {
                        swal({
                            title: 'Berhasil Merubah User',
                            text: name,
                            type: 'success'
                        }).then(function() {
                            location.reload();
                        })
                    }
                })
            });
            // alert('ok');
        });
    });
</script>