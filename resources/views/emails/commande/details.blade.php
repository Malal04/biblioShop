@component('mail::message')
    # Détails de votre commande #{{ $commande->id }}

    - Client : {{ $commande->user->name }}
    - Statut : {{ $commande->statut }}
    - Prix : {{ $commande->prix_total }} FCFA

    ## Livres :
    @foreach($commande->details as $detail)
    - {{ $detail->livre->titre ?? 'Inconnu' }} (x{{ $detail->quantite }}) : {{ $detail->prix }} FCFA
    @endforeach

    Merci pour votre commande !  

@endcomponent