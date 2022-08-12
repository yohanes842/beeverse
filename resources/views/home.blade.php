@extends('layout.main')

@section('title', 'Home')

@section('body')

    <h2 class="text-center">
        Fellow users</h2>
    <h6 class="text-center">Find someone you might like...</h6>
    <div class="d-flex mx-auto gap-5" style="width: 80%">
        <form id="formFilter" action="{{ route('search') }}" method="GET" class="d-flex" role="search">
            <div class="p-2 my-5 shadow-lg" style="min-width: 197px; background: #FFF9D7; height: fit-content">
                <h5 class="ms-2">Filter Hobbies</h5>
                <input type="hidden" id="search-key" name="search-keyword">
                <input type="hidden" id="gender-key" name="gender">
                @foreach ($hobbies as $hobby)
                    <div class="form-check ms-3">
                        <input class="form-check-input" style="border: solid 2px #7834fc" name="hobbies[]" type="checkbox" value="{{ $hobby->hobby_name }}" id="flexCheckDefault" {{ (isset($hobbies_cheked) && is_array($hobbies_checked) && in_array($hobby->hobby_name, $hobbies_checked)) ? ' checked' : '' }}>
                        <label class="form-check-label" for="hobbies[]">
                            {{ $hobby->hobby_name }}
                        </label>
                    </div>
                @endforeach
                <button class="btn btn-sm text-light mt-3" style="background: #7834fc; width: 100%;" type="submit"> Filter</button>
            </div>
        </form>
        <div class="d-flex flex-wrap gap-5 mx-auto my-5" style="width:86%">
            @forelse($users as $user)
            <a href="{{route('collection', $user)}}" class="text-decoration-none">
              <div class="card shadow-lg" style="width: 18rem">
                    <div class="position-relative">
                        @if($user->visible_status_id == 2)
                            @php $rand =  random_int(1,3) @endphp
                            <img src="{{asset('bear/'.$rand.'.jpg')}}" class="card-img-top img-fluid" style="width: 429px; height: 286px; object-fit:cover;" alt="...">
                            <img src="{{asset('bear/'.$rand.'.jpg')}}" class="card-img-top position-absolute bottom-0 end-0 me-5" style="width: 83px; height: 83px; border-radius: 50%; border: solid 3px white; filter: drop-shadow(0 0 1rem #370042); transform: translateY(50%); background: #FFF9CA;" alt="...">
                        @elseif($user->visible_status_id == 1)
                            <img src="https://source.unsplash.com/300x300/?{{$user->hobby}}" class="card-img-top" alt="..."> 
                            @if(!isset($user->image_profile))
                                <img src="https://source.unsplash.com/300x300/?{{$user->hobby}}" class="card-img-top position-absolute bottom-0 end-0 me-5" style="width: 83px; height: 83px; border-radius: 50%; border: solid 3px white; filter: drop-shadow(0 0 1rem #370042); transform: translateY(50%); background: #FFF9CA;" alt="...">
                            @else
                                <img src="{{asset($user->image_profile)}}" class="card-img-top position-absolute bottom-0 end-0 me-5" style="width: 83px; height: 83px; border-radius: 50%; border: solid 3px white; filter: drop-shadow(0 0 1rem #370042); transform: translateY(50%); background: #FFF9CA;" alt="...">
                            @endif
                        @endif
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center mt-3 shadow-top bg-light" >
                        <div class="d-flex align-items-center" style="width: 80%">
                            <div>
                                <h5 class="card-title mb-0 text-sm">
                                    @if($user->gender_id == 1)
                                        <i class="fa-solid fa-mars fa-1x mx-1" style="color: #7834fc"></i>
                                    @elseif($user->gender_id == 2)
                                        <i class="fa-solid fa-venus fa-1x mx-1" style="color: #FA2FB5"></i>
                                    @endif
                                    {{ $user->nickname }}
                                </h5>
                                <p class="card-text">{{ $user->hobby }}</p>
                            </div>
                        </div>
                        @auth
                        <form action="{{ route('thumb', $user) }}" method="POST">
                            @csrf
                            <button type='submit' class="btn" style="border: none; background-color: none;">
                                @if(auth()->user()->wishlists()->where('wishlisted_user_id', $user->id)->first())
                                    <i  class="fa-solid fa-thumbs-up fa-2x" style="color: #7834fc"></i>
                                @else
                                    <i  class="fa-solid fa-thumbs-up fa-2x text-muted" style="color: white"></i>
                                @endif
                            </button>
                        </form>
                        @endauth
                    </div>
                </div>
            </a>
            @empty
                <h2 class="text-center" style="width: 100%">No user found!</h2>
            @endforelse
        </div>
    </div>
    

@endsection