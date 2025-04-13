<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="commande-passer-url" content="{{ route('commande.passer') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }} - Catégorie</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="{{ asset('css/public/bootstrap-reboot.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/bootstrap-grid.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/bootstrap-utilities.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/jumbo.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/pagner.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/detail.css') }}">
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
                                    <a href="#">Livres</a>
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
                                        Le détail du livre {{ $livre->titre }}
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

            <section class="detail-livre_section">
                <div class="container">
                    <div class="detail-livre_title">
                        <h2> Detail du livre {{ $livre->titre }}</h2>
                    </div>
                    <div class="section_livres_item">
                        <div class="image">
                            <img src="{{ asset('storage/' . $livre->image) }}" alt="{{ $livre->titre }}">
                        </div>
                        <div class="content">
                            <div class="title">
                               <strong>Titre:</strong> <h3>{{ $livre->titre }}</h3>
                            </div>
                            <div class="auteur">
                                <p><strong>Auteur:</strong> {{ $livre->auteur }}</p>
                            </div>
                            <div class="description">
                                <p><strong>Description:</strong> {{ $livre->description }}</p>
                            </div>
                            <div class="prix">
                                <p><strong>Prix:</strong> {{ number_format($livre->prix, 2) }} fcfa</p>
                            </div>
                            <div class="vues">
                                <p>
                                    <strong>Vues:</strong> {{ $livre->views }}
                                </p>
                            </div>
                            <div class="stock">
                                <p>
                                    <strong>Stock:</strong> {{ $livre->stock }} 
                                    {{ $livre->stock > 1 ? 'livres' : 'livre' }}
                                </p>
                                <p>
                                    <strong>Quantite:</strong> 
                                    <input type="number" class="quantite-input" min="1" max="{{ $livre->stock }}" value="1">
                                    {{ $livre->stock > 1 ? 'livres' : 'livre' }}
                                </p>
                            </div>
                            <div class="action">
                                <button class="section_livres_item_button" data-id="{{ $livre->id }}">Ajouter au panier</button>
                            </div>
                        </div>
                    </div>
                    <div class="livres-similaires">
                        <div class="livres-similaires_title">
                            <h3>Livres similaires</h3>
                            <p>
                                Découvrez des livres similaires {{ $livre->titre }}
                            </p>
                        </div>
                        <div class="row similaires">
                            @forelse ($livresSimilaires as $similar)
                                <div class="col-md-3 similaires_item">
                                    <div class="card similaires_item_card">
                                        <img src="{{ asset('storage/' . $similar->image) }}" class="card-img-top" alt="{{ $similar->titre }}">
                                        <div class="card-body similaires_item_card_body">
                                            <div class="card-title similaires_item_card_title">
                                                <h5> <strong> Titre : </strong> {{ $similar->titre }}</h5>
                                            </div>
                                            <div class="card-auteur similaires_item_card_auteur">
                                                <p><strong>Auteur:</strong> {{ $similar->auteur }}</p>
                                            </div>
                                            <div class="card-price similaires_item_card_price">
                                                <p class="card-text similaires_item_card_price_text">
                                                    <strong> Prix : </strong> {{ number_format($similar->prix, 2) }} fcfa
                                                </p>
                                            </div>
                                        </div>
                                        <div class="card-action similaires_item_card_action">
                                            <a href="{{ route('public_page.livre.show', $similar->id) }}" class="section_livres_item_button">
                                                Voir
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Aucun autre livre dans cette catégorie.</p>
                            @endforelse
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
