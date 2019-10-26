<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ingresos</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Entrar</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Regístrate</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Ingresos
                </div>
                <div>
                    <p>Esta es una plataforma tecnológica, mediante la cual el contribuyente puede administrar</p>
                    <p>lo correspondiente a sus contribuciones estatales, mediante el uso de la e.firma vigente</p>
                    <p>tramitada previamente ante el Sistema de Administración Tributaria (SAT).</p>
                </div>

                <div class="links">
                    <a href="#">Manual de Usuario</a>
                    <a href="https://www.gob.mx/cms/uploads/attachment/file/445443/Aviso_INTEGRAL_Coordinacion_DGEP_00.pdf">Política de Privacidad</a>
                    <a href="#">Contacto</a>
                </div>
            </div>
        </div>
    </body>
</html>
