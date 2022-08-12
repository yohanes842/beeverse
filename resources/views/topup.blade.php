@extends('layout.main')

@section('title', 'Top Up')

@section('body')
<div class="centered-form mx-auto text-center shadow" style="color: #7A4495">
    <h3 class="text-center mb-3" style="color: #7834fc">
        <i class="fa-solid fa-coins fa-1x me-2" style="color: gold"></i>Top Up
    </h3>
    <form id="pay-form" action="{{ route('topup-process', auth()->user()) }}" method="POST">
        @csrf
        <h4 class="mb-3">Every topup with 1 button click will add 100 coins!</h4>
        <div class="form-floating mb-3 text-center">
            <button id="submit-pay" type="submit" class="btn btn-lg text-light mt-3 fs-3" style="width: 167px; height: 67px; background: #7834fc;">Click Me</button>
        </div>
    </form>
    @if(session()->has('overpaid'))
        <p class="text-danger">{{ session('underpaid') }}</p>
    @endif
</div>

@endsection