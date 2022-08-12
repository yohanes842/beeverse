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
    <title>Registration Payment</title>
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
        <h3 class="text-center mb-3" style="color: #7834fc">Registration Payment</h3>
        <form id="pay-form" action="{{ route('payment', $user) }}" method="POST">
            @csrf
            <label class="mb-3">Your registration fee is {{ number_format($user->payment_price) }} . Please do the payment to active your account!</label>
            <div class="form-floating mb-3 text-center">
                <input type="number" name="amount" class="form-control" id="amount" placeholder="Amount">
                <label for="amount">Enter your payment amount</label>
                @error('amount')
                    <p class="text-danger">{{ $message }}</p>
                @else
                    @if(session()->has('underpaid'))
                        <p class="text-danger">{{ session('underpaid') }}</p>
                    @endif
                @enderror
                <button id="submit-pay" type="submit" class="btn text-light mt-3" style="background: #7834fc;" data-bs-toggle="modal">Pay</button>
            </div>
        </form>
        @if(session()->has('overpaid'))
            <p class="text-danger">{{ session('underpaid') }}</p>
        @endif
    </div>
    <div class="modal" id="overpaid_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Overpaid!!!</h5>
            </div>
            <div class="modal-body">
              <p>Sorry you overpaid <span id="overpaid_amount"></span>, would you like to enter a 
                balance?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.reload()">No</button>
              <button class="btn btn-primary" onclick="submit()">Yes</button>
            </div>
          </div>
        </div>
      </div>
    <script>
        const form = document.getElementById("pay-form");
        const amount = document.getElementById("amount");
        const pay_btn = document.getElementById("submit-pay")
        const overpaid_span = document.getElementById("overpaid_amount");

        function submit(){
            form.submit();
        }

        form.addEventListener('submit', (e) => {
            if(amount.value > {{ $user->payment_price }}){
                e.preventDefault(); 
                let overpaid = amount.value - {{ $user->payment_price }};
                overpaid_span.innerHTML = overpaid.toLocaleString('id-ID');
                pay_btn.setAttribute("data-bs-target", "#overpaid_modal");
                pay_btn.click();
            }
        });
    </script>
</body>
</html>