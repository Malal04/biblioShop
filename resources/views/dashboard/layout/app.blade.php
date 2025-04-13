<!-- resources/views/dashboard/layout/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/dashboard/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/categorie.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/content.css') }}">
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="{{ route('admin_dashboard') }}" class="brand">
            <i class="bx bxs-book"></i>
            <span class="text">BiblioShop</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="{{ route('admin_dashboard') }}">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.categorie.cIndex') }}">
                    <i class="bx bxs-folder-open"></i>
                    <span class="text">Catégories</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.categorie.cCreate') }}">
                    <i class="bx bxs-folder-open"></i>
                    <span class="text">Ajouter une catégorie</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.livre.lIndex') }}">
                    <i class="bx bxs-book"></i>
                    <span class="text">Livres</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.livre.lCreate') }}">
                    <i class="bx bxs-book"></i> </i>
                    <span class="text">Ajouter un livre</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.user.uIndex') }}">
                    <i class="bx bxs-user"></i>
                    <span class="text">Utilisateurs</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.user.uCreate') }}">
                    <i class="bx bxs-user"></i>
                    <span class="text">Ajouter un utilisateur</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="{{ route('profile.edit') }}">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Profile</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="logout">
                        <i class='bx bxs-log-out-circle'></i>
                        <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </a>
                </form>
            </li>

        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
            
            <form action="{{ route('dashboard.livre.lSearch') }}" method="GET">
                <div class="form-input">
                    <input type="search" name="search" placeholder="Recherche de livre..." required>
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                {{-- <span class="num">8</span> --}}
            </a>
            <a href="#" class="profile">
                <img src="{{ asset('image/logo/biblioshop_logo5.png') }}">
            </a>
        </nav>

        <main>
            @yield('dashboards')
        </main>
        
    </section>
    <!-- CONTENT -->

    <script src="{{ asset('js/dashboard/dashboard.js') }}"></script>
</body>
</html>
