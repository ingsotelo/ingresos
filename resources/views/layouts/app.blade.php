<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ingresos') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6f68a0fafd.js" crossorigin="anonymous"></script>

    <!-- Styles -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style type="text/css">
        body {
            background: linear-gradient(50deg, #006231, hsla(179,54%,76%,1));
        }
        
    </style>
    @yield('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Ingresos') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Acceder') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Regístrate') }}</a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   {{ __(' DERECHOS ') }}<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="#">
                                        <i class="far fa-file-alt"></i>{{ __(' Constancia de no Inhabilitacion') }}
                                    </a>
                                    <a class="dropdown-item" href="https://www.gob.mx/ActaNacimiento/" target="_blank">
                                        <i class="far fa-file-alt"></i>{{ __(' Acta de nacimiento') }}
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   {{ __(' IMPUESTOS ') }}<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="{{ route('nomina') }}">
                                        <i class="fas fa-users"></i>{{ __(' Sobre Nómina.') }}
                                    </a>

                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-hotel"></i>{{ __(' Sobre Hospedaje.') }}
                                    </a>

                                    
                                </div>
                            </li>
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="{{ route('notificaciones') }}">
                                        <i class="far fa-envelope"></i>{{ __(' Notificaciones ') }}<span class="badge badge-info">0</span>
                                    </a>

                                    <a class="dropdown-item" href="{{ route('perfil') }}">
                                        <i class="far fa-address-card"></i>{{ __(' Perfil del Contribuyente ') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>{{ __(' Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
            <div>   
                <img src="{{ asset('img/PlecaTejidos.jpg') }}" class="img-responsive" id = "img_pleca" style=" width: 100%; height:40px ; display:block; margin:0px; margin-top: 30px;">

                <p style="width: 100%;background: #006231;text-align: center;display: inline-block;margin: 0px; padding: 15px 0px; color:white;"> 
                    <a target="_blank" href="http://www.prospectiva-xxi.com.mx" style="color: white;">La Subsecretaría de Ingresos de la Secretaría de Finanzas y Administración del Gobierno del Estado de Guerrero.</a> <br> Derechos reservados © Gobierno del Estado de Guerrero 2015-2021.
                    <ul  style="width: 100%; background: #006231;text-align: center;display: inline-block;margin: 0px;padding: 15px 0px; ">                    
                        <li style="display: inline;">
                            <a href="mailto:soporte@portal.guerrero.gob.mx" style="color: white;"> 
                                <i class="fa fa-envelope-square fa-2x"></i>
                            </a>
                        </li>

                        <li style="display: inline;"> 
                            <a target="_blank" href="https://www.facebook.com/AstudilloFloresHector" style="color: white;"> 
                                <i class="fab fa-facebook-square fa-2x"></i>
                            </a>
                        </li>

                        <li style="display: inline;"> 
                            <a target="_blank" href="https://twitter.com/HectorAstudillo" style="color: white;"> 
                                <i class="fab fa-twitter-square fa-2x"></i> 
                            </a>
                        </li>

                        <li style="display: inline;"> 
                            <a target="_blank" href="https://www.youtube.com/channel/UCMgwbpKbXhzeXyZ4l_DvU3g" style="color: white;"> 
                                <i class="fab fa-youtube-square fa-2x"></i>
                            </a>
                        </li>
                    </ul>
                </p>

            </div>
        
    </div>
@yield('scripts') 
</body>
</html>
