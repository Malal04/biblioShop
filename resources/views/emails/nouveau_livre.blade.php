@component('mail::message')
    # 📚 Nouveau livre disponible !

    Bonjour,

    Un **nouveau livre** vient d’être ajouté à notre bibliothèque :

    ---

    ### 📖 {{ $livre->titre }}

    **Auteur :** {{ $livre->auteur }}  
    **Prix :** {{ number_format($livre->prix, 0, ',', ' ') }} FCFA  
    **Catégorie :** {{ $livre->categorie->nom }}

    @if($livre->description)
    **Description :**  
    _{{ $livre->description }}_
    @endif

    @component('mail::button', ['url' => route('public_page.livre.show', $livre->id)])
    🔎 Découvrir ce livre
    @endcomponent

    ---

    Merci de votre fidélité,<br>
    **L’équipe {{ config('app.name') }}**
@endcomponent
