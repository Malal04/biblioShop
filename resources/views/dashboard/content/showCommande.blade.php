@extends('dashboard.layout.app')
@push('styles')
    <style>
       
    </style>
@endpush

@section('dashboards')

    <div class="head-title">
        <div class="left">
            <h1>Commandes </h1>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('admin_dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('admin_orders') }}">Detail Commande {{ $commande->user->name ?? 'Utilisateur inconnu' }}</a>
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

    <div class="container mt-4">
        <h1>Détail de la commande #{{ $commande->id }}</h1>
    
        <div class="mb-3">
            <strong>Client :</strong> {{ $commande->user->name ?? 'Utilisateur inconnu' }}<br>
            <strong>Statut :</strong> {{ $commande->statut }}<br>
            <strong>Prix total :</strong> {{ number_format($commande->prix_total, 2) }} FCFA<br>
            <strong>Date de paiement :</strong> {{ $commande->date_paiement ?? 'Non payé' }}<br>
        </div>
    
        <h4>Détails des livres</h4>
        <ul>
            @foreach($commande->details as $detail)
                <li>
                    <strong>{{ $detail->livre->titre ?? 'Livre inconnu' }}</strong><br>
                    Quantité : {{ $detail->quantite }}<br>
                    Prix unitaire : {{ number_format($detail->prix, 2) }} FCFA
                </li>
            @endforeach
        </ul>
    
        <h4 class="mt-4">Paiement</h4>
        @if($commande->paiement)
            Montant payé : {{ number_format($commande->paiement->montant, 2) }} FCFA<br>
            Date de paiement : {{ $commande->paiement->date_paiement }}
        @else
            <p>Non payé</p>
        @endif
    
        <a href="{{ route('commandes.indexCommande') }}" class="btn btn-secondary mt-3">← Retour à la liste</a>
    </div>
    

@endsection
