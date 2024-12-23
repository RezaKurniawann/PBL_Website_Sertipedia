<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Pengguna</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ url('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ url('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/styleLogin.css') }}">

</head>

<body class="hold-transition login-page" style="background: url('{{ url('adminlte/dist/img/background_polinema.jpg') }}') no-repeat center center; background-size: cover;">
    <div class="background-overlay"></div>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline ">
            <div class="card-header text-center">
                <!-- Tambahan Logo -->
                <div class="logos" style="margin-bottom: 1rem; text-align: center;">
                    <a href="{{ url('/') }}" id="logo-link">
                        <img src="{{ url('adminlte/dist/img/LOGO_SERTIPEDIA.png') }}" alt="Logo Sertipedia" class="rounded-logo">
                    </a>
                </div>
                <b>Selamat Datang</b>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sistem Informasi Pendataan Sertifikasi dan Pelatihan Dosen Jurusan Teknologi Informasi</p>
                <form action="{{ url('login') }}" method="POST" id="form-login">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <small id="error-email" class="error-text text-danger"></small>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <small id="error-password" class="error-text text-danger"></small>
                    </div>
                    <div class="row">
                        {{-- <div class="col-12 text-center">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember"><label for="remember">Remember Me</label>
                            </div>
                        </div> --}}
                         <!-- /.col -->
                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn btn-primary btn-block w-50 mx-auto">Masuk</button>
                        </div>
                        <div class="col-12 text-center mt-3">
                            <span class="divider">atau</span>
                        </div>
                        <div class="col-12 text-center mt-3">
                            <a href="{{ url('guest/homepage') }}" class="text-hover">Masuk sebagai Mahasiswa</a>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <!-- jQuery -->
    <script src="{{ url('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ url('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ url('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('adminlte/dist/js/adminlte.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $("#form-login").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        minlength: 4,
                        maxlength: 50
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        maxlength: 20
                    }
                },
                submitHandler: function(form) { // ketika valid, maka bagian yg akan dijalankan
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) { // jika sukses
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                }).then(function() {
                                    window.location = response.redirect;
                                });
                            } else { // jika error
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
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
</body>

</html>