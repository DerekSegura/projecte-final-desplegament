@extends('layout')

@section('title', 'Editar departament')

@section('stylesheets')
    @parent
@endsection

@section('content')
<div class="container mt-4 bg-white p-5">
    <h1 class="mb-3">Editar departament</h1>
    <a href="{{ route('departaments.index') }}" class="btn btn-secondary mb-4">&laquo; Torna</a>
    
        <form method="POST" action="{{ route('departaments.update', $departament->id) }}" class="row g-3">
            @csrf
            @method('PUT')
            <div class="col-md-6">            
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom',$departament->nom) }}">
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">            
                <label for="descripcio" class="form-label">Descripcio</label>
                <input type="text" name="descripcio" id="descripcio" class="form-control @error('descripcio') is-invalid @enderror" value="{{ old('descripcio',$departament->descripcio) }}">
                @error('descripcio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">                            
                <label for="professor_id" class="form-label">Professor responsable</label>
                <select name="professor_id" id="professor_id" class="form-select @error('professor_id') is-invalid @enderror">
                    @foreach ($professors as $professor)
                            <option value="{{ $professor->id }}" 
                                @selected(old('professor_id', $departament->professor_id) == $professor->id)>
                                {{ $professor->cognoms }}, {{ $professor->nom }}
                            </option>
                    @endforeach
                </select>
                @error('professor_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>

            <div class="col-md-6">                            
                <label for="moduls" class="form-label">Moduls del departament</label> <br>
                    @foreach ($moduls as $modul)
                            <input type="checkbox"
                                name="moduls[]"
                                value="{{ $modul->id }}"
                                class="form-check-input modul-checkbox"
                                data-target="nota-{{ $modul->id }}">
                            <label class="form-check-label">
                                {{ $modul->nom }}
                            </label>
                    @endforeach
            </div>

            <div class="col-12 d-flex justify-content-start gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Actualitzar</button>
                <a href="{{ route('departaments.index') }}" class="btn btn-outline-secondary">Cancel·lar</a>
            </div>
        </form>
</div>
@endsection
