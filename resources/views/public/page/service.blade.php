<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }} - Catégorie</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <meta name="commande-passer-url" content="{{ route('commande.passer') }}">
        <link rel="stylesheet" href="{{ asset('css/public/bootstrap-reboot.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/bootstrap-grid.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/bootstrap-utilities.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/jumbo.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/pagner.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/service.css') }}">
    </head>
    <body>

        <header class="header">
                <div class="container">
                    <div class="header_container">
                        <div class="hamburger">&#9776;</div>
                        <div class="header_logo">
                            <img src="{{ asset('image/logo/biblioshop_logo5.png') }}" alt="BiblioShop Logo">
                        </div>
                        <div class="header_search">
                            <input type="text" placeholder="Search..." id="search">
                            <i class='bx bxs-search' id="search-icon"></i>
                        </div>
        
                        <div class=" header_menu">
                            <div class="ul-nav">
                                <li>
                                    <a href="{{ route('public_page') }}">Accueil</a>
                                </li>
                                <li>
                                    <a href="{{ route('public_page.livre') }}">Livres</a>
                                </li>
                                <li>
                                    <a href="{{ route('public_page.services') }}">Services</a>
                                </li>
                                <li>
                                    <a href="#">Contact</a>
                                </li>
                            </div>
                            <div class="header_icons">
                                <a href="{{ route('commandes.index') }}">
                                    <i class='bx bxs-receipt'></i>
                                </a>
                                <a href="#" id="show-cart">
                                    <i class='bx bxs-cart'></i>
                                    <span id="cart-count">0</span>
                                </a>
                            </div>
                            @if (Route::has('login'))
                            <div class="login">
                                <ul class="login-nav">
                                    @auth
                                    <li class="dropdown">
                                        <!-- Toggle Button -->
                                        <a href="#" class="dropdown-toggle" onclick="toggleDropdown(event)">
                                            <i class='bx bxs-user'></i>
                                            <span class="text">{{ Auth::user()->name }}</span>
                                        </a>
                                    
                                        <!-- Dropdown Menu -->
                                        <ul class="dropdown-menu hidden">
                                            <li>
                                                <a href="{{ route('profile.edit') }}">
                                                    <i class='bx bxs-cog'></i>
                                                    <span class="text">Profile</span>
                                                </a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit" class="logout">
                                                        <i class='bx bxs-log-out-circle'></i>
                                                        <span class="text">Log Out</span>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                    @else
                                        <li>
                                            <a href="{{ route('login') }}" class="">Login</a>
                                        </li>
                                        @if (Route::has('register'))
                                            <li>
                                                <a href="{{ route('register') }}" class="">Register</a>
                                            </li>
                                        @endif
                                    @endauth
                                </ul>
                            </div>
                            @endif
                        </div>
        
                    </div>
                </div>
        </header>

        <main class="main">

            <section class="jumbo">
                <div class="container">
                    <div class="jumbo_container">
                        <div class="jumbo_content">
                            <div class="jumbo_title">
                                <h1>BiblioShop - Livres et plus</h1>
                                    <p class="jumbo_title_p">
                                        Nos services vous permettent de trouver des livres, des articles et des produits de qualité. Nous sommes là
                                    </p>
                                </div>
                                <div class="jumbo_reseau">
                                    <a href="#" class="social-icon"><i class="bx bxl-facebook"></i></a>
                                    <a href="#" class="social-icon"><i class="bx bxl-twitter"></i></a>
                                    <a href="#" class="social-icon"><i class="bx bxl-instagram"></i></a>
                                    <a href="#" class="social-icon"><i class="bx bxl-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="jumbo_image">
                                <img  src="{{ asset('image/ls/lbr2.png') }}" alt="BiblioShop Logo">
                            </div>
                        </div>
                    </div>
            </section>

            <section class="services-section">
                <div class="container">
                    <div class="services-title">
                        <h1>Nos Services</h1>
                        <p>Découvrez tout ce que BiblioShop peut vous offrir</p>
                    </div>
            
                    <div class="services-list">
                        <div class="service-card">
                            <i class="bx bx-book-heart service-icon"></i>
                            <h3>Vente de Livres</h3>
                            <p>Des milliers de titres disponibles : romans, science, littérature, mangas et plus.</p>
                        </div>
            
                        <div class="service-card">
                            <i class="bx bx-user service-icon"></i>
                            <h3>Livraison rapide</h3>
                            <p>Recevez vos commandes en 48h partout au Sénégal.</p>
                        </div>
            
                        <div class="service-card">
                            <i class="bx bx-user-voice service-icon"></i>
                            <h3>Support client</h3>
                            <p>Une assistance rapide pour toutes vos questions et demandes.</p>
                        </div>
            
                        <div class="service-card">
                            <i class="bx bx-star service-icon"></i>
                            <h3>Recommandation personnalisées</h3>
                            <p>Basées sur vos lectures précédentes et préférences.</p>
                        </div>
                    </div>
                </div>
            </section>
            
        </main>

        <div id="cart-container" class="">
            <button id="close-cart">Fermer</button>
            <h3>Votre panier</h3>
            <ul id="cart-list"></ul>
            <div id="cart-total"></div>
            <button id="commander-btn">Commander</button>
        </div>

        <footer class="footer">
            <div class="container">
                <div class="footer_content">
                    <div class="footer_logo">
                        <img src="{{ asset('image/logo/biblioshop_logo5.png') }}" alt="BiblioShop Logo">
                        <p>BiblioShop - La passion de la lecture, à portée de clic.</p>
                    </div>
        
                    <div class="footer_links">
                        <h4>Navigation</h4>
                        <ul>
                            <li><a href="#">Accueil</a></li>
                            <li><a href="#">Livres</a></li>
                            <li><a href="#">Catégories</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>
        
                    <div class="footer_contact">
                        <h4>Contact</h4>
                        <ul>
                            <li><i class='bx bx-map'></i> Apix-Keur Massar, Dakar, Sénégal</li>
                            <li><i class='bx bx-envelope'></i> support@biblioshop.com</li>
                            <li><i class='bx bx-phone'></i> +221 77 123 45 67</li>
                        </ul>
                    </div>
        
                    <div class="footer_social">
                        <h4>Suivez-nous</h4>
                        <div class="social-icons">
                            <a href="#"><i class="bx bxl-facebook"></i></a>
                            <a href="#"><i class="bx bxl-twitter"></i></a>
                            <a href="#"><i class="bx bxl-instagram"></i></a>
                            <a href="#"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>
        
                <div class="footer_bottom">
                    <p>&copy; {{ date('Y') }} BiblioShop. Tous droits réservés.</p>
                </div>
            </div>
        </footer>
    
    <script src="{{ asset('js/ls/jumbo.js') }}"></script>
    <script src="{{ asset('js/ls/section.js') }}"></script>
</body>
</html>
