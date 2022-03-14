<li class="nav-item">
    <a class="nav-link" href="{{ route('user.home') }}">
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
{{-- <li class="nav-item">
    <a class="nav-link" href="{{ url('/schedule') }}">
        <i class="ni ni-time-alarm text-success"></i> Gestión de Horarios de Laboratorios
    </a>
</li>  --}}
<li class="nav-item">
    <a class="nav-link" href="{{ url('/students') }}">
        <i class="ni ni-circle-08 text-orange"></i> Alumnos
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('/attendants') }}">
        <i class="ni ni-single-02 text-yellow"></i> Profesores
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="ni ni-calendar-grid-58 text-red"></i> Reservaciones
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('user.logout') }}"
        onclick="event.preventDefault(), document.getElementById('formLogout'). submit();">
        <i class="ni ni-key-25 "></i> Cerrar sesión
    </a>
    <form action="{{ route('user.logout') }}" method="POST" style="display: none" id="formLogout">
        @csrf
    </form>
</li>
