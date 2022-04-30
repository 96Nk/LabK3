@php($dataUser = auth()->user())
<header class="main-nav">
    <div class="sidebar-user text-center">
        @if($dataUser->level_id == 2)
            @if($dataUser->company->logo_file)
                <img class="img-90 rounded-circle" src="{{ asset('storage/'.$dataUser->company->logo_file) }}"
                     width="75px" height="75px"
                     alt="">
            @else
                <img class="img-90 rounded-circle" src="{{ asset('assets/images/logo-k3.png') }}" alt="">
            @endif
        @else
            <img class="img-90 rounded-circle" src="{{ asset('assets/images/logo-k3.png') }}" alt="">
        @endif
        <h6 class="f-w-600 mt-3">{{ Str::upper($dataUser->name) }}</h6>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span>
                            <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav active"
                           href="{{ route('home') }}">
                            <i class="bi bi-house"></i><span> Home</span>
                        </a>
                    </li>
                    @foreach($permissions as $i => $menuParent)
                        @if($menuParent['parent'] == '0' )
                            @if($menuParent['link'] != '#' )
                                <li class="dropdown">
                                    <a class="nav-link menu-title link-nav active"
                                       href="{{ $menuParent['link'] }}">
                                        <i class="{{$menuParent['icon']}}"></i><span> {{$menuParent['name']}}</span>
                                    </a>
                                </li>
                            @else
                                <li class="dropdown">
                                    <a class="nav-link menu-title" href="javascript:void(0)">
                                        <i class="{{$menuParent['icon']}}"></i> <span>{{$menuParent['name']}} </span>
                                    </a>
                                    <ul class="nav-submenu menu-content">
                                        @foreach($permissions as $i => $menuChild)
                                            @if($menuParent['menu_id'] == $menuChild['parent'])
                                                <li>
                                                    <a href="{{ $menuChild['link'] }}">
                                                        <i class="{{$menuChild['icon']}}"></i>
                                                        <span> {{ $menuChild['name'] }} </span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach

                                    </ul>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>

        </div>
    </nav>
</header>
