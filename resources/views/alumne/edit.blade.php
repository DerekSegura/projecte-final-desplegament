@extends('layout')

@section('title', 'Editar alumne')

@section('stylesheets')
    @parent
@endsection

@section('content')
<div class="container mt-4 bg-white p-5">
    <h1 class="mb-3">Editar alumne</h1>
    <a href="{{ route('alumne_list') }}" class="btn btn-secondary mb-4">&laquo; Torna</a>
    
        <form method="POST" action="{{ route('alumne_edit', $alumne->id) }}" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-6">            
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom',$alumne->nom) }}">
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">            
                <label for="cognoms" class="form-label">Cognoms</label>
                <input type="text" name="cognoms" id="cognoms" class="form-control @error('cognoms') is-invalid @enderror" value="{{ old('cognoms',$alumne->cognoms) }}">
                @error('cognoms')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">            
                <label for="dni" class="form-label">DNI</label>
                <input type="text" name="dni" id="dni" class="form-control @error('dni') is-invalid @enderror" value="{{ old('dni',$alumne->dni) }}">
                @error('dni')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">                            
                <label for="data_naixement" class="form-label">Data naixement</label>
                <input type="date" name="data_naixement" id="data_naixement" class="form-control @error('data_naixement') is-invalid @enderror" value="{{ old('data_naixement',$alumne->data_naixement) }}" />
                    @error('data_naixement')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>
            
            <div class="col-md-6">            
                <label for="telefon" class="form-label">Telèfon (opcional)</label>
                <input type="text" name="telefon" id="telefon" class="form-control @error('telefon') is-invalid @enderror" value="{{ old('telefon',$alumne->telefon) }}">
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
                            @selected(old('grup', $alumne->grup) == $grup->id)>
                            {{ $grup->nom }}
                        </option>
                    @endforeach
                </select>

                @error('grup')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <hr>
            <h4>Matrícula (mòduls i notes)</h4>

            @foreach ($moduls as $modul)
                @php
                    $matriculat = $alumne->moduls->contains($modul->id);
                    $nota = $matriculat ? $alumne->moduls->find($modul->id)->pivot->nota : null;
                @endphp

                <div class="form-check mb-2">

                    <input type="checkbox"
                        name="moduls[]"
                        value="{{ $modul->id }}"
                        class="form-check-input modul-checkbox"
                        data-target="nota-{{ $modul->id }}"
                        @checked($matriculat)>

                    <label class="form-check-label">
                        {{ $modul->nom }}
                    </label>

                    <input type="number"
                        name="notes[{{ $modul->id }}]"
                        id="nota-{{ $modul->id }}"
                        class="form-control mt-1"
                        placeholder="Nota (0-10)"
                        min="0" max="10" step="0.1"
                        value="{{ $nota }}"
                        @disabled(!$matriculat)>
                </div>
            @endforeach

            <script>
                document.querySelectorAll('.modul-checkbox').forEach(chk => {
                    chk.addEventListener('change', function() {
                        const target = document.getElementById(this.dataset.target);
                        target.disabled = !this.checked;
                        if (!this.checked) target.value = "";
                    });
                });
            </script>


            <div class="col-12 d-flex justify-content-start gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Actualitzar</button>
                <a href="{{ route('alumne_list') }}" class="btn btn-outline-secondary">Cancel·lar</a>
            </div>
        </form>
</div>
@endsection










