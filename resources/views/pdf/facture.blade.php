<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Facture #{{ $commande->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { color: #333; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Facture #{{ $commande->id }}</h2>
    <p>Date : {{ $commande->created_at->format('d/m/Y') }}</p>
    <p>Client : {{ $commande->user->name }}</p>

    <h3>Détails de la commande</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Livre</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->details as $detail)
            <tr>
                <td>{{ $detail->livre->titre }}</td>
                <td>{{ $detail->quantite }}</td>
                <td>{{ number_format($detail->prix, 2) }} FCFA</td>
                <td>{{ number_format($detail->prix * $detail->quantite, 2) }} FCFA</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total à payer : {{ number_format($commande->prix_total, 2) }} FCFA</h4>
</body>
</html>
