@extends('layout_no_nav')
@section('title', 'Gestor Institut Carles Vallbona')

@section('content')
<div class="container text-center mt-5 bg-white p-5 w-50">

    <div>
        <img src="{{ asset('img/logo.png') }}" alt="Logo Institut" style="max-width: 500px;" class="mb-3">

        <h2 class="mb-3">Gestor Institut Carles Vallbona</h2>
        <p class="mb-4">Accedeix com a usuari registrat o entra com a convidat per consultar els llistats.</p>

        <div class="d-flex justify-content-center gap-3 mb-4 flex-column">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
            <a href="{{ route('register') }}" class="btn btn-dark btn-lg">Register</a>
            <a href="{{ route('guest_access') }}" class="btn btn-success btn-lg">Entrar com a guest</a>
        </div>

        <div class="alert alert-info mt-3" style="max-width: 600px; margin: 0 auto;">
            <strong>Guest:</strong> només pots veure llistats.<br>
            <strong>Login:</strong> pots crear, editar i eliminar.
        </div>
    </div>
</div>
@endsection
