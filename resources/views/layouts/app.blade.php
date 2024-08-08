<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cathering App</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  </head>
  <style>
    .active {
        background-color: slategray;
        color: white !important;
        border-radius: 15px;
    }
  </style>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-secondary">
        <div class="container">
            @if(@auth()->user()->role == 'merchant' && @auth()->user()->merchant)
                <a class="navbar-brand" href="#"><i><strong class="text-success">{{ auth()->user()->merchant->company_name }}</strong></i></a>
            @else
                <a class="navbar-brand" href="#"><i>Marketplace</i> <strong class="text-success">Catering</strong></a>
            @endif

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @if(@auth()->user())
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            @if(@auth()->user()->role === 'merchant' && @auth()->user()->merchant)
                                <a class="nav-link {{ Route::is('merchant.menu.*') ? 'active' : '' }}" href="{{ route('merchant.menu.index') }}">Menu</a>
                            @else
                                <a class="nav-link {{ Route::is('customer.menu.*') ? 'active' : '' }}" href="{{ route('customer.menu.index') }}">Menu</a>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Order</a>
                        </li>
                    </ul>
                @endif

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        @if(auth()->user())
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                </button>
                                <ul class="dropdown-menu">
                                    @if(@auth()->user()->role == 'merchant' && @auth()->user()->merchant)
                                        <li><a class="dropdown-item" href="{{ route('merchant.profile.index') }}">Profile</a></li>
                                    @else
                                        <li><a class="dropdown-item" href="{{ route('customer.profile.index') }}">Profile</a></li>
                                    @endif
                                    <li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                            <a class="btn btn-secondary ms-2" href="{{ route('register') }}">Register</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    @stack('script')
  </body>
</html>
