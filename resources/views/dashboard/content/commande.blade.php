@extends('dashboard.layout.app')

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
        <h2>Détails de la commande #{{ $commande->id }}</h2>
        <div class="mb-4">
            <p><strong>Client :</strong> {{ $commande->user->name }}</p>
            <p><strong>Date de paiement :</strong> {{ $commande->date_paiement }}</p>
            <p><strong>Statut :</strong> {{ ucfirst($commande->statut) }}</p>
            <p><strong>Prix total :</strong> {{ number_format($commande->prix_total, 2) }} FCFA</p>
        </div>
        <!-- Formulaire pour changer le statut -->
        <form action="{{ route('commande.updateStatut', $commande->id) }}" method="POST" class="mb-4">
            @csrf
            @method('PUT')
            <div class="form-inline">
                <label for="statut" class="mr-2"><strong>Changer le statut :</strong></label>
                <select name="statut" id="statut" class="form-control mr-2">
                    <option value="en attente" {{ $commande->statut == 'en attente' ? 'selected' : '' }}>En attente</option>
                    <option value="en preparation" {{ $commande->statut == 'en preparation' ? 'selected' : '' }}>En preparation</option>
                    <option value="expédiée" {{ $commande->statut == 'expédiée' ? 'selected' : '' }}>Expédiée</option>
                    <option value="payée" {{ $commande->statut == 'payée' ? 'selected' : '' }}>Payée</option>
                </select>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre du livre</th>
                    <th>Auteur</th>
                    <th>Quantité</th>
                    <th>Prix unitaire (FCFA)</th>
                    <th>Total (FCFA)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commande->details as $index => $detail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $detail->livre->titre }}</td>
                        <td>{{ $detail->livre->auteur }}</td>
                        <td>{{ $detail->quantite }}</td>
                        <td>{{ number_format($detail->prix, 2) }}</td>
                        <td>{{ number_format($detail->quantite * $detail->prix, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-right">Total :</th>
                    <th>{{ number_format($commande->prix_total, 2) }} FCFA</th>
                </tr>
            </tfoot>

        </table>
    </div>

@endsection
