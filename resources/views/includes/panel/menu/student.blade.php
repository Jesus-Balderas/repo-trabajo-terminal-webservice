<li class="nav-item">
    <a class="nav-link" href="{{ route('student.home') }}">
        <i class="ni ni-tv-2 text-primary"></i> Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="ni ni-hat-3 text-blue"></i> Mis reservaciones
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="ni ni-hat-3 text-blue"></i> Hacer una reservación
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
    <a class="nav-link" href="{{ route('student.logout') }}"
        onclick="event.preventDefault(), document.getElementById('formLogout'). submit();">
        <i class="ni ni-key-25 "></i> Cerrar sesión
    </a>
    <form action="{{ route('student.logout') }}" method="POST" style="display: none" id="formLogout">
        @csrf
    </form>
</li>