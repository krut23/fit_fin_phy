<header id="header"
        class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white">
    <div class="navbar-nav-wrap">
        <!-- Logo -->
        <a class="navbar-brand" href="/" aria-label="Front">
            {{--            <img class="navbar-brand-logo" src="{{getAsset('svg/logos/logo.svg')}}" alt="Logo"--}}
            {{--                 data-hs-theme-appearance="default">--}}
            {{--            <img class="navbar-brand-logo" src="{{getAsset('svg/logos-light/logo.svg')}}" alt="Logo"--}}
            {{--                 data-hs-theme-appearance="dark">--}}
            {{--            <img class="navbar-brand-logo-mini" src="{{getAsset('svg/logos/logo-short.svg')}}" alt="Logo"--}}
            {{--                 data-hs-theme-appearance="default">--}}
            {{--            <img class="navbar-brand-logo-mini" src="{{getAsset('svg/logos-light/logo-short.svg')}}" alt="Logo"--}}
            {{--                 data-hs-theme-appearance="dark">--}}
        </a>
        <!-- End Logo -->

        <div class="navbar-nav-wrap-content-start">
            <!-- Navbar Vertical Toggle -->
            <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                <i class="bi-arrow-bar-left navbar-toggler-short-align"
                   data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                   data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                <i class="bi-arrow-bar-right navbar-toggler-full-align"
                   data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                   data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
            </button>

            <!-- End Navbar Vertical Toggle -->
        </div>

        <div class="navbar-nav-wrap-content-end">
            <!-- Navbar -->
            <ul class="navbar-nav">
                @if(Session::get('switchBackProfileUserId') && Session::get('switchBackProfileUserId')  != Auth::user()->id)

                <a class="btn btn-ghost-secondary btn-sm" href="{{route('switch.account', ['school', Session::get('switchBackProfileUserId')])}}" >
                    Switch Profile <i class="bi-box-arrow-up-right ms-1"></i>
                  </a>
                @endif
                <!-- Account -->
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown"
                           data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"
                           data-bs-dropdown-animation>
                            <div class="avatar avatar-sm avatar-secondary avatar-circle">
                                @if(Auth::user()->is_admin)
                                    <img class="avatar-img" src="{{getAsset('img/profile/admin-profile.png')}}" alt="Image">
                                @else
                                    <span class="avatar-initials">{{ !empty(Auth::user()) ? substr(Auth::user()->name, 0, 1) : '' }}</span>
                                @endif
                                <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                            </div>
                        </a>

                        <div
                            class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account"
                            aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
                            <div class="dropdown-item-text">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm avatar-secondary avatar-circle">
                                        @if(Auth::user()->is_admin)
                                            <img class="avatar-img" src="{{getAsset('img/profile/admin-profile.png')}}" alt="Image">
                                        @else
                                            <span class="avatar-initials">{{ !empty(Auth::user()) ? substr(Auth::user()->name, 0, 1) : '' }}</span>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-0">{{ !empty(Auth::user()) ? Auth::user()->name : '' }}</h5>
                                        <p class="card-text text-body">{{ !empty(Auth::user()) ? Auth::user()->email : '' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{route('logout')}}">Sign out</a>
                        </div>
                    </div>
                </li>
                <!-- End Account -->
            </ul>
            <!-- End Navbar -->
        </div>
    </div>
</header>
