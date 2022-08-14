@extends('layout.main')

@section('title', 'Friends')

@section('body')
    <h2 class="text-center">@lang('friend.title')</h2>
    <h6 class="text-center">@lang('friend.subtitle')</h6>
    <div class="d-flex flex-column flex-wrap gap-3 mx-auto my-5 align-items-center" style="width:86%">
        @forelse($friends as $friend)
            <div class="card shadow rounded p-3" style="max-width: 740px; width: 70%">
                <div class=" d-flex justify-content-between align-items-end pe-5 pb-2">
                    <div class="d-flex">
                        @if($friend->wishlistedUser->visible_status_id == 1)
                            <div class="d-flex justify-content-end align-items-end col-md-3 py-2 px-3" 
                            style="width: 13rem; background: url('https://source.unsplash.com/300x200/?{{$friend->wishlistedUser->hobby}}'); background-position: center;background-repeat: no-repeat; background-size: cover;">
                            @if(!isset($friend->wishlistedUser->image_profile))
                                <img src="https://source.unsplash.com/300x200/?{{$friend->wishlistedUser->hobby}}" class="card-img-top" style="width: 57px; height: 57px px-3; border-radius: 50%; border: solid 3px white; filter: drop-shadow(0 0 1rem #370042);" alt="..."> 
                            @else 
                                <img src="{{asset($friend->wishlistedUser->image_profile)}}" class="card-img-top img-fluid" style="width: 57px; height: 57px; border-radius: 50%; border: solid 3px white; filter: drop-shadow(0 0 1rem #370042); background: #FFF9D7;" alt="...">
                            @endif
                            </div>
                        @else
                            @php $rand =  random_int(1,3) @endphp
                            <div class="d-flex justify-content-end align-items-end col-md-3 py-2 px-3" 
                            style="width: 13rem; background: url('{{asset('bear/'.$rand.'.jpg')}}'); background-position: center;background-repeat: no-repeat; background-size: cover;">
                                <img src="{{asset('bear/'.$rand.'.jpg')}}" class="card-img-top img-fluid" style="width: 57px; height: 57px; border-radius: 50%; border: solid 3px white; filter: drop-shadow(0 0 1rem #370042); background: #FFF9D7;" alt="...">
                            </div>
                        @endif
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title mb-0">
                                    @if($friend->wishlistedUser->gender_id == 1)
                                        <i class="fa-solid fa-mars fa-1x mx-1" style="color: #7834fc"></i>
                                    @elseif($friend->wishlistedUser->gender_id == 2)
                                        <i class="fa-solid fa-venus fa-1x mx-1" style="color: #FA2FB5"></i>
                                    @endif
                                    {{$friend->wishlistedUser->nickname}}</h5>
                                <h6 class="card-text mb-0">{{$friend->wishlistedUser->name}}</h6>
                                <h6 class="card-text mb-0">{{$friend->wishlistedUser->age}} @lang('general.years_old')</h6>
                                <h6 class="card-text mb-0">{{$friend->wishlistedUser->mobile_number}}</h6>
                                <h6 class="card-text mb-0 text-muted">{{$friend->wishlistedUser->hobby}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-end gap-1" style="width: fit-content">
                        <a href="{{route('chat', $friend->wishlistedUser)}}" style="width: 100%">
                            <button class="btn btn-dark btn-sm py-1 px-3" style="width: 100%">@lang('general.chat')
                            @if(auth()->user()->countNewChat($friend->wishlistedUser) > 0)
                                <span class="rounded-circle bg-danger text-light px-2">{{auth()->user()->countNewChat($friend->wishlistedUser)}}</span>
                            @endif
                            </button></a> 
                        <a href="{{route('collection', $friend->wishlistedUser)}}" style="width: 100%"><button class="btn btn-light border-dark border-2 btn-sm py-1 px-3" style="width: 100%">@lang('friend.view')</button></a> 
                    </div>
                </div>
              </div>
        @empty
            <h2 class="text-center" style="width: 100%">@lang('friend.no_friend')</h2>
        @endforelse
    </div>
@endsection