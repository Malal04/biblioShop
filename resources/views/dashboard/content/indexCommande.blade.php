@extends('dashboard.layout.app')
@push('styles')
<style>
    
    .alert {
        padding: 12px 20px;
        margin: 15px 0;
        border-radius: 4px;
        font-weight: 600;
        color: #fff;
    }

    .alert.success {
        background-color: #4CAF50;
    }

    .alert.error {
        background-color: #f44336;
    }

    /* ---- TITRE & BREADCRUMB ---- */
    .head-title {
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .head-title .left h1 {
        font-size: 28px;
        font-weight: 700;
    }

    .breadcrumb {
        list-style: none;
        padding: 0;
        display: flex;
        gap: 10px;
        font-size: 14px;
    }

    .breadcrumb li a {
        text-decoration: none;
        color: #3498db;
    }

    .breadcrumb li::after {
        content: "/";
        margin-left: 10px;
        color: #aaa;
    }

    .breadcrumb li:last-child::after {
        content: "";
    }

    /* ---- TABLEAU ---- */
    .table-data {
        overflow-x: auto;
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
    }

    thead {
        background-color: #2c3e50;
        color: #ecf0f1;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tbody tr:hover {
        background-color: #f1f1f1;
    }

    ul {
        padding-left: 20px;
        margin: 0;
    }

    /* Responsive pour petits écrans */
    @media (max-width: 768px) {
        .head-title {
            flex-direction: column;
            align-items: flex-start;
        }

        .table-data {
            overflow-x: scroll;
        }
    }

</style>
@endpush

@section('dashboards')

    <div class="head-title">
        <div class="left">
            <h1>Commandes</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('admin_dashboard') }}">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>

    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert error">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-data">

        <h2 class="mb-4">Liste des Commandes</h2>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Statut</th>
                    <th>Prix Total</th>
                    <th>Date Paiement</th>
                    <th>Détails des livres</th>
                    <th>Paiement</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                <tr>
                    <td>{{ $commande->id }}</td>
                    <td>{{ $commande->user->name ?? 'Utilisateur inconnu' }}</td>
                    <td>{{ $commande->statut }}</td>
                    <td>{{ number_format($commande->prix_total, 2) }} FCFA</td>
                    <td>{{ $commande->date_paiement ?? 'Non payé' }}</td>
                    <td>
                        <ul>
                            @foreach($commande->details as $detail)
                            <li>
                                Livre : {{ $detail->livre->titre ?? 'Inconnu' }} |
                                Quantité : {{ $detail->quantite }} |
                                Prix unitaire : {{ number_format($detail->prix, 2) }} FCFA
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        @if($commande->paiement)
                            Montant : {{ number_format($commande->paiement->montant, 2) }} FCFA <br>
                            Date : {{ $commande->paiement->date_paiement }}
                        @else
                            Non payé
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('commandes.showCommandes', $commande->id) }}" class="btn btn-primary">Voir</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection
