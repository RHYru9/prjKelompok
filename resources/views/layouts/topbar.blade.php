<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('build/images/logo.svg') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="17">
                    </span>
                </a>

                <a href="index" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('build/images/logo-light.svg') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="19">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="@lang('translation.Search')">
                    <span class="bx bx-search-alt"></span>
                </div>
            </form>
        </div>

        <div class="d-flex">
            <!-- Language Dropdown -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @switch(Session::get('lang'))
                        @case('id')
                            <img src="{{ URL::asset('build/images/flags/indonesia.png')}}" alt="Header Language" height="16">
                        @break
                        @default
                            <img src="{{ URL::asset('build/images/flags/us.jpg')}}" alt="Header Language" height="16">
                    @endswitch
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="{{ url('index/en') }}" class="dropdown-item notify-item language" data-lang="eng">
                        <img src="{{ URL::asset ('build/images/flags/us.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                    </a>
                    <a href="{{ url('index/id') }}" class="dropdown-item notify-item language" data-lang="id">
                        <img src="{{ URL::asset ('build/images/flags/indonesia.png') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Indonesia</span>
                    </a>
                </div>
            </div>
            <!-- Profile -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{ ucfirst(Auth::user()->name) }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="profile"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span>@lang('translation.Profile')</span></a>
                    <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle me-1"></i> <span>@lang('translation.My_Wallet')</span></a>
                    <a class="dropdown-item d-block" href="#"><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span>@lang('translation.Settings')</span></a>
                    <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span>@lang('translation.Lock_screen')</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span>@lang('translation.Logout')</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            <!-- Settings -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="bx bx-cog bx-spin"></i>
                </button>
            </div>
        </div>
    </div>
</header>
