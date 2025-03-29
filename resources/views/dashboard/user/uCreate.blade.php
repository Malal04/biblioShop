@extends('dashboard.layout.app')

@section('dashboards')

    <div class="head-title">
        <div class="left">
            <h1>Utilisateurs</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('admin_dashboard') }}">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right' ></i></li>
                <li>
                    <a class="active" href="{{ route('dashboard.user.uCreate') }}">Ajouter un utilisateur</a>
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
            <h1>Ajouter une nouvelle utilisateur</h1>
        </div>
        <div class="content_form">
            <form action="{{ route('dashboard.user.uStore') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" class="required">Nom <span class="required">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email" class="required">Email <span class="required">*</span></label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password" class="required">Mot de passe <span class="required">*</span></label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="role" class="required">Rôle <span class="required">*</span></label>
                    <select name="role" id="role" required>
                        <option value="client">Client</option>
                        <option value="gestionnaire">Gestionnaire</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit">Ajouter l'utilisateur</button>
                </div>
            </form>
        </div>
    </div>

@endsection
