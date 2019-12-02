@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bienvenido  {{ Auth::user()->full_name }}</div>

                <div class="card-body shadow">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>
                        A través de este sistema y con el uso de la e.firma, usted podrá darse de alta, baja, realizar trámites, pagos, presentar declaraciones y visualizar los estados de cuenta de sus contribuciones estatales.
                    </p>


                    <table class="table">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Impuesto registrado</th>
                              <th scope="col">Estado de la cuenta</th>
                              <th scope="col">Próxima declaración</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="table-success">
                              <th scope="row">1</th>
                              <td><a href="{{ route('nomina') }}">{{__('Impuesto Sobre Remuneración al Trabajo Personal')}}</a></td>
                              <td><a href="{{ route('nomina_edoscta') }}">Cuenta al corriente</a></td>
                              <td><a href="{{ route('nomina_declaracion') }}">17 de Diciembre de 2019</a></td>
                            </tr>
                            <tr class="table-danger">
                              <th scope="row">2</th>
                              <td><a href="{{ route('hospedaje') }}">{{__('Impuesto Sobre Prestaciones y Servicos de Hospedaje')}}</a></td>
                              <td><a href="{{ route('hospedaje_edoscta') }}">Cuenta vencida</a></td>
                              <td><a href="{{ route('hospedaje_declaracion') }}">17 de Diciembre de 2019</a></td>
                            </tr>
                            <tr class="table-success">
                              <th scope="row">3</th>
                              <td><a href="{{ route('nomina') }}">{{__('Tenencia Mazda 3 2018 Placas HFN514A')}}</a></td>
                              <td><a href="{{ route('nomina_edoscta') }}">Cuenta al corriente</a></td>
                              <td><a href="{{ route('nomina_declaracion') }}">01 de Enero de 2020</a></td>
                            </tr>
                          </tbody>
                    </table>

                    <p>Por razones de seguridad, este sistema finalizará su sesión si no detecta una sola acción en un período de 5 minutos.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
