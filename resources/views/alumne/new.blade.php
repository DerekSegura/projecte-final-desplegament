@extends('layout')

@section('title', 'Crear un nou alumne')

@section('stylesheets')
    @parent
@endsection

@section('content')
<div class="container mt-4 bg-white p-5">
    <h1 class="mb-3">Nou alumne</h1>
    <a href="{{ route('alumne_list') }}" class="btn btn-secondary mb-4">&laquo; Torna</a>

        <form method="POST" action="{{ route('alumne_new') }}" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-6">            
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}">
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">            
                <label for="nom" class="form-label">Cognoms</label>
                <input type="text" name="cognoms" id="cognoms" class="form-control @error('cognoms') is-invalid @enderror" value="{{ old('cognoms') }}">
                @error('cognoms')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">                            
                <label for="dni" class="form-label">DNI</label>
                <input type="text" name="dni" id="dni" class="form-control @error('dni') is-invalid @enderror" value="{{ old('dni') }}" />
                    @error('dni')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>

            <div class="col-md-6">                            
                <label for="data_naixement" class="form-label">Data naixement</label>
                <input type="date" name="data_naixement" id="data_naixement" class="form-control @error('data_naixement') is-invalid @enderror" value="{{ old('data_naixement') }}" />
                    @error('data_naixement')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>

            <div class="col-md-6">                            
                <label for="telefon" class="form-label">Telefon</label>
                <input type="text" name="telefon" id="telefon" class="form-control @error('telefon') is-invalid @enderror" value="{{ old('telefon') }}" />
                    @error('telefon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>

            <div class="col-md-6">                            
                <label for="grup" class="form-label">Grup (opcional)</label>
                    <select name="grup" id="grup" class="form-select @error('grup') is-invalid @enderror">
                        <option value="">-- Sense grup --</option>

                        @foreach ($grups as $grup)
                            <option value="{{ $grup->id }}" 
                                @selected(old('grup',$lastGrup ) == $grup->id)>
                                {{ $grup->nom }}
                            </option>
                        @endforeach
                    </select>
                    
                    @error('grup')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>
        <hr>

        <h4>Matricula (mòduls i notes)</h4>

        @foreach ($moduls as $modul)
            <div class="form-check mb-2">

                <input type="checkbox"
                    name="moduls[]"
                    value="{{ $modul->id }}"
                    class="form-check-input modul-checkbox"
                    data-target="nota-{{ $modul->id }}">

                <label class="form-check-label">
                    {{ $modul->nom }}
                </label>

                <input type="number"
                    name="notes[{{ $modul->id }}]"
                    id="nota-{{ $modul->id }}"
                    class="form-control mt-1"
                    placeholder="Nota (0-10)"
                    min="0" max="10" step="0.1"
                    disabled>
            </div>
        @endforeach

        <div class="col-md-6 mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="simular_error" id="simular_error">
                <label class="form-check-label" for="simular_error">
                    Simular error (provar rollback)
                </label>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-start gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Desar</button>
                <a href="{{ route('alumne_list') }}" class="btn btn-outline-secondary">Cancel·lar</a>
        </div>
    </form>
        <script>
        document.querySelectorAll('.modul-checkbox').forEach(chk => {
            chk.addEventListener('change', function() {
                const target = document.getElementById(this.dataset.target);
                target.disabled = !this.checked;
                if (!this.checked) target.value = "";
            });
        });
        </script>
</div>
@endsection










