@extends('public.content.showCategorie')

@section('categorie')
    <div class="container">
        <div class="book_details">
            <h2>{{ $book->titre }}</h2>
            <p>Auteur: {{ $book->auteur }}</p>
            <p>Prix: {{ $book->prix }} FCFA</p>
            <p>Description: {{ $book->description }}</p>
            <img src="{{ asset('storage/'.$book->image) }}" alt="{{ $book->titre }}">
            <a href="#" class="btn btn-success">Acheter</a>
        </div>
    </div>
@endsection
