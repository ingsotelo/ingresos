@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Bienvenido  {{ Auth::user()->full_name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>
                        A través de este sistema y con el uso de la e.firma, usted podrá darse de alta, baja, realizar trámites, pagos, presentar declaraciones y visualizar sus estados de cuenta de los siguientes Impuestos:
                    </p>
                    <ul>
                        <li>Impuesto Sobre Remuneración al Trabajo Personal (2 % Sobre Nómina)</li>
                        <li>Impuesto Sobre Automóviles Nuevos</li>
                        <li>Impuesto Sobre Diversiones y Espectaculos</li>
                        <li>Impuesto Cedular a los Ingresos por Arrendamiento</li>
                        <li>Impuesto Sobre el Ejercicio de la Profesión Médica</li>
                    </ul>
                    <p>Por razones de seguridad, este sistema finalizará su sesión si no detecta una sola acción en un período de 5 minutos.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
