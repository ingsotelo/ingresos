@extends('layouts.app')
@section('styles')
<style type="text/css">
 .credit-card-div  span { padding-top:10px; }
.credit-card-div img { padding-top: 22px; }
.credit-card-div .small-font { font-size:9px; }
.credit-card-div .pad-adjust { padding-top:10px; }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="card">
              <div class="card-header text-center text-white bg-success">
               Notificaciones
              </div>
              <div class="card-body">
                  <div class="form-group row">
                    <div class="col-md-1"><p>#</p></div>
                    <div class="col-md-3"><p>Fecha</p></div>
                    <div class="col-md-4"><p>Notificacion</p></div>
                    
                    <div class="col-md-4"><p>Documento</p></div>
                  </div>

                  @foreach ($notificaciones as $notificacion)

                  <div class="form-group row">
                    <div class="col-md-1"><p>{{ $notificacion->id }}</p></div>
                    <div class="col-md-3"><p>{{ $notificacion->created_at }}</p></div>
                    <div class="col-md-4"><p>{{ $notificacion->nombre }}</p></div>
                    <div class="col-md-4"><a href='getpdf'>Download</a></div>


                  </div>
                
                 @endforeach
              
                  
                  
                  <div class="form-group row mb-0">
                    <div class="col-md-6">
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
