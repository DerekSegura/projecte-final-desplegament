@extends('layout')

@section('title', 'Llistat de Departaments')

@section('stylesheets')
    @parent
@endsection

@section('content')
<div class="container mt-4 bg-white p-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Departaments SIUUUU</h1>
        @auth
        <a href="{{ route('departaments.create') }}" class="btn btn-primary">Nou departament</a>
        @endauth
    </div>
   @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form method="GET" action="{{ route('departaments.index') }}" class="row g-3 mb-4">

    <div class="col-md-4">
        <label for="search" class="form-label"> Cerca per nom: </label>
        <input type="text" name="search" class="form-control" value="{{ request('search') }}">
    </div>
    <div class="col-md-4">
        <label for="searchModulNom" class="form-label"> Cerca per nom de modul: </label>
        <input type="text" name="searchModulNom" class="form-control" value="{{ request('searchModulNom') }}">
    </div>

    <div class="col-md-4">
        <label for="professor_id" class="form-label">Filtrar per professor:</label>
        
        <select name="professor_id" id="professor_id" class="form-select">
            <option value="" selected>-- Tots --</option>
            @foreach ($professors as $professor)
                <option value="{{$professor->id}}"
                @selected(request('professor_id') == $professor->id)>
                {{$professor->cognoms}}, {{$professor->nom}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label for="order" class="form-label">Direcció</label>
        <select name="order" id="order" class="form-select">
            <option value="asc"  @selected(request('order') == 'asc')>ASC</option>
            <option value="desc"  @selected(request('order') == 'desc')>DESC</option>
        </select>
    </div>
    <br>

    <div class="col-md-4 d-flex align-items-end gap-2">
        <button type="submit" class="btn btn-primary">Aplicar</button>
        <a href="{{ route('departaments.index') }}" class="btn btn-dark">Reset</a>
    </div>

    </form>

    <table class="table table-bordered align-middle text-center">
        <thead class="table ">
            <tr class="table table-secondary">
                <th>Nom</th>
                <th>Descripcio</th>
                <th>Professor</th>
                <th>Mòduls</th>
                <th>Nombre de mòduls</th>
                @auth
                <th>Accions</th>
                @endauth
            </tr>
        </thead>

        <tbody>
            @foreach ($departaments as $departament)
                <tr>
                    <td>{{ $departament->nom }}</td>
                    <td>{{ $departament->descripcio }}</td>
                    <td>{{ $departament->professor->cognoms . ", " . $departament->professor->nom  }}</td>                    
                    <td>
                        @if($departament->moduls->isEmpty())
                            <span class="text-muted">Sense mòduls</span>
                        @endif
                        <ul class="list-unstyled mb-0">
                            @foreach($departament->moduls as $modul)
                                <li>{{ $modul->nom }} ({{ $modul->hores }}h)</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $departament->moduls->count() }}</td>
                    @auth
                    <td>
                        <a href="{{ route('departaments.edit', $departament) }}" class="btn btn-dark btn-sm">Editar</a>    
                        <form action="{{ route('departaments.destroy', $departament) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-success btn-sm">Eliminar</button>
                        </form>
                    </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection