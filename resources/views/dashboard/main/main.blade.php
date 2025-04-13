@extends('dashboard.layout.app')

@section('dashboards')
    <div class="head-title">
        <div class="left">
            <h1>Dashboard</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('admin_dashboard') }}">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="{{ route('admin_dashboard') }}">Home</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Statistics Box -->
    <ul class="box-info">
        <li>
            <i class='bx bxs-book' ></i>
            <span class="text">
                <h3>{{ $totalLivres }}</h3>
                <p>Total Livres</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-category' ></i>
            <span class="text">
                <h3>{{ $totalCategories }}</h3>
                <p>Total Categories</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-user' ></i>
            <span class="text">
                <h3>{{ $totalUsers }}</h3>
                <p>Total Utilisateurs</p>
            </span>
        </li>
    </ul>

    <!-- Order Statistics -->
    <ul class="box-info">
        <li>
            <i class='bx bxs-cart' ></i>
            <span class="text">
                <h3>{{ $commandesEnCours }}</h3>
                <p>Commandes en cours aujourd'hui</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-check-circle' ></i>
            <span class="text">
                <h3>{{ $commandesValidees }}</h3>
                <p>Commandes validées aujourd'hui</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-dollar-circle' ></i>
            <span class="text">
                <h3>{{ number_format($recettesJournalières, 2) }} FCFA</h3>
                <p>Recettes journalières</p>
            </span>
        </li>
    </ul>

    <div class="table-data">

        <!-- Monthly Order Stats -->
        <div class="books">
            <h3>Commandes par mois</h3>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="table-row">
                        <th>Mois</th>
                        <th>Commandes</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach($commandesParMois as $commande)
                        <tr class="table-row">
                            <td>{{ \Carbon\Carbon::create()->month($commande->month)->format('F') }}</td>
                            <td>{{ $commande->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Monthly Recettes -->
        <div class="books">
            <h3>Recettes par mois</h3>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="table-row">
                        <th>Mois</th>
                        <th>Recettes</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach($recettesParMois as $recette)
                        <tr class="table-row">
                            <td>{{ \Carbon\Carbon::create()->month($recette->mois)->format('F') }}</td>
                            <td>{{ number_format($recette->total, 2) }} FCFA</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Recette -->
        <div class="books">
            <h3>Total Recette</h3>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="table-row">
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    <tr class="table-row">
                        <td>{{ number_format($recetteTotale, 2) }} FCFA</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- All Orders -->
        <div class="orders">
            <h3>Toutes les Commandes</h3>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>NClient</th>
                        <th>NLivre</th>
                        <th>Catégorie</th>
                        <th>Statut</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commandes as $commande)
                        @foreach($commande->details as $detail)
                            <tr>
                                <td>{{ $commande->user->name }}</td>
                                <td>{{ $detail->livre->titre }}</td>
                                <td>{{ $detail->livre->categorie->nom }}</td>
                                <td>{{ $commande->statut }}</td>
                                <td>{{ $commande->created_at->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Monthly Books Sold by Category -->
        <div class="books">
            <h3>Livres vendus par mois par catégorie</h3>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="table-row">
                        <th>Catégorie</th>
                        <th>Mois</th>
                        <th>Livres Vendus</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach($livresVendusParCategorieParMois as $data)
                        <tr class="table-row">
                            <td>{{ $data->category_name }}</td>
                            <td>{{ \Carbon\Carbon::create()->month($data->month)->format('F') }}</td>
                            <td>{{ $data->total_books_sold }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection
