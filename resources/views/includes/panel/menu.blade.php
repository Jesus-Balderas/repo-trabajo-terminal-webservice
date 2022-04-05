<!-- Navigation -->
<h6 class="navbar-heading text-muted">
    @if(Auth::guard('web')->check())
        Gestionar datos
    @else
        Menú
    @endif
    
</h6>
<ul class="navbar-nav">

    @if(Auth::guard('web')->check())

        @include('includes.panel.menu.user')

    @elseif(Auth::guard('student')->check())

        @include('includes.panel.menu.student')

    @else

        @include('includes.panel.menu.attendant')
        
    @endif
    
</ul>

@if (Auth::guard('web')->check())
    <!-- Divider -->
    <hr class="my-3">

    <!-- Heading -->
    <h6 class="navbar-heading text-muted">Reportes</h6>

    <!-- Navigation -->
    <ul class="navbar-nav mb-md-3">
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="ni ni-sound-wave text-yellow"></i> Frecuencia de Reservaciones
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="ni ni-spaceship text-red"></i> Laboratorios más activos
            </a>
        </li>
    </ul>
@endif
