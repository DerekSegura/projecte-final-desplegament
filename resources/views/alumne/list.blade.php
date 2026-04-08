@extends('layout')

@section('title', 'Llistat de Alumnes')

@section('stylesheets')
    @parent
@endsection

@section('content')
<div class="container mt-4 bg-white p-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Alumnes</h1>
        @auth
        <a href="{{ route('alumne_new') }}" class="btn btn-primary">Nou alumne</a>
        @endauth
    </div>
   @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif


    <form action="{{ route('alumne_list') }}" method="GET" class="row g-3 mb-4">
    <div class="col-md-4">
        <label class="form-label">Cerca (DNI o cognoms)</label>
        <input type="text" name="cercar" class="form-control" value="{{ request('cercar') }}" >
    </div>

    <div class="col-md-4">
        <label class="form-label">Nota minima</label>
        <input type="number" name="nota_min" class="form-control" value="{{ request('nota_min') }}" min="0" max="10" step="0.1">
    </div>

    <div class="col-md-3">
        <label class="form-label">Condició</label>
        <select name="condicio" class="form-select">
            <option value="and" @selected(request('condicio') === 'and')>AND</option>
            <option value="or" @selected(request('condicio') === 'or')>OR</option>
        </select>
    </div>

    <div class="col-md-4 d-flex align-items-end gap-2">
        <button type="submit" class="btn btn-primary">Aplicar</button>
        <a href="{{ route('alumne_list') }}" class="btn btn-dark">Reset</a>
    </div>

    <table class="table table-bordered align-middle text-center">
        <thead class="table ">
            <tr class="table table-secondary">
                <th>Nom</th>
                <th>DNI</th>
                <th>Naixement</th>
                <th>Telèfon</th>
                <th>Grup</th>
                <th>Moduls</th>
                <th>Accions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($alumnes as $alumne)
                <tr>
                    <td>{{ $alumne->cognoms . ", " . $alumne->nom }}</td>
                    <td>{{ $alumne->dni }}</td>
                    <td>{{ $alumne->data_naixement }}</td>
                    <td>{{ $alumne->telefon }}</td>
                    <td>{{ $alumne->grupRel?->nom ?? '—' }}</td>
                    <td>
                        @foreach ($alumne->moduls as $modul)
                            {{ $modul->nom }} ({{ $modul->pivot->nota ?? '—' }})<br>
                        @endforeach
                    </td>
                    
                    @auth
                    <td>
                        <a href="{{ route('alumne_edit', ['id' => $alumne->id]) }}" class="btn btn-dark btn-sm">Editar</a>    
                        <a href="{{ route('alumne_delete', ['id' => $alumne->id]) }}"class="btn btn-success btn-sm">Eliminar</a><br>
                    </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection