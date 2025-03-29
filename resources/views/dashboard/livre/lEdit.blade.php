@extends('dashboard.layout.app')

@section('dashboards')
    <div class="head-title">
        <div class="left">
            <h1>Livres</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('admin_dashboard') }}">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right' ></i></li>
                <li>
                    <a class="active" href="{{ route('admin_dashboard') }}">Livres</a>
                </li>
                <li><i class='bx bx-chevron-right' ></i></li>
                <li>
                    <a href="{{ route('dashboard.livre.lEdit', $livre->id) }}">Modifier un livre</a>
                </li>
            </ul>
        </div>
        <a href="#" class="btn-download">
            <i class='bx bxs-cloud-download' ></i>
            <span class="text">Download PDF</span>
        </a>
    </div>

    <div class="content-body">
        <div class="head">
            <h1>Modifier un livre</h1>
        </div>
        <div class="content_form">
            <form action="{{ route('dashboard.livre.lUpdate', $livre->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="titre">Titre <span class="required">*</span></label>
                    <input type="text" name="titre" id="titre" value="{{ $livre->titre }}" required>
                </div>
                <div class="form-group">
                    <label for="auteur">Auteur <span class="required">*</span></label>
                    <input type="text" name="auteur" id="auteur" value="{{ $livre->auteur }}" required>
                </div>
                <div class="form-group">
                    <label for="prix">Prix <span class="required">*</span></label>
                    <input type="number" name="prix" id="prix" value="{{ $livre->prix }}" required>
                </div>
                <div class="form-group">
                    <label for="image">Image <span class="required">*</span></label>
                    <input type="file" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="description">Description <span class="required">*</span></label>
                    <textarea name="description" id="description" required>{{ $livre->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="stock">Stock <span class="required">*</span></label>
                    <input type="number" name="stock" id="stock" value="{{ $livre->stock }}" required>
                </div>
                <div class="form-group">
                    <label for="categorie_id">Catégorie <span class="required">*</span></label>
                    <select name="categorie_id" id="categorie_id" required>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ $livre->categorie_id == $categorie->id ? 'selected' : '' }}>{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>

@endsection
