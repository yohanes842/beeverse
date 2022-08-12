<header>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: #7834fc; z-index: 10">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{route('home')}}">Beeverse</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a id="navbar-home" class="nav-link text" aria-current="page" href="{{route('home')}}">Home</a>
              </li>
              @auth
                <li class="nav-item">
                  <a id="navbar-shop" class="nav-link" href="{{route('shop')}}">Shop</a>
                </li>
                <li class="nav-item">
                  <a id="navbar-collectors" class="nav-link" href="{{route('collection', auth()->user())}}">Collector Angels</a>
                </li>
                <li class="nav-item">
                  <a id="navbar-friends" class="nav-link" href="{{route('friends', auth()->user())}}">Friends</a>
                </li>
              @endauth
            </ul>
            <div class="d-flex" style="gap: 77px">
                <form id="formSearch" action="{{ route('search') }}" method="GET" class="d-flex invisible" role="search">
                    <select id="genderSelect" name="gender" class="form-select form-select-sm mx-2" aria-label=".form-select-sm example" style="width: fit-content">
                      <option value="" selected disabled>Filter by genders</option>
                      <option value="">None</option>
                      <option value="1" @if(isset($gender_filter) && $gender_filter == 1) selected @endif>Male</option>
                      <option value="2" @if(isset($gender_filter) && $gender_filter == 2) selected @endif>Female</option>
                    </select>
                    <input id="queryInput" class="form-control me-2" style="min-width: 320px" name="search-keyword" type="search" placeholder="Search by name, nickname, or hobbies..." aria-label="Search" value="{{$keyword ?? ''}}">
                    <button class="btn btn-outline-dark text-light" type="submit">Search</button>
                </form>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Settings
                    </a>
                    
                    <ul class="dropdown-menu" style="position: absolute;left: -67%" aria-labelledby="navbarDropdown">
                      @auth
                        <li class="d-flex align-items-center">
                          <span>
                            @if(auth()->user()->gender_id == 1)
                              <i class="fa-solid fa-mars mx-3 fa-2x" style="color: #7834fc"></i>
                            @elseif(auth()->user()->gender_id == 2)
                              <i class="fa-solid fa-venus mx-3 fa-2x" style="color: #FA2FB5"></i>
                            @endif
                          </span>
                          <div>
                              <h5 class="mb-0">{{ auth()->user()->name }} </h6>
                              <p class="mb-0 fs-6">{{ auth()->user()->nickname }}</p>
                          </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                          <h6 class="px-2">Balance :</h6>
                          <i class="fa-solid fa-coins mx-2" style="color: gold"></i>
                          {{number_format(auth()->user()->balance)}}
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li class="px-2"><h6>Settings</h6></li>
                        <li><a class="dropdown-item" href="{{route('topup')}}">Top Up</a></li>
                        <li><a class="dropdown-item" href="{{route('collection', auth()->user())}}">Set Avatar</a></li>
                        <li>
                          @if(auth()->user()->visible_status_id == 1)
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#set_account_modal">Set to Private</a>
                          @elseif(auth()->user()->visible_status_id == 2)
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#set_account_modal">Set to Public</a>
                          @endif
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <form action="{{route('logout')}}" method="POST">
                          @csrf
                          <li><button type="submit" class="dropdown-item text-danger" style="background: none" >Log Out</button>
                        </form>
                      @else
                        <li><a class="dropdown-item disabled text-dark" href="#">Guest</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>
                        <li><a class="dropdown-item" href="{{route('register')}}">Register</a></li>
                      @endauth
                    </ul>
                  </li>
                </ul>
            </div>
          </div>
        </div>
      </nav>
</header>
@auth
<div class="modal" tabindex="-1" id="set_account_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      @if(auth()->user()->visible_status_id == 1)
        <div class="modal-header">
          <h5 class="modal-title">Set to Private Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure want to hide your photos? It will cost 50 coins</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <form action="{{ route('set-account', auth()->user()) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Yes</button>
          </form>
        </div>
      @elseif(auth()->user()->visible_status_id == 2)
        <div class="modal-header">
          <h5 class="modal-title">Set to Public Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure want back to public account? It will cost 5 coins</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <form action="{{ route('set-account', auth()->user()) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Yes</button>
          </form>
        </div>
      @endif
    </div>
  </div>
</div>
@endauth