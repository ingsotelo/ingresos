@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Bienvenido  {{ Auth::user()->full_name }}</div>

                <div class="card-body shadow">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>
                        A través de este sistema y con el uso de la e.firma, usted podrá darse de alta, baja, realizar trámites, pagos, presentar declaraciones y visualizar sus estados de cuenta de los siguientes Impuestos:
                    </p>
                    <ul>
                        <li>
                            <a href="{{ route('nomina') }}">
                            {{ __(' Impuesto Sobre Remuneración al Trabajo Personal (2 % Sobre Nómina).') }}
                            </a>
                        </li>
                        <li> 
                            <a href="#">
                            {{ __(' Impuesto Sobre Prestaciones y Servicos de Hospedaje.') }}
                            </a>
                        </li>
                    </ul>
                    <p>Por razones de seguridad, este sistema finalizará su sesión si no detecta una sola acción en un período de 5 minutos.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
