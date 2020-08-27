<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data User</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataUser" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>No Telp</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($users as $user) { ?>
                            <tr>
                                <th><?= $no++ ?></th>
                                <td><?= $user->nama ?></td>
                                <td><?= $user->no_telp ?></td>
                                <td><?= $user->level == 1 ? "Admin" : "Kasir" ?></td>
                                <td>
                                    <a href="<?= base_url('user/detail/' . $user->id_user) ?>" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                    <button class="btn btn-sm btn-danger hapus" data-id="<?= $user->id_user ?>"><i class="fas fa-fw fa-trash-alt"></i> Delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Admin</h3>
            </div>
            <div class="card-body">
                <form id="form-tambah-admin" class="form-horizontal">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nama lengkap" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Masukkan alamat email..." id="email" name="email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="No.Telp" id="noTelp" name="noTelp" data-inputmask='"mask": "9999-9999-9999"' data-mask>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Kata sandi" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <select id="jenisKelamin" name="jenisKelamin" class="form-control select2" style="width: 100%;">
                            <option value=""></option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder='Tanggal Lahir' id="tanggal" name="tanggal">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Alamat" id="alamat" name="alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <select id="role" name="role" class="form-control select2" style="width: 100%;">
                            <option value=""></option>
                            <option value="1">Admin</option>
                            <option value="2">Kasir</option>
                        </select>
                    </div>
                    <div class="row">
                        <button id="btn-simpan" type="button" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            var data = $("#dataUser").DataTable({
                "responsive": true,
                "autoWidth": false
            });

            $('#jenisKelamin').select2({
                placeholder: "Pilih Jenis Kelamin"
            });
            $('#role').select2({
                placeholder: "Pilih Role"
            });
            $('#tanggal').datepicker({
                format: "dd-mm-yyyy",
                // startDate: '+2y'
                endDate: '-17y'
            });
            $('[data-mask]').inputmask()

            $("#btn-simpan").on('click', function() {
                let validate = $("#form-tambah-admin").valid();
                if (validate) {
                    $("#form-tambah-admin");
                    prosesTambah();
                }
            });
            $("#form-tambah-admin").validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    noTelp: {
                        required: true
                    },
                    tanggal: {
                        required: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    jenisKelamin: {
                        required: true
                    },
                    role: {
                        required: true
                    },
                    agama: {
                        required: true
                    },
                    alamat: {
                        required: true
                    }
                },
                messages: {
                    password: {
                        minlength: "Password minimal 5 karakter"
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

            function prosesTambah() {
                $("#form-tambah-admin").on('click', function() {
                    var nama = $('#name').val();
                    var email = $('#email').val();
                    var noTelp = $('#noTelp').val();
                    var password = $('#password').val();
                    var jenisKelamin = $('#jenisKelamin').val();
                    var tanggal = $('#tanggal').val();
                    var alamat = $('#alamat').val();
                    var role = $('#role').val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('user/insertUser') ?>",
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
                            nama: nama,
                            email: email,
                            no_telp: noTelp,
                            password: password,
                            jenis_kelamin: jenisKelamin,
                            tanggal: tanggal,
                            alamat: alamat,
                            role: role
                        },
                        success: function(data) {
                            swal({
                                title: 'Berhasil Menambah User',
                                text: nama,
                                type: 'success'
                            }).then(function() {
                                location.reload();
                            })
                        }
                    });
                    // alert(noTelp);
                });
            }

            $('#dataUser').on('click', '.hapus', function() {
                var id = $(this).data('id');
                swal({
                    title: 'Konfirmasi',
                    text: "Anda ingin menghapus ",
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
                            url: "<?= base_url('user/delete/' . $user->id_user) ?>",
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
        });
    </script>