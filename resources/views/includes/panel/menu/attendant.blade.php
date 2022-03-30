<li class="nav-item">
    <a class="nav-link" href="{{ route('attendant.home') }}">
        <i class="ni ni-tv-2 text-primary"></i> Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('/laboratories') }}">
        <i class="ni ni-laptop text-info"></i> Laboratorios
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ url('/appointments/attendant') }}">
        <i class="ni ni-calendar-grid-58 text-blue"></i> Solicitudes de Reservaciones
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ url('/appointments/attendant/accept') }}">
        <i class="ni ni-calendar-grid-58 text-green"></i> Reservaciones Aceptadas
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ url('/appointments/attendant/reject') }}">
        <i class="ni ni-calendar-grid-58 text-red"></i> Reservaciones Rechazadas
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ url('/appointments/attendant/finish') }}">
        <i class="ni ni-calendar-grid-58 text-yellow"></i> Reservaciones Finalizadas
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('attendant.logout') }}"
        onclick="event.preventDefault(), document.getElementById('formLogout'). submit();">
        <i class="ni ni-key-25 "></i> Cerrar sesión
    </a>
    <form action="{{ route('attendant.logout') }}" method="POST" style="display: none" id="formLogout">
        @csrf
    </form>
</li>
