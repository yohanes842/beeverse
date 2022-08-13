@extends('layout.main')

@section('title', 'Collectors Angel')

@section('body')
    @if($user == auth()->user())
        <h1 class="text-center">My Profile</h1>
        <div class="card mb-3 mx-auto p-2 d-flex" style="max-width: 630px; background: #feefff">
            <div class="row g-0">
                @if(!isset($user->image_profile))
                    <div class="d-flex justify-content-center align-items-center col-md-5" 
                    style="width: 10rem; background: url('https://source.unsplash.com/300x200/?{{$user->hobby}}'); background-position: center;background-repeat: no-repeat; background-size: cover;">
                        <img src="https://source.unsplash.com/300x200/?{{$user->hobby}}" class="card-img-top" style="width: 70px; height: 70px; border-radius: 50%; border: solid 3px white; filter: drop-shadow(0 0 1rem #370042);" alt="..."> 
                    </div>
                @else
                    <div class="d-flex justify-content-center align-items-center col-md-5" 
                    style="width: 12rem;">
                        <img src="{{asset($user->image_profile)}}" class="card-img-top img-fluid" style="width: 97px; height: 97px; border-radius: 50%; border: solid 3px white; filter: drop-shadow(0 0 1rem #370042); background: #FFF9CA;" alt="...">
                    </div>
                @endif
                <div class="col-md-8">
                    <div class="card-body d-flex gap-5 justify-content-between">
                        <div>
                            <h5 class="card-title mb-0">
                            @if($user->gender_id == 1)
                                <i class="fa-solid fa-mars fa-1x mx-1" style="color: #7834fc"></i>
                            @elseif($user->gender_id == 2)
                                <i class="fa-solid fa-venus fa-1x mx-1" style="color: #FA2FB5"></i>
                            @endif
                                {{$user->nickname}}</h5>
                            <h6 class="card-text mb-0">{{$user->name}}</h6>
                            <h6 class="card-text mb-0">{{$user->age}} years old</h6>
                            <h6 class="card-text mb-0">{{$user->mobile_number}}</h6>
                            <h6 class="card-text mb-0 text-muted">{{$user->hobby}}</h6>
                        </div>
                        <div class="text-end d-flex flex-column justify-content-between" style="width: fit-content">
                            <div>
                                <h6 class="card-text mb-0 text-nowrap">Total friend(s) : {{$user->countFriends()}}</h6>
                                <h6 class="card-text mb-0 text-nowrap">Total collection(s) : {{$user->countCollections()}}</h6>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn text-light btn-sm btn-dark"><a href="{{$user->instagram_username}}" target="_blank" style="text-decoration: none; color: white">Instagram</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-center">My Avatars</h2>
        <h6 class="text-center">Manage your avatars...</h6>
        <div class="d-flex flex-wrap gap-5 mx-auto my-5" style="width:86%">
            @forelse($collections as $collection)
                <div class="card shadow" style="width: 18rem; border-radius: 100px">
                    <img src="{{asset($collection->avatar->image_url)}}" class="card-img-top img-fluid" style="background: #feefff; width: 286px; height: 429px; object-fit:cover;" alt="...">
                    <div class="card-body d-flex gap-5 justify-content-between">
                        <div>
                            <h5 class="card-title mb-0">
                            @if($user->gender_id == 1)
                                <i class="fa-solid fa-mars fa-1x mx-1" style="color: #7834fc"></i>
                            @elseif($user->gender_id == 2)
                                <i class="fa-solid fa-venus fa-1x mx-1" style="color: #FA2FB5"></i>
                            @endif
                                {{$user->nickname}}</h5>
                            <h6 class="card-text mb-0">{{$user->name}}</h6>
                            <h6 class="card-text mb-0">{{$user->age}} years old</h6>
                            <h6 class="card-text mb-0">{{$user->mobile_number}}</h6>
                            <h6 class="card-text mb-0 text-muted">{{$user->hobby}}</h6>
                        </div>
                        <div class="text-end d-flex flex-column justify-content-between" style="width: fit-content">
                            <div>
                                <h6 class="card-text mb-0 text-nowrap">Total friend(s) : {{$user->countFriends()}}</h6>
                                <h6 class="card-text mb-0 text-nowrap">Total collection(s) : {{$user->countCollections()}}</h6>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn text-light btn-sm btn-dark"><a href="{{$user->instagram_username}}" target="_blank" style="text-decoration: none; color: white">Instagram</a></button>
                                <button class="btn text-dark fw-bold btn-sm btn-light border-dark border-2"><a href="{{route('chat', $user)}}" target="_blank" style="text-decoration: none; color: black">Chat</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h2 class="text-center" style="width: 100%">No avatar available!</h2>
            @endforelse
        </div>

    @elseif($user->visible_status_id == 1 || auth()->user()->wishlists()->where('wishlisted_user_id', $user->id)->where('isFriend', true)->first())
        <h1 class="text-center">{{$user->name}} Profile</h1>
        <div class="card mb-3 mx-auto" style="max-width: 630px;">
            <div class="row g-0">
                @if(!isset($user->image_profile))
                    <div class="d-flex justify-content-center align-items-center col-md-3" 
                    style="width: 10rem; background: url('https://source.unsplash.com/300x200/?{{$user->hobby}}'); background-position: center;background-repeat: no-repeat; background-size: cover;">
                        <img src="https://source.unsplash.com/300x200/?{{$user->hobby}}" class="card-img-top" style="width: 70px; height: 70px; border-radius: 50%; border: solid 3px white; filter: drop-shadow(0 0 1rem #370042);" alt="..."> 
                    </div>
                @else
                    <div class="d-flex justify-content-center align-items-center col-md-3" 
                    style="width: 12rem; background: url('https://source.unsplash.com/300x200/?{{$user->hobby}}'); background-position: center;background-repeat: no-repeat; background-size: cover;">
                        <img src="{{asset($user->image_profile)}}" class="card-img-top img-fluid" style="width: 70px; height: 70px; border-radius: 50%; border: solid 3px white; filter: drop-shadow(0 0 1rem #370042); background: #FFF9CA;" alt="...">
                    </div>
                @endif
                <div class="col-md-8">
                    <div class="card-body d-flex gap-5 justify-content-between">
                        <div>
                            <h5 class="card-title mb-0">
                            @if($user->gender_id == 1)
                                <i class="fa-solid fa-mars fa-1x mx-1" style="color: #7834fc"></i>
                            @elseif($user->gender_id == 2)
                                <i class="fa-solid fa-venus fa-1x mx-1" style="color: #FA2FB5"></i>
                            @endif
                                {{$user->nickname}}</h5>
                            <h6 class="card-text mb-0">{{$user->name}}</h6>
                            <h6 class="card-text mb-0">{{$user->age}} years old</h6>
                            <h6 class="card-text mb-0">{{$user->mobile_number}}</h6>
                            <h6 class="card-text mb-0 text-muted">{{$user->hobby}}</h6>
                        </div>
                        <div class="text-end d-flex flex-column justify-content-between" style="width: fit-content">
                            <div>
                                <h6 class="card-text mb-0 text-nowrap">Total friend(s) : {{$user->countFriends()}}</h6>
                                <h6 class="card-text mb-0 text-nowrap">Total collection(s) : {{$user->countCollections()}}</h6>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn text-light btn-sm btn-dark"><a href="{{$user->instagram_username}}" target="_blank" style="text-decoration: none; color: white">Instagram</a></button>
                                <button class="btn text-dark fw-bold btn-sm btn-light border-dark border-2"><a href="{{route('chat', $user)}}" target="_blank" style="text-decoration: none; color: black">Chat</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-center">{{$user->name}} Avatars Collection</h2>
        <div class="d-flex flex-wrap gap-5 mx-auto my-5" style="width:86%">
            @forelse($collections as $collection)
                <div class="card shadow" style="width: 18rem; border-radius: 100px">
                    <img src="{{asset($collection->avatar->image_url)}}" class="card-img-top img-fluid" style="background: #feefff; width: 286px; height: 429px; object-fit:cover;" alt="...">
                    <div class="card-body d-flex flex-column justify-content-between align-items-center gap-2" style="background: #FFF9D7" >
                        <div class="d-flex align-items-center" style="width: 100%">
                            <div style="color: #C689C6">
                                <h4 card-title mb-0>{{$collection->avatar->name}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h2 class="text-center" style="width: 100%">No avatar available!</h2>
            @endforelse
        </div>
    @else
        <h1 class="text-center">Sorry this account is private!</h1>
    @endif
@endsection