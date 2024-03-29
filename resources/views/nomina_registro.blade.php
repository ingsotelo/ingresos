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
                <div class="card-header  text-center text-white bg-success">Alta, Reanudación, Baja o Suspensión al Impuesto Sobre Nomina</div>
                <div class="card-body">
                  <form id="upload_form" method="post"  enctype="multipart/form-data">
                  
                    @csrf
                    <div class="form-group row"> 
                      <div class="col-md-6">
                        <label for="alta" class="col-form-label">{{ __('Fecha de Alta:') }}</label>
                        <input id="alta" type="date" class="form-control" name="alta" value="{{$hoy}}" readonly>
                      </div>
                      <div class="col-md-6">
                        <label for="inicio" class="col-form-label">{{ __('Fecha de Causación:') }}</label>
                        <input id="inicio" type="date" class="form-control" name="inicio" required autocomplete="inicio" value="{{$hoy}}" autofocus>
                      </div>
                    </div>

                    <div class="form-group row"> 
                      <div class="col-md-6">
                        <label for="fimss" class="col-form-label">{{ __('Fecha de Alta en el IMSS:') }}</label>
                        <input id="fimss" type="date" class="form-control" name="fimss" value="{{$hoy}}">
                      </div>
                      <div class="col-md-6">
                        <label for="regimss" class="col-form-label">{{ __('Numero de Registro Patronal IMSS:') }}</label>
                        <input id="regimss" type="text" class="form-control" name="regimss" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-12"> 
                        <label for="imss" class="col-form-label">{{ __('Aviso de Registro Patronal ante el IMSS:') }}</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="imss" name="imss" accept=".pdf" autofocus>
                          <label class="custom-file-label" id="imss_label" for="imss">Documento Electronico en PDF</label>
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
                          <input type="file" class="custom-file-input" id="key" name="key" accept=".key" autofocus>
                          <label class="custom-file-label" id="cer_label" for="key">Archivo .KEY</label>
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
                        <button class="btn btn-primary" type="submit">
                          {{ __('Firmar y Registrar') }}
                        </button>
                        <a class="btn btn-primary" href="{{ route('nomina') }}" role="button">
                          {{ __('Cancelar') }}
                        </a>
                      </div>  
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
     $('#upload_form').on('submit', function(event){
        event.preventDefault();  
        Swal.fire({
          title: 'Guardando Perfil',
          html: 'Espere un momento.',
          onBeforeOpen: () => {Swal.showLoading();},
        });

        $.ajax({
          type:'POST',
          url: "{{ route('saveRegistro') }}",                     
          data:new FormData($("#upload_form")[0]),
          dataType:'json',
          async:false,
          processData: false,
          contentType: false,
          success:function(response){
            console.log(response.message);
            console.log(response.errors);
          }
          });                    
          
          Swal.close();

          Swal.fire({
            icon: 'success',
            title: 'Operacion Exitosa',
            text: 'Su perfil esta actualizado.',
            showCloseButton: true,
          }).then((result) => {
            window.location.href = "{{ route('home') }}";
          });
      });
  });
</script>
@endsection
