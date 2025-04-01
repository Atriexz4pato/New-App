<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website with login and registration form</title>
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
</head>
<body>

<header class="navigation">
{{--    <h2 class="logo">Logo</h2>--}}
    <nav class="navigation">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Servies</a>
        <a href="#">Contact</a>
    </nav>
    <button class="btnLogin-popup">Login</button>
</header>
<div class=" wrapper">

    <span class="icon-close"><ion-icon name="close"></ion-icon></span>
    <div class="form-box login">
        <h2>Login</h2>
        <form method="POST" action="/login">
            @csrf
            <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                <input type="text" name="email" value="{{old('email')}}" required>
                <label>Email</label>
                @error('email')
                <span class="error"> {{$message}}</span>
                @enderror
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" name="password" required>
                <label>Password</label>
                @error('password')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox" name="remember">Remember me</label>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="login-register">
                <p>Don't have an account? <a href="#" class="register-link">Register</a></p>
            </div>
        </form>
    </div>

    <div class="{{ $errors->any() && request()->is('register') ? 'active active-popup' : '' }} form-box register">
        <h2>Registration</h2>
        <form method="POST" action="/register">
            @csrf
            <div class="input-box">
                <span class="icon"><ion-icon name="name"></ion-icon></span>
                <input type="text" name="name" value="{{old('name')}}" required>
                <label>Name</label>
                @error('name')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="email"></ion-icon></span>
                <input type="email" name="email" value="{{old('email')}}" required>
                <label>Email</label>
                @error('email')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="phone_number"></ion-icon></span>
                <input type="text" name="phone_number" value="{{old('phone_number')}}" required>
                <label>Phone</label>
                @error('phone_number')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-box">
                <span class="icon"><ion-icon name="registration_number"></ion-icon></span>
                <input type="text" name="registration_number" value="{{old('registration_number')}}" required>
                <label>Reg Number</label>
                @error('registration_number')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="password"></ion-icon></span>
                <input type="password" name="password" required>
                <label>Password</label>
                @error('password')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

{{--            <div class="input-box">--}}
{{--                <span class="icon"><ion-icon name="confirm-password"></ion-icon></span>--}}
{{--                <input type="password" name="confirm-password" required>--}}
{{--                <label>Confirm-Password</label>--}}
{{--                @error('confirm-password')--}}
{{--                <span class="error">{{ $message }}</span>--}}
{{--                @enderror--}}
{{--            </div>--}}
            <div class="remember-forgot">
                <label><input type="checkbox" name="terms">I agree to the terms & conditions</label>
                @error('terms')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn">Register</button>
            <div class="login-register">
                <p>Already have an account? <a href="#" class="login-link">Login</a></p>
            </div>
        </form>
    </div>

<script src="{{asset('assets/js/login.js')}}"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
