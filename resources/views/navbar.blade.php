<nav class="navbar navbar-expand-lg  mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"><img src="https://agora.xtec.cat/ies-carles-vallbona/wp-content/uploads/usu2364/2025/10/logo_CarlesVallbona.png" alt="LogoVallbona" width="160"></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a href="{{ route('professor_list') }}"class="nav-link text-decoration-none {{ request()->routeIs('professor_list') ? 'border-bottom border-primary fw-bold text-primary' : 'text-dark' }}">Professors</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('grup_list') }}"class="nav-link text-decoration-none {{ request()->routeIs('grup_list') ? 'border-bottom border-primary fw-bold text-primary' : 'text-dark' }}">Grups</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('modul_list') }}"class="nav-link text-decoration-none {{ request()->routeIs('modul_list') ? 'border-bottom border-primary fw-bold text-primary' : 'text-dark' }}">Mòduls</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('alumne_list') }}"class="nav-link text-decoration-none {{ request()->routeIs('alumne_list') ? 'border-bottom border-primary fw-bold text-primary' : 'text-dark' }}">Alumnes</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('departaments.index') }}"class="nav-link text-decoration-none {{ request()->routeIs('departaments.index') ? 'border-bottom border-primary fw-bold text-primary' : 'text-dark' }}">Departaments</a>
                </li>

            </ul>

            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sessió</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <span class="nav-link">Hola, {{ Auth::user()->name }}</span>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-dark btn-sm">Sortir</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
