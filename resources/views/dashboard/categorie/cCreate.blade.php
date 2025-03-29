@extends('dashboard.layout.app')

@section('dashboards')

    <div class="head-title">
        <div class="left">
            <h1>Catégories</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('admin_dashboard') }}">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right' ></i></li>
                <li>
                    <a class="active" href="{{ route('dashboard.categorie.cCreate') }}">Ajouter une catégorie</a>
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
            <h1>Ajouter une nouvelle catégorie</h1>
        </div>
        <div class="content_form">
            <form action="{{ route('dashboard.categorie.cStore') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nom">Nom de la catégorie</label>
                    <input type="text" name="nom" id="nom" required>
                </div>
                <div class="form-group">
                    <button type="submit">Ajouter la catégorie</button>
                </div>
            </form>
        </div>
    </div>

@endsection
