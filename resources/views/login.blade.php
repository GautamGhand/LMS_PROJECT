<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    @include('flash-message')
            <section class="form">
                <h1 class="heading">Account Login</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                <label class="txt">Email</label>
                <input type="email" name="email" class="inpt">
                <div>
                    @error('email')
                        {{$message}}
                    @enderror
                    </div>
                    <label class="txt">Password</label>
                    <input type="password" name="password" class="inpt">
                <div>
                @error('password')
                    {{$message}}
                @enderror
                </div>
                <div class="remember">
                    <input type="checkbox" id="scales" name="remember">
                    <label for="remember">Remember me</label>
                    <a href="{{ route('forgotpassword.index') }}">Forgot Password?</a>
                </div>
                <input type="submit" name="submit" value="LOGIN" class="btn btn-primary btnn">
        </form>
    </section>
</body>
</html>