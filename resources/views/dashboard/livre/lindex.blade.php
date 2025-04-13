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
            </ul>
        </div>
        {{-- <a href="#" class="btn-download">
            <i class='bx bxs-cloud-download' ></i>
            <span class="text">Download PDF</span>
        </a> --}}
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
                <h3>Livres</h3>
            </div>
           <div class="head_right">
            <a href="{{ route('dashboard.livre.lCreate') }}" class="ct_ctr">
                <i class='bx bxs-cloud-download' ></i>
                <span class="text">Ajouter un livre</span>
            </a>
           </div>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Stock</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($livres as $livre)
                    <tr>
                        <td>{{ $livre->titre }}</td>
                        <td>{{ $livre->auteur }}</td>
                        <td>{{ $livre->stock }}</td>
                        <td>{{ $livre->prix }}</td>
                        <td>{{ $livre->categorie->nom }}</td>
                        <td>
                            <a href="{{ route('dashboard.livre.lEdit', $livre->id) }}" 
                                class="edit"
                                style="
                                background-color: transparent; border: none; cursor: pointer;
                                 font-size: 16px; font-weight: bold; color: #0000ff;"
                                onclick="return confirm('Voulez-vous Modifier ce livre ?')"
                                >

                                Edit <i class='bx bx-edit'></i>

                            </a>
                        </td>
                        <td>
                            <form action="{{ route('dashboard.livre.lDelete', $livre->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete" 
                                style="
                                    background-color: transparent; border: none; cursor: pointer;
                                    font-size: 16px; font-weight: bold; color: #ff0000;"
                                    onclick="return confirm('Voulez-vous supprimer ce livre ?')"
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
