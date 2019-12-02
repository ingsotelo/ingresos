@extends('layouts.app')

@section('styles')
<style type="text/css">

</style>
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header  text-center text-white bg-success">Alta, Reanudación, Baja o Suspensión al Impuesto Sobre Hospedaje</div>
                <div class="card-body">
                    
                    <div class="form-group row"> 
                      <div class="col-md-6">
                        <label for="alta" class="col-form-label">{{ __('Fecha de Alta:') }}</label>
                        <input id="alta" type="date" class="form-control" name="alta" value="{{$hoy}}" disabled>
                      </div>
                      <div class="col-md-6">
                        <label for="inicio" class="col-form-label">{{ __('Fecha de Causación:') }}</label>
                        <input id="inicio" type="date" class="form-control" name="inicio" required autocomplete="inicio" value="{{$hoy}}" autofocus>
                      </div>
                    </div>

                    <div class="form-group row"> 
                      <div class="col-md-6">
                        <label for="alta" class="col-form-label">{{ __('Fecha de Alta en el IMSS:') }}</label>
                        <input id="alta" type="date" class="form-control" name="alta" value="{{$hoy}}">
                      </div>
                      <div class="col-md-6">
                        <label for="inicio" class="col-form-label">{{ __('Numero de Registro Patronal IMSS:') }}</label>
                        <input id="inicio" type="text" class="form-control" name="inicio" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-12"> 
                        <label for="cer" class="col-form-label">{{ __('Aviso de Registro Patronal ante el IMSS:') }}</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="cer" name="cer" accept=".pdf" autofocus>
                          <label class="custom-file-label" id="cer_label" for="cer">Documento Electronico en PDF</label>
                        </div>    
                      </div>  
                    </div>

                    <div class="form-group row">
                      <div class="col-md-12"> 
                        <label for="cer" class="col-form-label">{{ __('Firma tu inscripcion con tu FIEL:') }}</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="cer" name="cer" accept=".cer" autofocus>
                            <label class="custom-file-label" id="cer_label" for="cer">Archivo .CER</label>
                          </div>
                      </div>  
                    </div>

                    <div class="form-group row">
                      <div class="col-md-12"> 
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="cer" name="cer" accept=".key" autofocus>
                          <label class="custom-file-label" id="cer_label" for="cer">Archivo .KEY</label>
                        </div> 
                      </div>  
                    </div>

                    <div class="form-group row">
                      <div class="col-md-12"> 
                        <input id="password_fiel" type="password" class="form-control" name="password__fiel" placeholder="Contraseña FIEL">
                      </div>
                    </div>

                    <div class="form-group row mb-0">
                      <div class="col-md-6">
                        <button class="btn btn-primary" id="btn_send">
                          {{ __('Firmar y Registrar') }}
                        </button>
                        <a class="btn btn-primary" href="{{ route('nomina') }}" role="button">
                          {{ __('Cancelar') }}
                        </a>
                      </div>  
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
</script>
@endsection
