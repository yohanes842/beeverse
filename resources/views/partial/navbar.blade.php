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
                <a id="navbar-home" class="nav-link text" aria-current="page" href="{{route('home')}}">@lang('navbar.home')</a>
              </li>
              @auth
                <li class="nav-item">
                  <a id="navbar-shop" class="nav-link" href="{{route('shop')}}">@lang('navbar.shop')</a>
                </li>
                <li class="nav-item">
                  <a id="navbar-collectors" class="nav-link" href="{{route('collection', auth()->user())}}">@lang('navbar.collection')</a>
                </li>
                <li class="nav-item">
                  <a id="navbar-friends" class="nav-link" href="{{route('friends', auth()->user())}}">@lang('navbar.friends')</a>
                </li>
              @endauth
            </ul>
            <div class="d-flex" style="gap: 77px">
                <form id="formSearch" action="{{ route('search') }}" method="GET" class="d-flex invisible" role="search">
                    <select id="genderSelect" name="gender" class="form-select form-select-sm mx-2" aria-label=".form-select-sm example" style="width: fit-content">
                      <option value="" selected disabled>@lang('navbar.filter_gender')</option>
                      <option value="">@lang('general.none')</option>
                      <option value="1" @if(isset($gender_filter) && $gender_filter == 1) selected @endif>@lang('general.male')</option>
                      <option value="2" @if(isset($gender_filter) && $gender_filter == 2) selected @endif>@lang('general.female')</option>
                    </select>
                    <input id="queryInput" class="form-control me-2" style="min-width: 320px" name="search-keyword" type="search" placeholder="@lang('navbar.search.placeholder')" aria-label="Search" value="{{$keyword ?? ''}}">
                    <button class="btn btn-outline-dark text-light" type="submit">@lang('navbar.search.search')</button>
                </form>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                      @lang('navbar.setting')
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
                          <h6 class="px-2">@lang('general.balance') :</h6>
                          <i class="fa-solid fa-coins mx-2" style="color: gold"></i>
                          {{number_format(auth()->user()->balance)}}
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li class="px-2"><h6>@lang('navbar.setting')</h6></li>
                        <li><a class="dropdown-item" href="{{route('topup')}}">@lang('navbar.topup')</a></li>
                        <li><a class="dropdown-item" href="{{route('collection', auth()->user())}}">@lang('navbar.set_avatar')</a></li>
                        <li>
                          @if(auth()->user()->visible_status_id == 1)
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#set_account_modal">@lang('navbar.set_private')</a>
                          @elseif(auth()->user()->visible_status_id == 2)
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#set_account_modal">@lang('navbar.set_public')</a>
                          @endif
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <form action="{{route('logout')}}" method="POST">
                          @csrf
                          <li><button type="submit" class="dropdown-item text-danger" style="background: none" >@lang('navbar.logout')</button>
                        </form>
                      @else
                        <li><a class="dropdown-item disabled text-dark" href="#">@lang('navbar.guest')</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('login')}}">@lang('general.login')</a></li>
                        <li><a class="dropdown-item" href="{{route('register')}}">@lang('general.register')</a></li>
                      @endauth
                    </ul>
                  </li>
                </ul>
            </div>
          </div>
        </div>
      </nav>
      <div class="position-fixed btn-group end-0 mx-2" style="">
        <form action="{{route('lang', 'en')}}" method="POST">
          @csrf
          <button type="submit" class="rounded-start" style="border: #7834fc solid 1px; background: white; @if(!session()->has('applocale') || session('applocale') == 'en') background: #7834fc; color: white @endif">EN</button>
        </form>
        <form action="{{route('lang', 'in')}}" method="POST">
          @csrf
          <button type="submit" class="rounded-end" style="border: #7834fc solid 1px; background: white; @if(session()->has('applocale') && session('applocale') == 'in') background: #7834fc; color: white @endif">IN</button>
        </form>
      </div>
</header>
@auth
<div class="modal" tabindex="-1" id="set_account_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      @if(auth()->user()->visible_status_id == 1)
        <div class="modal-header">
          <h5 class="modal-title">@lang('navbar.set_private')</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>@lang('navbar.msg_private')</p>
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
          <h5 class="modal-title">@lang('navbar.set_public')</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>@lang('navbar.msg_public')</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('general.no')</button>
          <form action="{{ route('set-account', auth()->user()) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">@lang('general.yes')</button>
          </form>
        </div>
      @endif
    </div>
  </div>
</div>
@endauth