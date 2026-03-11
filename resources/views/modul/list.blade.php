@extends('layout')

@section('title', 'Llistat de Moduls')

@section('stylesheets')
    @parent
@endsection

@section('content')
<div class="container mt-4 bg-white p-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Moduls</h1>
        @auth
        <a href="{{ route('modul_new') }}" class="btn btn-primary">Nou Modul</a>
        @endauth
    </div>
   @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('modul_list') }}" method="GET" class="row g-3 mb-4">
    <div class="col-md-4">
        <label for="professor_id" class="form-label">Filtrar per professor:</label>
        
        <select name="professor_id" id="professor_id" class="form-select">
            <option value="" selected>-- Tots --</option>
            @foreach ($professors as $professor)
                <option value="{{$professor->id}}"  
                @selected($selected_professor == $professor->id)>
                {{$professor->cognoms}}, {{$professor->nom}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label for="order" class="form-label">Direcció</label>
        <select name="order" id="order" class="form-select">
            <option value="hores_asc"  @selected($order == 'hores_asc')>ASC</option>
            <option value="hores_desc"  @selected($order == 'hores_desc')>DESC</option>
        </select>
    </div>
    <br>
    <div class="col-md-4 d-flex align-items-end gap-2">
        <button type="submit" class="btn btn-primary">Aplicar</button>
        <a href="{{ route('modul_list') }}" class="btn btn-dark">Reset</a>
    </div>

</form>
    <table class="table table-bordered align-middle text-center">
        <thead class="table">
            <tr class="table table-secondary">
                <th>Nom</th>
                <th>Hores</th>
                <th>Professor</th>
                <th>Accions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($moduls as $modul)
                <tr>
                    <td>{{ $modul->nom }}</td>
                    <td>{{ $modul->hores }}</td>
                    <td>
                        @if ($modul->professor)
                            {{ $modul->professor->cognoms }}, {{ $modul->professor->nom }}
                        @else
                            <em>Sense professor</em>
                        @endif
                    </td>

                    @auth
                    <td>
                        <a href="{{ route('modul_edit', ['id' => $modul->id]) }}" class="btn btn-dark btn-sm">Editar</a>    
                        <a href="{{ route('modul_delete', ['id' => $modul->id]) }}"class="btn btn-success btn-sm">Eliminar</a>
                    </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection