<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="SmartUniversity" />
    <title>Q-Farming Login</title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link href="{{ asset('admin/fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/fonts/material-design-icons/material-icon.css') }}" rel="stylesheet" type="text/css" />
    <!-- bootstrap -->
    <link href="{{ asset('admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- style -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/pages/extra_pages.css') }}">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/img/favicon.ico') }}" />
</head>
<body>
<div class="form-title">
    <h1>Q-Farming</h1>
</div>
<!-- Login Form-->
<div class="login-form text-center">
    <div class="toggle">
{{--        <i class="fa fa-user-plus"></i>--}}
    </div>
    <div class="form formLogin">
        <h2>Login to your account</h2>
        <form method="post" action="{{ route('login') }}">
            @csrf
            <input type="text" placeholder="Username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus />
            @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <div class="remember text-left">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox2" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} checked>
                    <label for="checkbox2">
                        Remember me
                    </label>
                </div>
            </div>
            <button>{{ __('Login') }}</button>
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif

        </form>
    </div>
    <div class="form formRegister">
        <h2>Create an account</h2>
        <form>
            <input type="text" placeholder="Username" />
            <input type="password" placeholder="Password" />
            <input type="email" placeholder="Email Address" />
            <input type="text" placeholder="Full Name" />
            <input type="tel" placeholder="Phone Number" />
            <button>Register</button>
        </form>
    </div>
    <div class="form formReset">
        <h2>Reset your password?</h2>
        <form>
            <input type="email" placeholder="Email Address" />
            <button>Send Verification Email</button>
        </form>
    </div>
</div>
<!-- start js include path -->
<script src="{{ asset('admin/assets/plugins/jquery/jquery.min.js') }}" ></script>
<script src="{{ asset('admin/assets/js/pages/extra_pages/pages.js') }}" ></script>
<!-- end js include path -->
</body>
</html>
