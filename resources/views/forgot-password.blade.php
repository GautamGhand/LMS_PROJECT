<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="app.css">
</head>
<body>
    @include('flash-message')
    <div class="heading-forgot-password">
        <h1>Forgot Password</h1>
    </div>
<section class="forgot-password-form">
    <div>
    <form method="POST" action="{{ route('forgotpassword.mail') }}">
        @csrf
    <label class="form-label">Enter Your Email</label>
    <input type="email" name="email" class="form-input" required>
    <div class="text-danger">
        @error('email')
            {{ $message }}
        @enderror
    </div>
    <div class="email-send-button">
        <input type="submit" name="submit" value="Send Email">
        <a href="{{ route('login') }}" class="cancel">Cancel</a>
    </div>
    </form>
    </div>
</section>
</body>
</html>