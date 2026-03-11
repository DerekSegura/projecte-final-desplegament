@extends('layout')

@section('title', 'Llistat de Grups')

@section('stylesheets')
    @parent
@endsection

@section('content')
<div class="container mt-4 bg-white p-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Grups</h1>
        @auth
        <a href="{{ route('grup_new') }}" class="btn btn-primary">Nou grup</a>
        @endauth
    </div>
   @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <table class="table table-bordered align-middle text-center">
        <thead class="table ">
            <tr class="table table-secondary">
                <th>Nom</th>
                <th>Aula</th>
                <th>Tutor</th>
                <th>Accions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($grups as $grup)
                <tr>
                    <td>{{ $grup->nom }}</td>
                    <td>{{ $grup->aula }}</td>
                    <td>{{ $grup->professor->cognoms . ", " . $grup->professor->nom }}</td>
                    
                    @auth
                    <td>
                        <a href="{{ route('grup_edit', ['id' => $grup->id]) }}" class="btn btn-dark btn-sm">Editar</a>    
                        <a href="{{ route('grup_delete', ['id' => $grup->id]) }}"class="btn btn-success btn-sm">Eliminar</a><br>
                    </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection