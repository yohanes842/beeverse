@extends('layout.main')

@section('title', 'Shop')

@section('body')
    <h2 class="text-center">@lang('shop.title1')</h2>
    <h6 class="text-center">@lang('shop.title2')</h6>
    <div class="d-flex flex-wrap gap-5 mx-auto my-5" style="width:86%">
        @foreach($avatars as $avatar)
            @if(!auth()->user()->usersAvatars()->where('avatar_id', $avatar->id)->first())
                <div class="card shadow" style="width: 18rem">
                    <img src="{{asset($avatar->image_url)}}" class="card-img-top img-fluid" style="width: 286px; height: 429px; object-fit:cover; background: #feefff;" alt="...">
                    <div class="card-body d-flex flex-column justify-content-between align-items-center gap-2" style="background: #FFF9D7; filter: drop-shadow(0 -1mm 1rem #370042);">
                        <div class="d-flex align-items-center" style="width: 100%">
                            <div style="color: #C689C6">
                                <h4 card-title mb-0>{{$avatar->name}}</h4>
                                <h6 class="card-title mb-0">
                                    @lang('general.price') : 
                                    <i class="fa-solid fa-coins fa-1x mx-1" style="color: gold"></i>
                                    {{ number_format($avatar->price) }}
                                </h6>
                            </div>
                        </div>
                        <div class="justify-content-end d-flex gap-2" style="width: 100%">
                            <form action="{{ route('purchase', $avatar) }}" method="POST">
                                @csrf
                                    <button class="text-light btn" type='submit' style="border: none; background-color: #7834fc;">
                                        @lang('shop.purchase')
                                    </button>
                            </form>
                            <button avatar="{{$avatar}}" data-bs-toggle="modal" data-bs-target="#send-modal" class="gift-btn text-light btn" type='button' style="border: none; background-color: #7834fc;">
                                <i class="fa-solid fa-gift fa-1x mx-1" style="color: #FBCAFF"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        @foreach($had as $avatar)
                <div class="card shadow" style="width: 18rem">
                    <img src="{{asset($avatar->avatar->image_url)}}" class="card-img-top img-fluid" style="width: 286px; height: 429px; object-fit:cover; filter: brightness(67%); background: #feefff;" alt="...">
                    <div class="card-body d-flex flex-column justify-content-between align-items-center gap-2" style="background: #FFF9D7; filter: drop-shadow(0 -1mm 1rem #370042);">
                        <div class="d-flex align-items-center" style="width: 100%">
                            <div style="color: #C689C6">
                                <h4 card-title mb-0>{{$avatar->avatar->name}}</h4>
                                <h6 class="card-title mb-0">
                                    @lang('general.price') : 
                                    <i class="fa-solid fa-coins fa-1x mx-1" style="color: gold"></i>
                                    {{ number_format($avatar->avatar->price) }}
                                </h6>
                            </div>
                        </div>
                        <div class="justify-content-end d-flex gap-2" style="width: 100%">
                            <form action="{{ route('purchase', $avatar->avatar) }}" method="POST">
                                @csrf
                                <button class="text-light btn btn-secondary" type='submit' style="border: none;" disabled>
                                    @lang('shop.had')
                                </button>
                            </form>
                            <button avatar="{{$avatar->avatar}}" data-bs-toggle="modal" data-bs-target="#send-modal" class="gift-btn text-light btn" type='button' style="border: none; background-color: #7834fc;">
                                <i class="fa-solid fa-gift fa-1x mx-1" style="color: #FBCAFF"></i>
                            </button>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>
    
    <div class="modal"  id="send-modal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content" style="background: #FFF9D7">
            <div class="modal-header">
              <h5 class="modal-title">@lang('shop.select_friend')</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @forelse($friends as $friend)
                <div class="shadow p-2 d-flex justify-content-between align-items-center" style="background: #fde2ff">
                    <div class="d-flex gap-3">
                        <img src="{{asset($friend->wishlistedUser->image_profile)}}" class="card-img-top img-fluid" style="width: 57px; height: 57px; border-radius: 50%; border: solid 3px #FA2FB5; background: #FFF9D7;" alt="...">
                        <div>
                            <span>
                                @if($friend->wishlistedUser->gender_id == 1)
                                <i class="fa-solid fa-mars fa-1x mx-1" style="color: #7834fc"></i>
                                @elseif($friend->wishlistedUser->gender_id == 2)
                                <i class="fa-solid fa-venus fa-1x mx-1" style="color: #FA2FB5"></i>
                                @endif
                            </span>
                            <span class="mb-0">{{$friend->wishlistedUser->nickname}}</span>
                            <p class="mb-0">{{$friend->wishlistedUser->name}}</p>
                        </div>
                    </div>
                        <form action="{{route('send-avatar',$friend->wishlistedUser)}}" method="POST">
                            @csrf
                            <input class="gift-input" type="hidden" name="avatar">
                            <button class="text-light btn px-2" type='submit' style="height: 2.5rem; border: none; background-color: #7834fc;">
                                <i class="fa-solid fa-gift fa-1x  m-0" style="color: #FBCAFF"></i>
                            </button>
                        </form>
                    </div>
                @empty
                    <h5>@lang('shop.no_friend')</h5>
                @endforelse
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
@endsection