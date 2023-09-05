<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Forgot Password (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../external/main.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{route('login')}}" class="h1"><img src="../../img/petro-logo.png" height="50px" alt="Petro Logo"></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Menunggu Persetujuan Akun Pengguna</p>
                <p class="text-justify">Akun Anda sedang menunggu persetujuan administrator kami. Silakan periksa kembali nanti.</p>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger mt-3">Logout</button>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>