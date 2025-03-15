<!--- Sidemenu -->
<ul class="side-nav">

    <li class="side-nav-title side-nav-item">Navigation</li>
    @php
        // Fetch the user type of the authenticated user
        $userType = auth()->user()->user_type;

        // Initialize roleRoutes variable
        $roleRoutes = [];

        // If user_type is not 1, fetch the role IDs and route names
        if ($userType !== 1) {
            $roleIds = DB::table('user_role')->where('user_id', auth()->user()->id)->pluck('role_id')->toArray();
            $roleRoutes = DB::table('role_routes')->whereIn('role_id', $roleIds)->pluck('route_name')->toArray();
        }
    @endphp
    <li class="side-nav-item">
        <a href="{{route('dashboard')}}" class="side-nav-link">
            <i class="uil-home-alt"></i>
            <span> Dashboards </span>
        </a>
    </li>

    @if ($userType === 1 || !empty(array_filter(['role.add', 'role.manage', 'user.add', 'user.manage'], fn($route) => in_array($route, $roleRoutes))))
    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false"
           aria-controls="sidebarEcommerce" class="side-nav-link">
            <i class="uil-users-alt"></i>
            <span> User Module </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarEcommerce">
            <ul class="side-nav-second-level">
                @if ($userType === 1 || in_array('role.add', $roleRoutes))
                    <li>
                        <a href="{{ route('role.add') }}">Add Role</a>
                    </li>
                @endif
                @if ($userType === 1 || in_array('role.manage', $roleRoutes))
                    <li>
                        <a href="{{ route('role.manage') }}">Manage Role</a>
                    </li>
                @endif
                @if ($userType === 1 || in_array('user.add', $roleRoutes))
                    <li>
                        <a href="{{ route('user.add') }}">Add User</a>
                    </li>
                @endif
                @if ($userType === 1 || in_array('user.manage', $roleRoutes))
                    <li>
                        <a href="{{ route('user.manage') }}">Manage User</a>
                    </li>
                @endif
            </ul>
        </div>
    </li>
    @endif
    @if ($userType === 1 || !empty(array_filter(['slider.add', 'slider.manage'], fn($route) => in_array($route, $roleRoutes))))
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarSlider" aria-expanded="false" aria-controls="sidebarSlider" class="side-nav-link">
                <i class="uil-sliders-v"></i>
                <span> Slider </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarSlider">
                <ul class="side-nav-second-level">
                    @if ($userType === 1 || in_array('slider.add', $roleRoutes))
                        <li>
                            <a href="{{ route('slider.add') }}">Add Slider</a>
                        </li>
                    @endif
                    @if ($userType === 1 || in_array('slider.manage', $roleRoutes))
                        <li>
                            <a href="{{ route('slider.manage') }}">Manage Slider</a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
    @if ($userType === 1 || in_array('dashboard.customer', $roleRoutes))
    <li class="side-nav-item">
        <a href="{{route('dashboard.customer')}}" class="side-nav-link">
            <i class="uil-users-alt"></i>
            <span> Customers </span>
        </a>
    </li>
    @endif
    @if ($userType === 1 || in_array('dashboard.contact-form', $roleRoutes))
    <li class="side-nav-item">
        <a href="{{route('dashboard.contact-form')}}" class="side-nav-link">
            <i class="uil-question-circle"></i>
            <span> Customer Queries </span>
        </a>
    </li>
    @endif
    @if ($userType === 1 || !empty(array_filter(['privacy.add', 'return.manage'], fn($route) => in_array($route, $roleRoutes))))
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarPrivacy" aria-expanded="false" aria-controls="sidebarPrivacy" class="side-nav-link">
                <i class="uil-lock"></i>
                <span> Privacy & Policy </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarPrivacy">
                <ul class="side-nav-second-level">
                    @if ($userType === 1 || in_array('privacy.add', $roleRoutes))
                        <li>
                            <a href="{{ route('privacy.add') }}">Manage Privacy</a>
                        </li>
                    @endif
                    @if ($userType === 1 || in_array('return.add', $roleRoutes))
                        <li>
                            <a href="{{ route('return.add') }}">Manage Return</a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
    @if ($userType === 1 || !empty(array_filter(['google-analytic.add','about-us.add','setting.add','setting.smtp','shipping-cost.manage'], fn($route) => in_array($route, $roleRoutes))))
    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarSetup" aria-expanded="false" aria-controls="sidebarSetup"
           class="side-nav-link">
            <i class="uil-wrench"></i>
            <span> Setup & Configarations </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarSetup">
            <ul class="side-nav-second-level">
                @if ($userType === 1 || in_array('google-analytic.add', $roleRoutes))
                <li>
                    <a href="{{route('google-analytic.add')}}">Google Analytics</a>
                </li>
                @endif
                    @if ($userType === 1 || in_array('about-us.add', $roleRoutes))
                <li>
                    <a href="{{route('about-us.add')}}">About us</a>
                </li>
                    @endif
                    @if ($userType === 1 || in_array('setting.add', $roleRoutes))
                <li>
                    <a href="{{route('setting.add')}}">General Settings</a>
                </li>
                    @endif
                    @if ($userType === 1 || in_array('setting.smtp', $roleRoutes))
                <li>
                    <a href="{{route('setting.smtp')}}">SMTP Settings</a>
                </li>
                    @endif
            </ul>
        </div>
    </li>
    @endif
</ul>
