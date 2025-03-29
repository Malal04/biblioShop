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
                    <a class="active" href="{{ route('dashboard.categorie.cCreate') }}">Ajouter un livre</a>
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
            <h1>Ajouter une nouvelle livre</h1>
        </div>
        <div class="content_form">
            <form action="{{ route('dashboard.livre.lStore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="titre">Titre du livre <span class="required">*</span></label>
                    <input type="text" name="titre" id="titre" required>
                </div>
                <div class="form-group">
                    <label for="auteur">Auteur du livre <span class="required">*</span></label>
                    <input type="text" name="auteur" id="auteur" required>
                </div>
                <div class="form-group">
                    <label for="prix">Prix du livre <span class="required">*</span></label>
                    <input type="number" name="prix" id="prix" required>
                </div>
                <div class="form-group">
                    <label for="image">Image du livre <span class="required">*</span></label>
                    <input type="file" name="image" id="image" required>
                </div>
                <div class="form-group">
                    <label for="description">Description du livre <span class="required">*</span></label>
                    <textarea name="description" id="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="stock">Stock du livre <span class="required">*</span></label>
                    <input type="number" name="stock" id="stock" required>
                </div>
                <div class="form-group">
                    <label for="categorie_id">Catégorie du livre <span class="required">*</span></label>
                    <select name="categorie_id" id="categorie_id" required>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

@endsection
