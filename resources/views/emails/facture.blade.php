<h2>Bonjour {{ $commande->user->name }},</h2>
<p>Merci pour votre commande ! Voici le détail :</p>

<p><strong>Commande #{{ $commande->id }}</strong></p>
<p>Date : {{ $commande->created_at->format('d/m/Y H:i') }}</p>
<p>Montant total : {{ number_format($commande->prix_total, 2) }} FCFA</p>

<h3>Détails de la commande :</h3>
<ul>
@foreach ($commande->details as $detail)
    <li>
        {{ $detail->livre->titre }} - {{ $detail->quantite }} x {{ number_format($detail->prix, 2) }} FCFA
    </li>
@endforeach
</ul>

<p>Statut : <strong>{{ ucfirst($commande->statut) }}</strong></p>

<p>Facture : <a href="{{ route('commandes.pdf', $commande->id) }}" class="btn btn-outline-danger">📄 PDF</a></p>

<p>À bientôt sur <strong>BiblioShop</strong> 📚</p>
