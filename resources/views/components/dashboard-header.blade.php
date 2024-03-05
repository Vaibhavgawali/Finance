<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="/"><img src="/admin-assets/assets/images/logo.png" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="/"><img src="/admin-assets/assets/images/logomini.png" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img">
                        @if($user->profile && $user->profile->profile_image)
                        <img src="{{ asset('storage/images/') }}/{{$user->profile->profile_image}}" alt="{{$user->profile->profile_image}}" class="img-fluid">
                        <span class="availability-status online"></span>
                        @else
                        <img src="/admin-assets/assets/images/profile.jpg" alt="Placeholder Image" class="img-fluid">
                        <span class="availability-status online"></span>
                        @endif
                    </div>

                    <div class="nav-profile-text">
                        <p class="mb-1 text-black"> {{ Illuminate\Support\Str::limit(explode(' ', $user->namecc)[0], 9, '..') }}
                        </p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="/candidate/{{$user->user_id}}">
                        <i class="mdi mdi-cached me-2 text-success"></i>Profile </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/reset-password">
                        <i class="mdi mdi-lock-reset me-2 text-success"></i>Reset Password </a>
                    <div class="dropdown-divider"></div>
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item" type="submit"><i class="mdi mdi-logout me-2 text-primary"></i>Logout</button>
                    </form>
                </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                    <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>