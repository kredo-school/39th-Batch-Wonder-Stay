<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin')</title>

    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
    <body>
        <nav class="navbar navbar-dark bg-dark px-3">
            <a href="{{ route('admin.dashboard') }}" class="navbar-brand text-white text-decoration-none">
                Admin Panel
            </a>

            {{-- Admin dropdown --}}
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i>Admin
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="admin-layout">
            {{-- Leftside navbar --}}
            @if (!request()->routeIs('admin.dashboard'))
                <div class="admin-sidebar">
                    <p class="sidebar-titile">Admin List</p>

                    <a href="{{ route('admin.users.index') }}">Users</a>
                    <a href="#">Reservations</a>
                    <a href="{{ route('admin.paymentmethods.index') }}">Payment Method</a>
                    <a href="{{ route('admin.cities.index') }}">Region</a>
                    <a href="{{ route('admin.hotels.index') }}">Hotels</a>
                    <a href="{{ route('admin.accommodations.index') }}">Accommodations</a>
                </div>
            @endif
            <main class="container mt-4">
            @yield('content')
        </main>
        </div>
        
        

        

    </body>
</html>
