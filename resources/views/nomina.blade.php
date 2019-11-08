@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Impuesto Sobre Remuneración al Trabajo Personal</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>2 % Sobre Nómina</h3>
                    <hr>
                    <p><b>Cumplir con la obligación fiscal referente a la inscripción y pago  del impuesto sobre nómina que realiza respecto al personal a su cargo dentro del territorio del Estado de Guerrero.</b></p>

                    <div class="form-group row justify-content-center">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-success btn-lg btn-block">
                                {{ __('Alta, Reanudación, Baja o Suspensión') }}
                            </button>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-md-8">
                            <a href="{{ route('nomina_declaracion') }}" class="btn btn-success btn-lg btn-block" role="button">{{ __('Declaraciones Mensuales') }} </a>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-md-8">
                            <a href="{{ route('nomina_edoscta') }}"  class="btn btn-success btn-lg btn-block" role="button">
                                {{ __('Estados de Cuenta') }}
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
