<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    @if($user->profile && $user->profile->profile_image)
                    <img src="{{ asset('storage/images/') }}/{{$user->profile->profile_image}}" alt="{{$user->profile->profile_image}}" class="img-fluid">
                    @else
                    <img src="/admin-assets/assets/images/profile.jpg" alt="Placeholder Image" class="img-fluid">
                    @endif
                </div>

                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">
                        {{ Illuminate\Support\Str::limit(explode(' ', $user->name)[0], 9, '..') }}
                    </span>
                    <span class="text-secondary text-small">{{$user->category}}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/dashboard">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        
        @if(Auth::user()->hasRole('Superadmin') )
        <li class="nav-item">
            <a class="nav-link" href="/admin">
                <span class="menu-title">Admin</span>
                <i class="mdi mdi-account-card-details menu-icon"></i>
            </a>
        </li>
        @endif

        @if(Auth::user()->hasRole('Superadmin') || Auth::user()->hasRole('Admin') || Auth::user()->can('view_distributor_list') )
        <li class="nav-item">
            <a class="nav-link" href="/distributor">
                <span class="menu-title">Distributor</span>
                <i class="mdi mdi-account-card-details menu-icon"></i>
            </a>
        </li>
        @endif

        @if(Auth::user()->hasRole('Superadmin') || Auth::user()->hasRole('Admin') || Auth::user()->can('view_retailer_list'))
        <li class="nav-item">
            <a class="nav-link" href="/retailer">
                <span class="menu-title">Retailer</span>
                <i class="mdi mdi-account-card-details menu-icon"></i>
            </a>
        </li>
        @endif

    </ul>
</nav>