<header class="navbar navbar-header navbar-header-fixed bg-amber-50  shadow-md">
    <a href="" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
    <div class="navbar-brand">
        <a href="{{ route('admin.dashboard') }}" class="df-logo">order<span>panel</span></a>
    </div><!-- navbar-brand -->
    <div id="navbarMenu" class="navbar-menu-wrapper">
        <div class="navbar-menu-header">
            <a href="{{ route('admin.dashboard') }}" class="df-logo">order<span>panel</span></a>
            <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
        </div><!-- navbar-menu-header -->
        <ul class="nav navbar-menu">
            <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">Main Navigation</li>
            <x-menu.menu-item :active="request()->routeIs('admin.dashboard')">
                <x-menu.menu-link href="{{ route('admin.dashboard') }}">
                    <x-element.icon.home></x-element.icon.home> Home
                </x-menu.menu-link>
            </x-menu.menu-item>
            <x-menu.menu-item :active="request()->routeIs('admin.category.index')">
                <x-menu.menu-link href="{{ route('admin.category.index') }}">
                    <x-element.icon.list></x-element.icon.list> Category
                </x-menu.menu-link>
            </x-menu.menu-item>
            <x-menu.menu-item :active="request()->routeIs('admin.user.index')">
                <x-menu.menu-link href="{{ route('admin.user.index') }}">
                    <x-element.icon.user></x-element.icon.user> User
                </x-menu.menu-link>
            </x-menu.menu-item>
            <x-menu.menu-item :active="request()->routeIs('admin.dealer.index')">
                <x-menu.menu-link href="{{ route('admin.dealer.index') }}">
                    <x-element.icon.users></x-element.icon.users> Dealer
                </x-menu.menu-link>
            </x-menu.menu-item>
            <x-menu.menu-item :active="request()->routeIs('admin.setting.edit')">
                <x-menu.menu-link href="{{ route('admin.setting.edit') }}">
                    <x-element.icon.setting></x-element.icon.setting> Setting
                </x-menu.menu-link>
            </x-menu.menu-item>
        </ul>
    </div><!-- navbar-menu-wrapper -->
    <div class="navbar-right">
        <div class="dropdown dropdown-profile">
            <a href="" class="dropdown-link" data-toggle="dropdown" data-display="static">
                <div class="avatar avatar-sm"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
            </a><!-- dropdown-link -->
            <div class="dropdown-menu dropdown-menu-right tx-13">
                <div class="avatar avatar-lg mg-b-15"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
                <h6 class="tx-semibold mg-b-5">Katherine Pechon</h6>
                <p class="mg-b-25 tx-12 tx-color-03">Administrator</p>

                <a href="" class="dropdown-item"><i data-feather="edit-3"></i> Edit Profile</a>
                <a href="page-profile-view.html" class="dropdown-item"><i data-feather="user"></i> View
                    Profile</a>
                <div class="dropdown-divider"></div>
                <a href="page-help-center.html" class="dropdown-item"><i data-feather="help-circle"></i> Help
                    Center</a>
                <a href="" class="dropdown-item"><i data-feather="life-buoy"></i> Forum</a>
                <a href="" class="dropdown-item"><i data-feather="settings"></i>Account Settings</a>
                <a href="" class="dropdown-item"><i data-feather="settings"></i>Privacy Settings</a>
                <a href="javascript:void" onclick="$('#logout-form').submit();" class="dropdown-item"><i data-feather="log-out"></i>Sign Out</a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
    </div><!-- navbar-right -->
</header>
