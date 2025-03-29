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
                    <a class="active" href="{{ route('dashboard.user.uIndex') }}">Utilisateurs</a>
                </li>
            </ul>
        </div>
        <a href="#" class="btn-download">
            <i class='bx bxs-cloud-download' ></i>
            <span class="text">Download PDF</span>
        </a>
    </div>

    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert error">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-data">
     
        <div class="table_head_name">
            <div class="head_left">
                <h3>Utilisateurs</h3>
            </div>
           <div class="head_right">
            <a href="{{ route('dashboard.user.uCreate') }}" class="ct_ctr">
                <i class='bx bxs-cloud-download' ></i>
                <span class="text">Ajouter un utilisateur</span>
            </a>
           </div>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="{{ route('dashboard.user.uEdit', $user->id) }}" 
                                class="edit"
                                style="
                                background-color: transparent; border: none; cursor: pointer;
                                 font-size: 16px; font-weight: bold; color: #0000ff;"
                                onclick="return confirm('Voulez-vous Modifier ce utilisateur ?')"
                                >

                                Edit <i class='bx bx-edit'></i>

                            </a>
                        </td>
                        <td>
                            <form action="{{ route('dashboard.user.uDelete', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete" 
                                style="
                                    background-color: transparent; border: none; cursor: pointer;
                                    font-size: 16px; font-weight: bold; color: #ff0000;"
                                    onclick="return confirm('Voulez-vous supprimer ce utilisateur ?')"
                                >
                                    <i class='bx bx-trash'></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection
