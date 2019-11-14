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
                <div class="card-header  text-center text-white bg-success">Declaración del Impuesto Sobre Remuneración al Trabajo Personal</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr class="table-secondary">
                              <td style="width:50%;">RFC:</td>
                              <td style="width:50%;">{{ Auth::user()->name }}</td>
                            </tr>
                            <tr>
                              <td style="width:50%;">Nombre o Razon Social:</td>
                              <td style="width:50%;">{{ Auth::user()->full_name }}</td>
                            </tr>
                            <tr class="table-secondary">
                              <td style="width:50%;">Fecha de Alta en el Padron:</td>
                              <td style="width:50%;">{{ Auth::user()->created_at }}</td>
                            </tr>
                            <tr>
                              <td style="width:50%;">Fecha de Causacion:</td>
                              <td style="width:50%;">{{ Auth::user()->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>

                    <div class="form-group row"> 
                        <div class="col-md-6">
                            <label for="ejercicio" class="col-form-label">{{ __('Ejercicio:') }}</label>
                            <select id="ejercicio" class="form-control @error('ejercicio') is-invalid @enderror" required>
                                <option>2019</option>
                                <option>2018</option>
                                <option>2017</option>
                                <option>2016</option>
                            </select>
                            @error('ejercicio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="periodo" class="col-form-label">{{ __('Periodo:') }}</label>
                            <select id="periodo" class="form-control @error('periodo') is-invalid @enderror" required>
                                <option>enero</option>
                                <option>febrero</option>
                                <option>marzo</option>
                                <option>abril</option>
                                <option>mayo</option>
                                <option>junio</option>
                                <option>julio</option>
                                <option>agosto</option>
                                <option>septiembre</option>
                                <option>octubre</option>
                                <option>noviembre</option>
                                <option>diciembre</option>
                            </select>
                            @error('periodo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="bg-light">
                    <hr>
<!--<form  action="{{ route('xmlsat') }}" method="POST">
@csrf
<input type="hidden" value="{{$sesionStr}}" name="sesionStr" />-->
                                 
                    <div class="form-group row">         
                        <div class="col-md-3">
                                <label for="periodo" class="col-form-label">{{ __('Ingrese Ciec:') }}</label>
                                <input id="ciec" name="ciec" type="password" class="form-control">
                        </div>
                        
                        <div class="col-md-3">
                                <label for="periodo" class="col-form-label">{{ __('Ingrese captcha:') }}</label>
                                <input id="captcha" name="captcha" type="text" class="form-control">
                        </div>
                        
                        <div class="col-md-3">
                                <img id="image" id="image" src="data:image/jpeg;base64,{{$imagenBase64}}" style="margin-top: 20px">
                        </div>
                        <div class="col-md-3">
<!--<button type="submit" class="btn btn-primary">
    {{ __('Consultar SAT') }}
</button>-->
                           <button type="button" class="btn btn-outline-primary btn-sm" id="btn_sat" style="margin-top: 35px">
                                {{ __('Consultar SAT') }}
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive bg-light" id="data"> 
                    </div>

                    <hr>
                    </div>
<!--</form>-->
          

                    <div class="form-group row"> 
                        <div class="col-md-6">
                            <label for="trabajadores" class="col-form-label">{{ __('Numero de Trabajadores:') }}</label>
                            <input id="trabajadores" type="number" class="form-control">
                                <span class="invalid-feedback" role="alert" >
                                    <strong>El numero de trabajadores no puede ser menor a 0</strong>
                                </span>
                        </div>

                        <div class="col-md-6">
                            <label for="total" class="col-form-label">{{ __('Total de Remuneraciones:') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="total" type="number" class="form-control">
                                <span class="invalid-feedback" role="alert">
                                    <strong>El total no puede ser menor a $0.00</strong>
                                </span>
                            </div>
                                
                        </div>
                    </div>

                    <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr class="table-secondary">
                              <td style="width:50%;">Tasa:</td>
                              <td style="width:50%;" align="right">2%</td>
                            </tr>
                            <tr>
                              <td style="width:50%;">Total de Remuneraciones:</td>
                              <td style="width:50%;" align="right" id="remuneraciones">0.00</td>
                            </tr>
                            <tr class="table-secondary">
                              <td style="width:50%;">Impuesto:</td>
                              <td style="width:50%;" align="right" id="impuestos">0.00</td>
                            </tr>
                            <tr>
                              <td style="width:50%;">Recargos:</td>
                              <td style="width:50%;" align="right">0.00</td>
                            </tr>
                            <tr class="table-secondary">
                              <td style="width:50%;">Total a Pagar:</td>
                              <td style="width:50%;" align="right" id="pagar">0.00</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>

                    <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <button class="btn btn-primary" id="btn_send">
                                    {{ __('Enviar Declaracion') }}
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var sesionStr = "{{$sesionStr}}";
    
    $("#btn_sat").click(function(e){

        e.preventDefault();  
        var ciec = $("#ciec").val();
        var captcha = $("#captcha").val();  
        var ejercicio = $("#ejercicio").val();
        var periodo = $("#periodo").val();
        var rfcStr = "{{Auth::user()->name}}";
        
        console.log(ciec+" "+captcha+" "+ejercicio+" "+periodo+" "+rfcStr);
        Swal.fire({
            title: 'Consultando en el SAT',
            html: 'Espere un momento.',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });

        $.ajax({
            type:'POST',
            url:'/xmlsat',
            data:{ciec:ciec, captcha:captcha, sesionStr:sesionStr, ejercicio:ejercicio, periodo:periodo,rfcStr:rfcStr},
            success:function(data){
                if(!data.hasOwnProperty('error')){

                    var noOfData = data.length;
                    document.getElementById("trabajadores").value = noOfData;
                    var table = document.createElement("table");
                    table.classList.add("table");
                    table.setAttribute('border', '1');
                    table.setAttribute('cellspacing', '0');
                    table.setAttribute('cellpadding', '5');

                    var col = []; 
                    for (var i = 0; i < noOfData; i++) {
                        for (var key in data[i]) {
                            if (col.indexOf(key) === -1) {
                                col.push(key);
                            }
                        }
                    }
                    
                    var tHead = document.createElement("thead");    
                        
                    var hRow = document.createElement("tr");
                    
                    for (var i = 0; i < col.length; i++) {
                            var th = document.createElement("th");
                            th.innerHTML = col[i];
                            hRow.appendChild(th);
                    }

                    hRow.classList.add("table-success");
                    tHead.appendChild(hRow);
                    table.appendChild(tHead);
                    
                    var tBody = document.createElement("tbody");    
                    var total = 0;
                    for (var i = 0; i < noOfData; i++) {
                    
                            var bRow = document.createElement("tr"); 
                            
                            for (var j = 0; j < col.length; j++) {
                                var td = document.createElement("td");
                                td.innerHTML = data[i][col[j]];
                                if(j==3) total = total + parseFloat(data[i][col[j]]);
                                bRow.appendChild(td);
                            }

                            tBody.appendChild(bRow)

                    }
                    table.appendChild(tBody);   
                    var divContainer = document.getElementById("data");
                    divContainer.innerHTML = "";
                    divContainer.appendChild(table);
                    document.getElementById("ciec").disabled = true;
                    document.getElementById("captcha").disabled = true; 
                    document.getElementById("btn_sat").disabled = true;
                    document.getElementById("ejercicio").disabled = true;
                    document.getElementById("periodo").disabled = true;
                    document.getElementById("total").value = total;
                    recargos = 0;
                    impuestos = total * .02;
                    impuestos = parseFloat(impuestos).toFixed(2);
                    pagar = recargos + impuestos;
                    pagar = parseFloat(pagar).toFixed(2);
                    document.getElementById('pagar').innerHTML = pagar;
                    document.getElementById('impuestos').innerHTML = impuestos ;
                    document.getElementById('remuneraciones').innerHTML = total;
                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Operacion Exitosa',
                        text: 'Se recuperaron '+data.length+' recibos de nomina.',
                        showCloseButton: true,
                    });
                }else{
                    document.getElementById("image").src = "data:image/jpeg;base64,"+data['imagenBase64'];
                    sesionStr = data['sesionStr'];
                    document.getElementById("ciec").value = "";
                    document.getElementById("captcha").value = "";
                    Swal.fire({
                        icon: 'error',
                        text: data['error'],
                        showCloseButton: true,
                    });
                }
            }
        });
    });

    $("#total").change(function(){
                    total = document.getElementById("total").value;
                    recargos = 0;
                    impuestos = total * .02;
                    impuestos = parseFloat(impuestos).toFixed(2);
                    pagar = recargos + impuestos;
                    pagar = parseFloat(pagar).toFixed(2);

                    document.getElementById('pagar').innerHTML = pagar;
                    document.getElementById('impuestos').innerHTML = impuestos ;
                    document.getElementById('remuneraciones').innerHTML = total;
    });

    $("#btn_send").click(function(e){
        total = document.getElementById("total").value;
        trabajadores = document.getElementById("trabajadores").value;
        document.getElementById("total").classList.remove("is-invalid");
        document.getElementById("trabajadores").classList.remove("is-invalid");
        if (total==="" || total < 0) {
            document.getElementById("total").classList.add("is-invalid");            
            document.getElementById("total").focus();
        }else if(trabajadores==="" || trabajadores < 0){
            document.getElementById("trabajadores").classList.add("is-invalid");
            document.getElementById("trabajadores").focus();
        }else{
            Swal.fire({
              title: 'Esta seguro de enviar la declaracion?',
              text: "Tendra que pagar un Total de: $"+document.getElementById('pagar').innerHTML,
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, enviar declaracion.',
              cancelButtonText: 'Cancelar'
            }).then((result) => {
              if (result.value) {
                Swal.fire(
                  'Eviado',
                  'Su declaracion fue enviada. Puede encontrar el detalle en su estado de cuenta para realizar el pago.',
                  'success'
                ).then((result) => {
                    window.location.replace("{{ route('nomina') }}");
                })
                
              } else if (
                result.dismiss === Swal.DismissReason.cancel
              ) {
                Swal.fire(
                  'Cancelado',
                  'Se cancelo el envio de la declaracion.',
                  'error'
                );
              }
            });
        }
    });

</script>
@endsection
