<header>

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark mdb-color darken-3 scrolling-navbar">
        <div class="container">
            <a class="navbar-brand text-uppercase" href="#"><strong>Aguap Admin</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                </ul>
                <ul class="navbar-nav nav-flex-icons">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{request()->is('administracion/pedidos*') ?  'active' : ''}}">
                        <a class="nav-link" href="{{asset('administracion/pedidos')}}">Pedidos</a>
                    </li>
                    <li class="nav-item {{request()->is('administracion/proveedores*') ?  'active' : ''}}" >
                        <a class="nav-link" href="{{asset('administracion/proveedores')}}">Proveedores</a>
                    </li>
                    <li class="nav-item {{request()->is('administracion/insumos*') ?  'active' : ''}}" >
                        <a class="nav-link" href="{{asset('administracion/insumos')}}">Insumos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            {{Auth::user()->name.' '.Auth::user()->lastName}}
                            <i class="fas fa-chevron-down"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>

</header>
