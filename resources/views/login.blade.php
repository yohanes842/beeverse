<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
    <title>Login</title>
    <style>
        .centered-form{
            padding: 27px;
            width: 50%;
            max-width: 500px;
            background: white;
            text-align: center;
        }
    </style>
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background: #DDDDDD">
    @include('partial.toast')
    <div class="centered-form">
        <h1 class="text-center mb-5" style="color: #7834fc">Beeverse</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            @error('agreement')
                <p class="text-danger">{{ $message }}</p>
            @else
                @if($errors->any())
                    <p class="text-danger">@lang('login.invalid')</p>
                @endif
            @enderror
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                <label for="email">@lang('login.email')</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                <label for="password">@lang('login.password')</label>
            </div>
            <div class="d-flex justify-content-center flex-column" style="width: 100%">
                <div class="my-2"><a class="text-muted" href="{{route('register')}}">@lang('login.link_register')</a></div>
                <button type="submit" class="btn btn-lg text-light" style="background: #7834fc;">@lang('login.login_btn')</button>
            </div>
          </form>
    </div>
</body>
</html>