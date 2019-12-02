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
                Estados de Cuenta del Impuesto Sobre Hospedaje
              </div>
              <div class="card-body">
                  <div class="form-group row">
                    <table class="table-responsive table-sm table-striped">
                      <thead>
                        <tr>
                          <th scope="col">Periodo</th>
                          <th scope="col">Remuneraciones</th>
                          <th scope="col">Trabajadores</th>
                          <th scope="col">Impuestos</th>
                          <th scope="col">Recargos</th>
                          <th scope="col">Declaracion</th>
                          <th scope="col">Estado</th>
                          <th scope="col">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">2019-09</th>
                          <td>$0.00</td>
                          <td>0</td>
                          <td>$0.00</td>
                          <td>$0.00</td>
                          <td>Normal</td>
                          <td><span class="badge badge-success">Pagado 2019-10-05</span></td>
                          <td><a href="{{asset('recibo.pdf')}}">Descargar Recibo</a></td>
                        </tr>
                        <tr>
                          <th scope="row">2019-10</th>
                          <td>$5697.08</td>
                          <td>2</td>
                          <td>$113.94</td>
                          <td>$11.39</td>
                          <td>Normal</td>
                          <td><span class="badge badge-danger">Vencido</span></td>
                          <td><a href="#" data-toggle="modal" data-target="#myModal">Pagar Impuestos</a></td>
                        </tr>
                        <tr>
                          <th scope="row">2019-11</th>
                          <td>$5697.08</td>
                          <td>2</td>
                          <td>$113.94</td>
                          <td>$0.00</td>
                          <td>Normal</td>
                          <td><span class="badge badge-warning">Vigente</span></td>
                          <td><a href="#" data-toggle="modal" data-target="#myModal">{{ __('Pagar Impuestos') }}</a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  
                  <div class="form-group row mb-0">
                    <div class="col-md-6">
                      <button class="btn btn-primary" id="btn_send">
                        {{ __('Aclaracion') }}
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
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">  
        <!-- Modal content-->
        <div class="modal-content"> 
          <div class="modal-header">
            <h5 class="modal-title">Pagar Impuestos.</h5>
          </div>
          <div class="modal-body">
            <form action="#" class="credit-card-div">
              <div class="panel panel-default" >
                <div class="panel-heading">
                  <div class="row ">
                    <div class="col-md-12">
                      <input type="text" class="form-control" placeholder="Numero de Tarjeta" />
                    </div>
                  </div>
                  <div class="row ">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <span class="help-block text-muted small-font" > Mes</span>
                      <input type="text" class="form-control" placeholder="MM" />
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <span class="help-block text-muted small-font" >  Año</span>
                      <input type="text" class="form-control" placeholder="YY" />
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <span class="help-block text-muted small-font" >  CCV</span>
                      <input type="text" class="form-control" placeholder="CCV" />
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <img src="{{asset('/img/tc.png')}}" class="img-rounded" />
                    </div>
                  </div>   
                  <div class="row ">
                    <div class="col-md-12 pad-adjust">
                      <input type="text" class="form-control" placeholder="Nombre del Titular" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 pad-adjust">
                    </div>
                  </div>
                  <div class="row ">
                    <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                      <input type="submit"  class="btn btn-warning btn-block" value="PAGAR AHORA" />
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <a href="{{asset('Referenciado.pdf')}}">Generar Pago Referenciado</a>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
</div>
@endsection
@section('scripts')
<script type="text/javascript">
</script>
@endsection
