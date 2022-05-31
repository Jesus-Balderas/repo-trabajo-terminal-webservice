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

