@extends('layout')

@section('title', 'Llistat de moduls del departament')

@section('stylesheets')
    @parent
@endsection

@section('content')
<div class="container mt-4 bg-white p-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Mòduls del departament: {{ $departament->nom }}</h1>
    </div>
        <p><strong>Professor responsable:</strong> {{ $departament->professor->nom }} {{ $departament->professor->cognoms }}</p>

        <div class="col-md-4 d-flex align-items-end gap-2">
            <a href="{{ route('departaments.index', ['order' => 'moduls_asc']) }}" class="btn btn-outline-primary">
                Ordenar per mòduls ↑
            </a>

            <a href="{{ route('departaments.index', ['order' => 'moduls_desc']) }}" class="btn btn-outline-primary">
                Ordenar per mòduls ↓
            </a>
        </div>
    <table class="table table-bordered align-middle text-center">
        <thead class="table ">
            <tr class="table table-secondary">
                <th>Nom del mòdul</th>
                <th>Hores</th>
                <th>Professor</th>
            </tr>
        </thead>

        <tbody>
            @foreach($departament->moduls as $modul)
                <tr>
                    <td>{{ $modul->nom }}</td>
                    <td>{{ $modul->hores }}</td>
                    <td>{{ $modul->professor->nom }} {{ $modul->professor->cognoms }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('departaments.index') }}" class="btn btn-secondary mt-3">Tornar</a>

</div>
@endsection