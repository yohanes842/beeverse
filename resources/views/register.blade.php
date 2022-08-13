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
    <title>Register</title>
    <style>
        .centered-form{
            padding: 27px;
            width: 65%;
            max-width: 670px;
            background: white;
            margin-block: 100px;
        }
    </style>
</head>
<body style="display: flex; justify-content: center; background: #DDDDDD">
    <div class="centered-form" style="color: #7A4495">
        <h1 class="text-center mb-3" style="color: #7834fc">Beeverse</h1>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}">
                <label for="name">@lang('register.name')</label>
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="nickname" class="form-control" id="nickname" placeholder="Nickname" value="{{ old('nickname') }}">
                <label for="nickname">@lang('register.nickname')</label>
                @error('nickname')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="number" name="age" class="form-control" id="age" placeholder="Age" value="{{ old('age') }}">
                <label for="age">@lang('register.age')</label>
                @error('age')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <div class="d-flex gap-5 ">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="maleCheckbox" value="1" @if(old('gender') == 1) checked @endif>
                        <label class="form-check-label" for="male">
                            @lang('register.male')
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="femaleCheckbox" value="2" @if(old('gender') == 2) checked @endif>
                        <label class="form-check-label" for="female">
                            @lang('register.female')
                        </label>
                    </div>
                </div>
                @error('gender')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="instagram_username" class="form-control" id="instagram_username" placeholder="Instagram username" value="{{ old('instagram_username') }}">
                <label for="instagram_username">@lang('register.instagram_username')</label>
                @error('instagram_username')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="mobile_number" class="form-control" id="mobile_number" placeholder="Mobile number" value="{{ old('mobile_number') }}">
                <label for="mobile_number">@lang('register.mobile_number')</label>
                @error('mobile_number')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <Label for="hobbies" class="fs-5">@lang('register.hobbies.input')<span class="fs-6 text-muted">(min: 3)</span></Label>
                <div id="hobby-field-container" class="ms-3">
                    <input type="text" class="form-control mb-1" placeholder="@lang('register.hobbies.placeholder')" name="hobbies[]" required>
                    <input type="text" class="form-control mb-1" placeholder="@lang('register.hobbies.placeholder')" name="hobbies[]" required>
                    <input type="text" class="form-control mb-1" placeholder="@lang('register.hobbies.placeholder')" name="hobbies[]" required>
                    </div>
                    <button id="add-field-btn" class="btn btn-primary fs-5 px-2 lh-1 m-1" type="button" id="add-field">+</button>
                @error('hobbies')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" value="{{ old('email') }}">
                <label for="email">@lang('register.email')</label>
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                <label for="password">@lang('register.password')</label>
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm password">
                <label for="confirm_password">@lang('register.c_password')</label>
                @error('confirm_password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="d-flex justify-content-center text-center flex-column" style="width: 100%">
                <a class="text-muted mb-2" href="{{route('login')}}">@lang('register.link_login')</a>
                <button type="submit" class="btn btn-lg text-light" style="background: #7834fc;">@lang('register.register')</button>
            </div>
          </form>
    </div>
</body>
</html>