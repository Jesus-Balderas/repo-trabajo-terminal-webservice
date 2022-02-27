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
    <a class="nav-link" href="#">
        <i class="ni ni-time-alarm text-success"></i> Mis horarios de tiempo libre
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="ni ni-calendar-grid-58 text-red"></i> Reservaciones
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
