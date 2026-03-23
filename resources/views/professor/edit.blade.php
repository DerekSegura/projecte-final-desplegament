@extends('layout')

@section('title', 'Editar professor')

@section('stylesheets')
    @parent
@endsection

@section('content')
<div class="container mt-4 bg-white p-5">
    <h1 class="mb-3">Editar professor</h1>
    <a href="{{ route('professor_list') }}" class="btn btn-secondary mb-4">&laquo; Torna</a>
    
        <form method="POST" action="{{ route('professor_edit', $professor->id) }}" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-6">            
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom',$professor->nom) }}">
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">                            
                <label for="cognoms" class="form-label">Cognoms</label>
                <input type="text" name="cognoms" id="cognoms" class="form-control @error('cognoms') is-invalid @enderror" value="{{ old('cognoms',$professor->cognoms) }}" />
                    @error('cognoms')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>

            <div class="col-md-6">                            
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$professor->email) }}" />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>

            <div class="col-md-6">
                <label for="foto" class="form-label">Foto(opcional)</label>
                @if ($professor->foto)
                    <img src="{{ asset(config('app.imatges.ruta') . '/' . $professor->foto) }}" alt="Foto actual" width="120" class="rounded mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="eliminar_foto" id="eliminar_foto">
                        <label class="form-check-label" for="eliminar_foto">Eliminar foto</label>
                    </div>
                @else
                <p> <em>Sense foto</em></p>
                @endif                
            </div>

            <div class="col-md-6">
                <label for="foto" class="form-label">Canviar foto (opcional)</label>
                <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 d-flex justify-content-start gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Desar</button>
                <a href="{{ route('professor_list') }}" class="btn btn-outline-secondary">Cancel·lar</a>
            </div>
        </form>
</div>
@endsection










