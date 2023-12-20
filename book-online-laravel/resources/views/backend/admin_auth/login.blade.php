<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet">
    <!-- toastr message -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <!-- fontawsome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- toastr message -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>

<body>

    <div class="login-form">
        <form action="{{ route('admin.login_submit') }}" method="POST">
            @csrf
            <div class="form-group small clearfix">
                <a href="{{ route('home') }}" class="back-home text-decoration-none"><i class="fa-solid fa-chevron-left"></i> Trang đọc sách</a>
            </div>
            <div class="img-box"><img src="{{asset('assets/images/logos/security_logo.png')}}" alt=""></div>
            <h4 class="modal-title my-3" style="color:darkcyan;">Login to Admin Page!!!</h4>
            <div class="form-group">
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group small clearfix">
                <label class="form-check-label" for="remember"><input type="checkbox" name="remember_admin" id="remember" {{ old('remember') ? 'checked' : '' }}> Ghi nhớ</label>
                <!-- @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">Quên mật khẩu?</a>
                @endif -->
            </div>
            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Đăng nhập">
        </form>
        <!-- <div class="text-center medium mt-3">Bạn chưa có tài khoản? <a href="{{ route('register') }}" class="register">Tạo tài khoản</a></div> -->
    </div>
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
            "timeOut": 4000,
            "closeDuration": 400,
            "preventDuplicates": true,
            "showMethod": 'fadeIn',
            "hideMethod": 'fadeOut',
            "closeMethod": 'fadeOut',
            positionClass: 'toast-top-full-width'
        }
    </script>
    @if(session('error'))
    <!-- toastr message -->
    <script>
        toastr.error("{{session('error')}}", "Thất bại!!!");
    </script>
    @endif
    @if(session('success'))
    <!-- toastr message -->
    <script>
        toastr.success("{{session('success')}}", "Thành công!!!");
    </script>
    @endif
</body>

</html>