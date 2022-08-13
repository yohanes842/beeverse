@extends('layout.main')

@section('title', 'Collectors Angel')

@section('body')
<div class="scroll-chat mx-2 overflow-scroll mb-0" style="height:84vh; scroll-behavior: smooth;">
    <p class="mx-auto bg-dark rounded-pill text-light px-2" style="width: fit-content">Today</p>
        @foreach($chats as $chat)
            {{-- @if(date('d-m-Y', strtotime($chat->created_at)) == date('d-m-Y', strtotime(now()))) --}}
            @if($chat->user_id == auth()->user()->id)
                <div class="d-flex flex-row-reverse">
                    <div>
                        <img src="{{asset(auth()->user()->image_profile)}}" class="card-img-top img-fluid mx-2" style="width: 47px; height: 47px; border-radius: 50%; border: solid 3px white; background: #FFF9D7;" alt="...">
                        <p class="text-center text-light mb-2" style="line-height: 15px">{{auth()->user()->name}}</p>
                    </div>
                    <div class="d-flex flex-row-reverse align-items-end" style="height: fit-content; max-width: 45%">
                        <p class="bg-light p-2 rounded-pill my-1 px-3" style="height: fit-content">
                            {{ $chat->chat_desc }}
                        </p>
                        <span class="text-light mx-1" style="font-size: 10pt; line-height: 15px">
                            @if($chat->isRead)
                                <p class="mb-0">Read</p>
                            @endif
                            <p class="mb-0">{{date('H:i', strtotime($chat->created_at)) }}</p>
                        </span>
                    </div>
                </div>
            @else
                <div class="d-flex">
                    <div>
                        <img src="{{asset($user->image_profile)}}" class="card-img-top img-fluid mx-2" style="width: 47px; height: 47px; border-radius: 50%; border: solid 3px white; background: #FFF9D7;" alt="...">
                        <p class="text-center text-light mb-2" style="line-height: 15px">{{$user->name}}</p>
                    </div>
                    <div class="d-flex align-items-end" style="height: fit-content; max-width: 45%">
                        <p class="bg-light p-2 rounded-pill my-1 px-3" style="height: fit-content">
                            {{ $chat->chat_desc }}
                        </p>
                        <span class="text-light mx-1" style="font-size: 10pt; line-height: 15px">
                            @if($chat->isRead)
                                <p class="mb-0">Read</p>
                            @endif
                            <p class="mb-0">{{date('H:i', strtotime($chat->created_at)) }}</p>
                        </span>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <form action="{{route('chat', $user)}}" method="POST">
    @csrf
    <div class="input-group mb-3 position-absolute bottom-0">
            <input type="text" name="chat" class="form-control"  placeholder="Enter a message" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="text-light btn" type='submit' style="border: none; background-color: #7834fc;">
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </form>
@endsection