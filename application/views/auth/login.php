<!-- /.login-logo -->
<div class="login-box">
    <div class="login-logo">
        <b>POS</b> Application
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                Masuk untuk memulai sesi Anda</p>

            <?= $this->session->flashdata('message') ?>

            <form id="form-registration" method="POST" action="<?= base_url('auth/login') ?>">
                <div class="form-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan alamat email..." id="email" name="email">
                </div>
                <div class="form-group mb-3">
                    <input type="password" class="form-control" placeholder="Kata sandi" id="password" name="password">
                </div>
                <div class="row">
                    <button id="btn-login" type="submit" class="btn btn-primary btn-block">Masuk</button>
                </div>
            </form>

            <!-- /.social-auth-links -->

        </div>
        <!-- /.login-card-body -->
    </div>
</div>

<!-- /.login-box -->
<script>
    $(function() {
        $("#btn-login").on('click', function() {
            let validate = $("#form-registration").valid();
            if (validate) {
                $("#form-registration").submit();
            }
        });
        $("#form-registration").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5
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
    });
</script>