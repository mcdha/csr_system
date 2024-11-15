<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile border-bottom">
            <a href="#" class="nav-link flex-column">
                <div class="nav-profile-image">
                    @php
                        $image_file = asset('images/users/user_default.jpeg');

                        if ($file_name = Auth::user()->image_file) {
                            $image_file = asset('storage/users/' . $file_name);
                        }
                    @endphp
                    <img src="{{ $image_file }}" alt="profile" />

                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex ml-0 mb-3 flex-column">
                    <span class="font-weight-semibold mb-1 mt-2 text-center">{{ Auth::user()->full_name }}</span>
                    <span class="text-secondary text-center text-small">{{ Auth::user()->role }}</span>
                </div>
            </a>
        </li>
        <li class="nav-item pt-3">
            <a class="nav-link d-block" href="/dashboard">
                <div class="d-flex justify-content-center">
                    <img class="sidebar-brand-logo" src="{{ asset('images/logo.png') }}" alt=""
                        width="100" />
                </div>
                <img class="sidebar-brand-logomini" src="{{ asset('images/logo.png') }}" alt=""
                    width="40" />
                <div class="small pt-1 text-center" style="font-size: 20px">AAP: CSR System</div>
            </a>
        </li>
        <li class="pt-2 pb-1">
            <span class="nav-item-head">Main</span>
        </li>
        <li class="nav-item @if (in_array(Route::currentRouteName(), ['dashboard.index', 'dashboard.filter'])) active @endif">
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <i class="mdi mdi-compass-outline menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                <span class="menu-title">UI Elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                    </li>
                </ul>
            </div>
        </li> --}}
        <li class="nav-item @if (in_array(Route::currentRouteName(), ['users.index', 'users.create', 'users.edit'])) active @endif">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="mdi mdi-contacts menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
        <li class="nav-item @if (in_array(Route::currentRouteName(), [
                'queries.index',
                'queries.show',
                'queries.create',
                'queries.edit',
                'queries.upload',
                'option-values.index',
                'queries.filter',
                'queries.importFailures'
            ])) active @endif">
            <a class="nav-link" href="{{ route('queries.index') }}">
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                <span class="menu-title">Queries</span>
            </a>
        </li>
        <li class="nav-item pt-3">
            {{-- <form method="POST" action="' . route('queries.destroy', ['query' => $row->id]) . '" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-primary bg-white mb-2 mb-md-0">Delete</button>
            </form> --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <a class="nav-link" href="/login" onclick="this.closest('form').submit();return false;">
                    <i class="mdi mdi-logout menu-icon"></i>
                    <span class="menu-title">Logout</span>
                </a>
            </form>
        </li>
    </ul>
</nav>
