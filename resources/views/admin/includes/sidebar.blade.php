<aside
    class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <!-- Logo -->

            <a class="navbar-brand" href="{{route('dashboard')}}" aria-label="Front">
{{--                <img class="navbar-brand-logo" src="{{getAsset('img/logo.png')}}" alt="Logo" data-hs-theme-appearance="default" style="height: 50px; width: auto">--}}
{{--                <img class="navbar-brand-logo-mini" src="{{getAsset('img/logo.png')}}" alt="Logo" data-hs-theme-appearance="default" style="height: 50px; width: auto">--}}

                <h3 class="text-secondary fw-bolder">{{ env('APP_NAME') }}</h3>
            </a>

            <!-- End Logo -->

            <!-- Navbar Vertical Toggle -->
            {{--<button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
            </button>--}}

            <!-- End Navbar Vertical Toggle -->

            <div class="navbar-vertical-content">
                <!-- Content -->
                @if (!empty(ACTION_LIST))
                    <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
                        <!-- item group o -->
                        @foreach (ACTION_LIST as $g => $group)
                            @if(!empty($group['title']))
                                <!-- separator title -->
                                <span class="dropdown-header mt-4">{{$group['title']}}</span>
                                <!-- separator title end -->
                            @endif
                            <small class="bi-three-dots nav-subtitle-replacer"></small>
                            <!-- Collapse -->
                            <div class="navbar-nav nav-compact"></div>
                            <div id="navbarVerticalMenuPagesMenu">
                                <!-- Collapse -->
                                @if(!empty($group['collapsed']))
                                    @foreach ($group['collapsed'] as $c => $collapsed)
                                        @if(!empty($collapsed['routeName']))
                                            @if(!empty($collapsed['accessRole']) && !in_array($userRoleStatus, $collapsed['accessRole'])) @continue @endif
                                            <!-- main item -->
                                            <div class="nav-item">
                                                <a class="nav-link {{isActiveItem($collapsed['activeRoute'])}}" href="{{route($collapsed['routeName'], !empty($collapsed['params']) ? $collapsed['params'] : [])}}" data-placement="left">
                                                    @if(!empty($collapsed['icon']))
                                                        <i class="{{$collapsed['icon']}} nav-icon"></i>
                                                    @endif
                                                    <span class="nav-link-title">{{$collapsed['label']}}</span>
                                                </a>
                                            </div>
                                            <!-- main item end -->
                                        @else
                                        @if(!empty($collapsed['accessRole']) && !in_array($userRoleStatus, $collapsed['accessRole'])) @continue @endif

                                            <!-- main item dropdown o -->
                                            <div class="nav-item">
                                                <a class="nav-link dropdown-toggle {{isActiveItem($collapsed['activeRoute'])}}" href="#aria_{{$c}}" role="button"
                                                   data-bs-toggle="collapse" data-bs-target="#aria_{{$c}}"
                                                   aria-expanded="{{isAreaExpanded($collapsed['activeRoute'])}}" aria-controls="aria_{{$c}}">
                                                    @if(!empty($collapsed['icon']))
                                                        <i class="{{$collapsed['icon']}} nav-icon"></i>
                                                    @endif
                                                    <span class="nav-link-title">{{$collapsed['label']}}</span>
                                                </a>

                                                @if(!empty($collapsed['item']))
{{--                                                    {{dd(array_column($collapsed['item'], 'routeName'))}}--}}
                                                    <div id="aria_{{$c}}" class="nav-collapse collapse {{isActiveCollapse(array_column($collapsed['item'], 'routeName'))}}"
                                                         data-bs-parent="#navbarVerticalMenuPagesMenu">
                                                        @foreach ($collapsed['item'] as $i => $item)
                                                        @if(!empty($item['accessRole']) && !in_array($userRoleStatus, $item['accessRole'])) @continue @endif
                                                        <a class="nav-link {{isActiveItem($item['activeRoute'])}}" href="{{route($item['routeName'], !empty($item['params']) ? $item['params'] : [])}}">
                                                            {{$item['label']}}
{{--                                                            <span class="badge bg-info rounded-pill ms-1">Hot</span>--}}
                                                        </a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                            <!-- main item dropdown o end -->
                                        @endif
                                    @endforeach
                                @endif

                            </div>
                        @endforeach
                        <!-- item group o end -->
                    </div>
                @endif
                <!-- End Content -->

                <!-- Footer -->
{{--                <div class="navbar-vertical-footer">--}}
{{--                    <ul class="navbar-vertical-footer-list">--}}
{{--                        <li class="navbar-vertical-footer-list-item">--}}
{{--                            <!-- Style Switcher -->--}}
{{--                            <div class="dropdown dropup">--}}
{{--                                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle"--}}
{{--                                        id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false"--}}
{{--                                        data-bs-dropdown-animation>--}}

{{--                                </button>--}}

{{--                                <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless"--}}
{{--                                     aria-labelledby="selectThemeDropdown">--}}
{{--                                    <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">--}}
{{--                                        <i class="bi-moon-stars me-2"></i>--}}
{{--                                        <span class="text-truncate"--}}
{{--                                              title="Auto (system default)">Auto (system default)</span>--}}
{{--                                    </a>--}}
{{--                                    <a class="dropdown-item" href="#" data-icon="bi-brightness-high"--}}
{{--                                       data-value="default">--}}
{{--                                        <i class="bi-brightness-high me-2"></i>--}}
{{--                                        <span class="text-truncate"--}}
{{--                                              title="Default (light mode)">Default (light mode)</span>--}}
{{--                                    </a>--}}
{{--                                    <a class="dropdown-item active" href="#" data-icon="bi-moon" data-value="dark">--}}
{{--                                        <i class="bi-moon me-2"></i>--}}
{{--                                        <span class="text-truncate" title="Dark">Dark</span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!-- End Style Switcher -->--}}
{{--                        </li>--}}


{{--                    </ul>--}}
{{--                </div>--}}
                <!-- End Footer -->
            </div>
        </div>
</aside>
