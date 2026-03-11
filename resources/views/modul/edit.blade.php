@extends('layout')

@section('title', 'Editar modul')

@section('stylesheets')
    @parent
@endsection

@section('content')
<div class="container mt-4 bg-white p-5">
    <h1 class="mb-3">Editar modul</h1>
    <a href="{{ route('modul_list') }}" class="btn btn-secondary mb-4">&laquo; Torna</a>
    
        <form method="POST" action="{{ route('modul_edit', $modul->id) }}" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-6">            
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom',$modul->nom) }}">
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">                            
                <label for="cognoms" class="form-label">Hores</label>
                <input type="number" name="hores" id="hores" class="form-control @error('hores') is-invalid @enderror" value="{{ old('hores',$modul->hores) }}" />
                    @error('cognoms')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>


            <div class="col-md-6">                            
                <label for="professor" class="form-label">Professor(opcional)</label>
                <select name="professor_id" id="professor_id" class="form-select @error('professor_id') is-invalid @enderror">
                    <option value="">-- Selecciona un professor --</option>

                    @foreach ($professors as $professor)
                        <option value="{{ $professor->id }}" 
                            @selected(old('professor_id', $modul->professor_id) == $professor->id)>
                            {{ $professor->cognoms }}, {{ $professor->nom }}, ({{ $professor->email }})
                        </option>
                    @endforeach

                </select>
                    @error('professor_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>

            <div class="col-12 d-flex justify-content-start gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Desar</button>
                <a href="{{ route('modul_list') }}" class="btn btn-outline-secondary">Cancel·lar</a>
            </div>
        </form>
</div>
@endsection










