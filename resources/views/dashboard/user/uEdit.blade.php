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
                    <a class="active" href="{{ route('admin_dashboard') }}">Utilisateurs</a>
                </li>
                <li><i class='bx bx-chevron-right' ></i></li>
                <li>
                    <a href="{{ route('dashboard.user.uEdit', $user->id) }}">Modifier un utilisateur</a>
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
            <h1>Modifier un utilisateur</h1>
        </div>
        <div class="content_form">
            <form action="{{ route('dashboard.user.uUpdate', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nom <span class="required">*</span></label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" required>
                </div>
                <div class="form-group">
                    <label for="role">Rôle <span class="required">*</span></label>
                    <select name="role" id="role" required>
                        <option value="client" {{ $user->role == 'client' ? 'selected' : '' }}>Client</option>
                        <option value="gestionnaire" {{ $user->role == 'gestionnaire' ? 'selected' : '' }}>Gestionnaire</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>

@endsection
