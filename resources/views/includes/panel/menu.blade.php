<!-- Navigation -->
<h6 class="navbar-heading text-muted">
    Gestionar datos
</h6>
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="/home">
            <i class="ni ni-tv-2 text-primary"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/careers') }}">
            <i class="ni ni-hat-3 text-blue"></i> Carreras
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/laboratories') }}">
            <i class="ni ni-laptop text-info"></i> Laboratorios
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-time-alarm text-success"></i> Horarios de tiempo libre Laboratorios
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-circle-08 text-orange"></i> Alumnos
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-single-02 text-yellow"></i> Profesores
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-calendar-grid-58 text-red"></i> Reservaciones
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault(), document.getElementById('formLogout'). submit();">
            <i class="ni ni-key-25 "></i> Cerrar sesión
        </a>
        <form action="{{ route('logout') }}" method="POST" style="display: none" id="formLogout">
            @csrf
        </form>
    </li>
</ul>

<!-- Divider -->
<hr class="my-3">

<!-- Heading -->
<h6 class="navbar-heading text-muted">Reportes</h6>

<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
    <li class="nav-item">
        <a class="nav-link"
            href="#">
            <i class="ni ni-sound-wave text-yellow"></i> Frecuencia de Reservaciones
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-spaceship text-red"></i> Laboratorios más activos
        </a>
    </li>
</ul>