@component('mail::message')
    # ✅ Nouvelle commande validée

    Bonjour Admin,

    Une commande vient d’être **validée** par **{{ $commande->user->name }}**.

    ---

    ## 🧾 Détails de la commande

    - **Numéro :** #{{ $commande->id }}
    - **Date :** {{ $commande->created_at->format('d/m/Y H:i') }}
    - **Montant total :** <span style="font-weight: bold; color: #28a745">{{ number_format($commande->prix_total, 0, ',', ' ') }} FCFA</span>
    - **Statut :** {{ ucfirst($commande->statut) }}

    ---

    @component('mail::button', ['url' => route('commande.show', $commande->id), 'color' => 'success'])
    🔍 Voir la commande
    @endcomponent

    Merci pour votre réactivité,<br>
    L’équipe **{{ config('app.name') }}**
@endcomponent
