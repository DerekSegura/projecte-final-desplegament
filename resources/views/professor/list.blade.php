@extends('layout')

@section('title', 'Llistat de Professors')

@section('stylesheets')
    @parent
@endsection

@section('content')
<div class="container mt-4 bg-white p-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Professors</h1>
        @auth
        <a href="{{ route('professor_new') }}" class="btn btn-primary">Nou Professor</a>
        @endauth
    </div>
   @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('professor_ordenar') }}" method="GET" class="row g-3 mb-4">
    <div class="col-md-4">
        <label for="ordre" class="form-label">Ordenar per:</label>

        <select name="ordre" id="ordre" class="form-select">
            <option value="nom"  @selected($ordre == 'nom')>Nom</option>
            <option value="cognoms"  @selected($ordre == 'cognoms')>Cognoms</option>
            <option value="email"  @selected($ordre == 'email')>Email</option>
        </select>
    </div>

    <div class="col-md-4">
        <label for="ordreDireccio" class="form-label">Direcció</label>
        <select name="ordreDireccio" id="ordreDireccio" class="form-select">
            <option value="asc"  @selected($ordreDireccio == 'asc')>ASC</option>
            <option value="desc"  @selected($ordreDireccio == 'desc')>DESC</option>
        </select>
    </div>
    <br>

    <div class="col-md-4 d-flex align-items-end gap-2">
        <button type="submit" class="btn btn-primary">Aplicar</button>
        <a href="{{ route('professor_list') }}" class="btn btn-dark">Reset</a>
    </div>
</form>

    <table class="table table-bordered align-middle text-center">
        <thead class="table ">
            <tr class="table table-secondary">
                <th>Foto</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Accions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($professors as $professor)
                <tr>
                    <td>
                        @if ($professor->foto)
                            <img src="{{ asset(config('app.imatges.ruta') . '/' . $professor->foto) }}" 
                                alt="Foto de {{ $professor->nom }}" 
                                width="80">
                        @else
                            <em>Sense imatge</em>
                        @endif
                    </td>

                    <td>{{ $professor->cognoms . ", " . $professor->nom }}</td>
                    <td>{{ $professor->email }}</td>
                    
                    @auth
                    <td>
                        <a href="{{ route('professor_edit', ['id' => $professor->id]) }}" class="btn btn-dark btn-sm">Editar</a>    
                        <a href="{{ route('professor_delete', ['id' => $professor->id]) }}"class="btn btn-success btn-sm">Eliminar</a><br>
                    </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection