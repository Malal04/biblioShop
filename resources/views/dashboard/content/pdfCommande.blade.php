<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commande #{{ $commande->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.6;
            background-color: #fff;
            padding: 20px;
        }

        /* ---- ENTÊTE ---- */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }

        .logo {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
        }

        .company-info {
            text-align: right;
            font-size: 13px;
            color: #555;
        }

        /* ---- TITRES ---- */
        h1 {
            font-size: 22px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        h2, h3 {
            font-size: 16px;
            margin-bottom: 8px;
            color: #34495e;
            border-bottom: 1px solid #ccc;
            padding-bottom: 3px;
        }

        /* ---- SECTIONS ---- */
        .section {
            margin-bottom: 20px;
        }

        .section p {
            margin: 5px 0;
        }

        .section strong {
            color: #2d3436;
        }

        /* ---- TABLE ---- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fafafa;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background-color: #ecf0f1;
            color: #2c3e50;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f7f7f7;
        }

        .text-right {
            text-align: right;
        }

        /* ---- PIED DE PAGE ---- */
        footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: center;
            color: #888;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

    </style>
</head>
<body>

    <!-- En-tête de facture -->
    <div class="header">
        <div class="logo">
            <img src="{{ asset('image/logo/biblioshop_logo5.png') }}" alt="BiblioShop Logo" width="50">
            <h3>📚 BiblioShop</h3>
        </div>
        <div class="company-info">
            BiblioShop SARL<br>
            Apix-Keur Massar, Dakar, Sénégal<br>
            Tél : +221 77 123 45 67<br>
            Email : support@biblioshop.com<br>
            NINEA : 123456789XYZ
        </div>
    </div>

    <div>
        <h1>Facture - Commande #{{ $commande->id }}</h1>
        <p>Date de commande : {{ $commande->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="section">
        <h3>Informations Client</h3>
        <p><strong>Nom :</strong> {{ $commande->user->name ?? 'Utilisateur inconnu' }}</p>
        <p><strong>Email :</strong> {{ $commande->user->email ?? 'Non disponible' }}</p>
    </div>

    <div class="section">
        <h3>Informations Commande</h3>
        <p><strong>Statut :</strong> {{ $commande->statut }}</p>
        <p><strong>Prix total :</strong> {{ number_format($commande->prix_total, 2) }} FCFA</p>
        <p><strong>Date de paiement :</strong> {{ $commande->date_paiement ?? 'Non payé' }}</p>
    </div>

    <div class="section">
        <h3>Détails des livres</h3>
        <table>
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
                        <td>{{ $detail->livre->titre ?? 'Livre inconnu' }}</td>
                        <td>{{ $detail->quantite }}</td>
                        <td>{{ number_format($detail->prix, 2) }} FCFA</td>
                        <td>{{ number_format($detail->prix * $detail->quantite, 2) }} FCFA</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h3>Paiement</h3>
        @if($commande->paiement)
            <p><strong>Montant payé :</strong> {{ number_format($commande->paiement->montant, 2) }} FCFA</p>
            <p><strong>Date de paiement :</strong> {{ $commande->paiement->date_paiement }}</p>
        @else
            <p><em>Aucun paiement enregistré.</em></p>
        @endif
    </div>

    <footer>
        Merci pour votre confiance.<br>
        Cette facture a été générée automatiquement par BiblioShop.
    </footer>

</body>
</html>
