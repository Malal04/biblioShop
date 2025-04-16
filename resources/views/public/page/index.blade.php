<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ config('app.name') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <meta name="commande-passer-url" content="{{ route('commande.passer') }}">
        <link rel="stylesheet" href="{{ asset('css/public/bootstrap-reboot.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/bootstrap-grid.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/bootstrap-utilities.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/jumbo.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/section.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/public/pagner.css') }}">
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
                    <form action="{{ route('public_page.livre.recherche') }}" method="GET" id="search">
                        <input type="text" name="q" placeholder="Rechercher un livre ou auteur..." required>
                        <button type="submit"><i class='bx bxs-search' id="search-icon"></i></button>
                    </form>
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
                                La meilleure plateforme pour acheter des livres
                            </p>
                        </div>
                        <div class="jumbo_text">
                            <p class="jumbo_text_p"> 
                                Explorez notre large sélection de livres, 
                                de la fiction captivante aux ouvrages académiques spécialisés. 
                                Trouvez votre prochaine lecture ou commandez des livres populaires en quelques clics, 
                                avec une livraison rapide directement à votre porte. 
                                Nous vous offrons une expérience de lecture enrichissante et simple, 
                                avec des recommandations personnalisées selon vos préférences.
                            </p>
                        </div>
                        <div class="jumbo_button">
                            <a href="{{ route('public_page.services') }}" class="btn">Services</a>
                        </div>
                        <div class="jumbo_reseau">
                            <a href="#" class="social-icon"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="social-icon"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="jumbo_image">
                        <img  src="{{ asset('image/ls/lbr4.png') }}" alt="BiblioShop Logo">
                    </div>
                </div>
            </div>
        </section>

        <section class="section_categories">
            <div class="container">
                <div class="section_categories_container">
                    <div class="section_categories_title">
                        <h2 class="section_categories_title_h2">
                            Categories
                        </h2>
                        <p class="section_categories_title_p">
                            Découvrez nos catégories de livres et trouvez votre prochaine lecture
                        </p>
                    </div>
                    <div class="section_categories_content">
                        @foreach($categories as $category)
                            <div class="section_categories_item">
                                <a href="{{ route('public_page.categorie.show', $category->id) }}" class="section_categories_item_a">
                                    <h5 class="section_categories_item_h5">
                                        {{ $category->nom }}
                                    </h5>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="section_livres">
            <div class="section_livres_container">
                <div class="section_livres_title">
                    <h2>Livres disponibles</h2>
                    <p>Découvrez nos livres et trouvez votre prochaine lecture</p>
                </div>
                <div class="section_livres_content">
                    @foreach($livres as $livre)
                        <div class="section_livres_item">
                            <a href="{{ route('public_page.livre.show', $livre->id) }}">
                                <div class="section_livres_item_image">
                                    <img src="{{ asset('storage/'.$livre->image) }}" alt="{{ $livre->titre }}">
                                </div>
                                <div class="section_livres_item_content">
                                    <h3> <strong> Titre : </strong> {{ $livre->titre }}</h3>
                                    <p class="auteur"><strong> Auteur : </strong> {{ $livre->auteur }}</p>
                                    <p class="prix"><strong> Prix : </strong> {{ number_format($livre->prix, 2) }} fcfa</p>
                                </div>
                            </a>
                            <div class="section_livres_item_stock">
                                {{-- <span class="stock-text">Quantite:</span> --}}
                                <input type="number" class="quantite-input" min="1" max="{{ $livre->stock }}" value="1">
                                <span class="stock-text">Stock: {{ $livre->stock }} {{ $livre->stock > 1 ? 'livres' : 'livre' }}</span>
                            </div>
                            <button class="section_livres_item_button" data-id="{{ $livre->id }}">Ajouter au panier</button>
                        </div>
                    @endforeach
                </div>
            </div>
        
            <div id="cart-container" class="">
                <button id="close-cart">Fermer</button>
                <h3>Votre panier</h3>
                <ul id="cart-list"></ul>
                <div id="cart-total"></div>
                <button id="commander-btn">Commander</button>
            </div>

        </section>

        <section class="section_livres_temoignage">
            <div class="container">
                <h2 class="section-title">Ce que nos clients disent</h2>
                <div class="testimonials-container">
                    <div class="testimonial">
                        <div class="testimonial-text">
                            <p>"Cette librairie en ligne est incroyable ! J'ai trouvé des livres que je ne trouvais nulle part ailleurs et la livraison a été rapide et fiable."</p>
                        </div>
                        <div class="testimonial-author">
                            <p class="author-name">Marie Louise Diatta</p>
                            <p class="author-role">Client fidèle</p>
                        </div>
                    </div>
        
                    <div class="testimonial">
                        <div class="testimonial-text">
                            <p>"Je recommande vivement BiblioShop ! Les recommandations sont parfaites et le service client est top. Un vrai plaisir de faire des achats ici."</p>
                        </div>
                        <div class="testimonial-author">
                            <p class="author-name">Malal Diallo</p>
                            <p class="author-role">Client satisfait</p>
                        </div>
                    </div>
        
                    <div class="testimonial">
                        <div class="testimonial-text">
                            <p>"Un site web facile à naviguer et une très large sélection de livres. Je reviendrai assurément pour mes prochaines commandes."</p>
                        </div>
                        <div class="testimonial-author">
                            <p class="author-name">Mamadou Diop</p>
                            <p class="author-role">Passionnée de lecture</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section_contact" id="contact">
            <div class="container">
                <h2 class="section-title">Contactez-nous</h2>
                <div class="contact-container">
                    <div class="contact-info">
                        <h3>Nous sommes là pour vous aider</h3>
                        <p>Si vous avez des questions, des préoccupations ou des demandes spéciales, n'hésitez pas à nous contacter.</p>
                        <ul>
                            <li>
                                <i class="bx bx-phone"></i>
                                <span>Téléphone : <a href="tel:+123456789">+221 77 123 45 67</a></span>
                            </li>
                            <li>
                                <i class="bx bx-envelope"></i>
                                <span>Email : <a href="mailto:support@biblioshop.com">support@biblioshop.com</a></span>
                            </li>
                            <li>
                                <i class="bx bx-map"></i>
                                <span>Adresse : Apix-Keur Massar, Dakar, Senegal</span>
                            </li>
                        </ul>
                    </div>
                    <div class="contact-form">
                        <h3>Envoyer un message</h3>
                        <form action="#" method="POST">
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input type="text" id="name" name="name" required placeholder="Votre nom">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required placeholder="Votre email">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" required placeholder="Votre message"></textarea>
                            </div>
                            <button type="submit" class="btn">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>

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
    
    <script src="{{ asset('js/ls/jumbo.js') }}">
    </script>
    <script src="{{ asset('js/ls/section.js') }}">
    </script>

</body>
</html>