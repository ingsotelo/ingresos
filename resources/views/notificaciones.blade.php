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
                <div class="table-responsive">
                  <table class="table table-striped">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">Id</th>
                              <th scope="col">Fecha</th>
                              <th scope="col">Notificacion</th>
                              <th scope="col">Documento</th>
                            </tr>
                          </thead>
                          @foreach ($notificaciones as $notificacion)
                          <tbody>
                            <tr>
                              <th scope="row">{{ $notificacion->id }}</th>
                              <td>{{ $notificacion->created_at }}</td>
                              <td>{{ $notificacion->nombre }}</td>
                              <td><a href="{{route('getpdf', str_replace('/', '%', $notificacion->documento))}}"><i class="fas fa-file-download"></i> Descargar Documento Electronico</a></td>
                            </tr>
                          </tbody>
                          @endforeach
                  </table>
                </div>
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
