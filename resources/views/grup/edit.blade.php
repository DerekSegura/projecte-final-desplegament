@extends('layout')

@section('title', 'Editar grup')

@section('stylesheets')
    @parent
@endsection

@section('content')
<div class="container mt-4 bg-white p-5">
    <h1 class="mb-3">Editar grup</h1>
    <a href="{{ route('grup_list') }}" class="btn btn-secondary mb-4">&laquo; Torna</a>
    
        <form method="POST" action="{{ route('grup_edit', $grup->id) }}" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-6">            
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom',$grup->nom) }}">
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">                            
                <label for="aula" class="form-label">Aula</label>
                <input type="text" name="aula" id="aula" class="form-control @error('aula') is-invalid @enderror" value="{{ old('aula',$grup->aula) }}" />
                    @error('aula')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>
            
            <div class="col-md-6">                            
                <label for="tutor" class="form-label">Tutor</label>
                    <select name="tutor" id="tutor" class="form-select @error('tutor') is-invalid @enderror">
                        @foreach ($professors as $professor)
                            <option value="{{ $professor->id }}"
                                @selected(old('tutor', $grup->professor_id) == $professor->id)>
                                {{ $professor->cognoms }}, {{ $professor->nom }}, ({{ $professor->email }})
                            </option>
                        @endforeach
                    </select>
                    
                    @error('tutor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>

            <div class="col-12 d-flex justify-content-start gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Actualitzar</button>
                <a href="{{ route('grup_list') }}" class="btn btn-outline-secondary">Cancel·lar</a>
            </div>
        </form>
</div>
@endsection










