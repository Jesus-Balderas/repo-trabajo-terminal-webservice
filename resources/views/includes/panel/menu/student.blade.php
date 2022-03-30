<li class="nav-item">
    <a class="nav-link" href="{{ route('student.home') }}">
        <i class="ni ni-tv-2 text-primary"></i> Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('/laboratories') }}">
        <i class="ni ni-laptop text-info"></i> Laboratorios
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('appointments.create') }}">
        <i class="ni ni-send text-blue"></i> Registrar Reservación
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('/appointments/student') }}">
        <i class="ni ni-calendar-grid-58 text-blue"></i> Mis Solicitudes de Reservaciones
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('/appointments/student') }}">
        <i class="ni ni-calendar-grid-58 text-yellow"></i> Mis Reservaciones Canceladas
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('/appointments/student') }}">
        <i class="ni ni-calendar-grid-58 text-green"></i> Mis Reservaciones Aceptadas
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('/appointments/student') }}">
        <i class="ni ni-calendar-grid-58 text-red"></i> Mis Reservaciones Rechazadas
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('/appointments/student') }}">
        <i class="ni ni-calendar-grid-58 text-orange"></i> Mis Reservaciones Finalizadas
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('student.logout') }}"
        onclick="event.preventDefault(), document.getElementById('formLogout'). submit();">
        <i class="ni ni-key-25 "></i> Cerrar sesión
    </a>
    <form action="{{ route('student.logout') }}" method="POST" style="display: none" id="formLogout">
        @csrf
    </form>
</li>