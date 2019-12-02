@extends('layouts.app')

@section('styles')
<style type="text/css">

</style>
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header  text-center text-white bg-success">
              Registro del Perfil del Contribuyente
              </div>
                <div class="card-body">
                  @if(isset($perfil))
                      <div class="row mb-3">
                        <div class="col-md-4">
                          Nombre: <b>{{ $perfil->nombre }}</b>
                        </div>
                        <div class="col-md-4">
                          Apellido Paterno: <b> {{ $perfil->paterno }} </b>
                        </div>
                        <div class="col-md-4">
                          Apellido Materno: <b> {{ $perfil->materno }} </b>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <div class="col-md-4">
                          RFC: <b> {{ $user->name }} </b>
                        </div>
                        <div class="col-md-4">
                          CURP: <b> {{ $user->curp }} </b>
                        </div>
                        <div class="col-md-4">
                          Correo: <b> {{ $user->email }} </b>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <div class="col-md-6">
                          Actividad Economica: <b> {{ $actividad }} </b>
                        </div>
                        <div class="col-md-6">
                          Municipio: <b> {{ $codigo->municipio }} </b>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <div class="col-md-4">
                          Ciudad: <b> {{ $codigo->ciudad }} </b>
                        </div>
                        <div class="col-md-4">
                          Colonia: <b> {{ $codigo->colonia }} </b>
                        </div>
                        <div class="col-md-4">
                          Codigo Postal: <b> {{ $codigo->codigo }} </b>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <div class="col-md-4">
                          calle: <b> {{ $perfil->calle }} </b>
                        </div>
                        <div class="col-md-4">
                          Numero: <b> {{ $perfil->exterior }} - {{ $perfil->interior }}</b>
                        </div>
                        <div class="col-md-4">
                          Telefonos: <b> {{ $perfil->fijo }} / {{ $perfil->movil }} </b>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <div class="col-md-4">
                          <a href="{{route('perfilDownload', $user->name)}}">Constancia de registro.</a>
                        </div>
                        <div class="col-md-4">
                          <a href="{{route('constanciaDownload', $user->name)}}">Constancia de Situacion Fiscal SAT.</a>
                        </div>
                        <div class="col-md-4">
                          <a href="{{route('comprobanteDownload', $user->name)}}">Comprobante de Domicilio.</a>
                        </div>
                      </div>

                      <div class="form-group row mb-0">
                        <div class="col-md-6">
                          <a class="btn btn-primary" href="{{ route('home') }}" role="button">
                            {{ __('Cancelar') }}
                          </a>
                        </div>  
                      </div>



                  @else
                    <form id="upload_form" method="post"  enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row"> 
                        <div class="col-md-4">
                          <label for="rfc" class="col-form-label">{{ __('RFC:') }}</label>
                          <input id="rfc" type="text" class="form-control" name="rfc"  value="{{ Auth::user()->name }}" readonly>
                        </div>
                        <div class="col-md-4">
                          <label for="curp" class="col-form-label">{{ __('CURP:') }}</label>
                          <input id="curp" type="text" class="form-control" name="curp" value="{{ Auth::user()->curp }}" disabled>
                        </div>
                        <div class="col-md-4">
                          <label for="correo" class="col-form-label">{{ __('Correo Electronico:') }}</label>
                          <input id="correo" type="text" class="form-control" name="correo" value="{{ Auth::user()->email }}" disabled>
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <div class="col-md-4">
                          <label for="nombre" class="col-form-label">{{ __('Nombre:') }}</label>
                          <input id="nombre" type="text" class="form-control" name="nombre">
                            <span class="invalid-feedback" role="alert" >
                              <strong>El nombre es requerido.</strong>
                            </span>
                        </div>
                        <div class="col-md-4">
                          <label for="paterno" class="col-form-label">{{ __('Apellido Paterno:') }}</label>
                          <input id="paterno" type="text" class="form-control" name="paterno">
                          <span class="invalid-feedback" role="alert" >
                              <strong>El apellido paterno es requerido.</strong>
                            </span>
                        </div>
                        <div class="col-md-4">
                          <label for="materno" class="col-form-label">{{ __('Apellido Materno:') }}</label>
                          <input id="materno" type="text" class="form-control" name="materno">
                          <span class="invalid-feedback" role="alert" >
                              <strong>El apellido materno es requerido.</strong>
                          </span>
                        </div>
                      </div>
                      <div class="form-group row"> 
                        <div class="col-md-6">
                          <label for="gpoactividad" class="col-form-label">{{ __('Grupo Actividad:') }}</label>
                          <select id="gpoactividad" class="form-control" name="gpoactividad">
                            <option disabled selected value> -- seleccione una opcion -- </option>
                            @foreach ($gpoactividades as $gpo)
                              <option value="{{$gpo->clave_gpoactividades}}">{{$gpo->descripcion}}</option>
                            @endforeach
                          </select>
                          <span class="invalid-feedback" role="alert" >
                              <strong>Seleccione el Grupo al que pertenece su Actividad Economica.</strong>
                          </span>
                        </div>
                        <div class="col-md-6">
                          <label for="subactividad" class="col-form-label">{{ __('Sub-Actividad:') }}</label>
                          <select id="subactividad" type="text" class="form-control" name="subactividad">
                          </select>
                          <span class="invalid-feedback" role="alert" >
                              <strong>Seleccione su Sub-Actividad Economica.</strong>
                          </span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label for="actividad" class="col-form-label">{{ __('Actividad Economica:') }}</label>
                          <select id="actividad" type="text" class="form-control" name="actividad">
                          </select>
                          <span class="invalid-feedback" role="alert" >
                              <strong>Seleccione su Actividad Economica Principal.</strong>
                          </span>
                        </div>
                        <div class="col-md-6"> 
                          <label for="fiscal" class="col-form-label">{{ __('Constancia de Situacion Fiscal:') }}</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fiscal" name="fiscal" accept=".pdf" autofocus>
                            <span class="invalid-feedback" role="alert" >
                              <strong>Seleccione el archivo en PDF de su Constancia.</strong>
                            </span>
                            <label class="custom-file-label" id="fiscal_label" for="fiscal">Documento Electronico en PDF</label>
                          </div>
                        </div>  
                      </div>
                      <div class="form-group row"> 
                        <div class="col-md-2">
                          <label for="codigo" class="col-form-label">{{ __('Codigo Postal:') }}</label>
                          <select id="codigo" class="form-control" name="codigo">
                            <option disabled selected value> -- seleccione -- </option>
                            @foreach ($codigos as $codigo)
                              <option value="{{$codigo->codigo}}">{{$codigo->codigo}}</option>
                            @endforeach
                          </select>
                          <span class="invalid-feedback" role="alert" >
                            <strong>El codigo postal es requerido.</strong>
                          </span>
                        </div>
                        <div class="col-md-5">
                          <label for="municipio" class="col-form-label">{{ __('Municipio:') }}</label>
                          <select id="municipio" type="text" class="form-control" name="municipio">
                          </select>
                            <span class="invalid-feedback" role="alert" >
                              <strong>El municipio es requerido.</strong>
                            </span>
                        </div>
                        <div class="col-md-5">
                          <label for="ciudad" class="col-form-label">{{ __('Ciudad:') }}</label>
                          <select id="ciudad" type="text" class="form-control" name="ciudad">
                          </select>
                            <span class="invalid-feedback" role="alert" >
                              <strong>La ciudad es requerida.</strong>
                            </span>
                        </div>
                      </div>
                      <div class="form-group row"> 
                       <div class="col-md-4">
                          <label for="colonia" class="col-form-label">{{ __('Colonia:') }}</label>
                          <select id="colonia" type="text" class="form-control" name="colonia">
                          </select>
                            <span class="invalid-feedback" role="alert" >
                              <strong>La colonia es requerida.</strong>
                            </span>
                        </div>

                        <div class="col-md-4">
                          <label for="calle" class="col-form-label">{{ __('Calle:') }}</label>
                          <input id="calle" type="text" class="form-control" name="calle">
                            <span class="invalid-feedback" role="alert" >
                              <strong>La calle es requerida.</strong>
                            </span>
                        </div>
                        <div class="col-md-2">
                          <label for="exterior" class="col-form-label">{{ __('Número Exterior:') }}</label>
                          <input id="exterior" type="text" class="form-control" name="exterior">
                            <span class="invalid-feedback" role="alert" >
                              <strong>El numero es requerido.</strong>
                            </span>
                        </div>
                        <div class="col-md-2">
                          <label for="interior" class="col-form-label">{{ __('Número Interior:') }}</label>
                          <input id="interior" type="text" class="form-control" name="interior">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-3">
                          <label for="fijo" class="col-form-label">{{ __('Teléfono Fijo:') }}</label>
                          <input id="fijo" type="text" class="form-control" name="fijo">
                        </div>
                        <div class="col-md-3">
                          <label for="movil" class="col-form-label">{{ __('Teléfono Móvil:') }}</label>
                          <input id="movil" type="text" class="form-control" name="movil">
                        </div>
                        <div class="col-md-6"> 
                          <label for="domicilio" class="col-form-label">{{ __('Comprobante de Domicilio:') }}</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="domicilio" name="domicilio" accept=".pdf" autofocus>
                            <span class="invalid-feedback" role="alert" >
                              <strong>Seleccione el archivo en PDF de su Comprobante.</strong>
                            </span>
                            <label class="custom-file-label" id="domicilio_label" for="domicilio">Documento Electronico en PDF</label>
                          </div>    
                        </div>  
                      </div>
                      <div class="form-group row">
                        <div class="col-md-12"> 
                          <label for="cer" class="col-form-label">{{ __('Firma tu inscripcion con tu FIEL:') }}</label>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="cer" name="cer" accept=".cer" autofocus>
                              <span class="invalid-feedback" role="alert" >
                              <strong>Seleccione el archivo CER de su FIEL.</strong>
                            </span>
                              <label class="custom-file-label" id="cer_label" for="cer">Archivo .CER</label>
                            </div>
                        </div>  
                      </div>
                      <div class="form-group row">
                        <div class="col-md-12"> 
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="key" name="key" accept=".key" autofocus>
                            <span class="invalid-feedback" role="alert" >
                              <strong>Seleccione el archivo KEY de su FIEL.</strong>
                            </span>
                            <label class="custom-file-label" id="key_label" for="key">Archivo .KEY</label>
                          </div> 
                        </div>  
                      </div>
                      <div class="form-group row">
                        <div class="col-md-12"> 
                          <input id="password_fiel" type="password" class="form-control" name="password__fiel" placeholder="Contraseña FIEL">
                          <span class="invalid-feedback" role="alert" >
                              <strong>Introduzca la Contraseña de su FIEL.</strong>
                          </span>
                        </div>
                      </div>
                      <div class="form-group row mb-0">
                        <div class="col-md-6">
                          <button type="submit" class="btn btn-primary">
                            {{ __('Firmar y Registrar') }}
                          </button>
                          <a class="btn btn-primary" href="{{ route('home') }}" role="button">
                            {{ __('Cancelar') }}
                          </a>
                        </div>  
                      </div>
                    </form>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script src="{{ asset('js/jsrsasign-master/jsrsasign-all-min.js') }}"></script>

<script type="text/javascript">
$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var full_name = "{{Auth::user()->full_name}}";
    var spaceCount = (full_name.split(" ").length - 1);
    var name = "";

    for (var i = 0; i <= spaceCount - 2; i++) {
      if(name != ""){
        name = name + " " + full_name.split(' ')[i];
      }else{
          name = full_name.split(' ')[i];  
      } 
    }

    $("#nombre").val(name);
    $("#paterno").val(full_name.split(' ')[spaceCount-1]);
    $("#materno").val(full_name.split(' ')[spaceCount]);

   $('#upload_form').on('submit', function(event){
        event.preventDefault();  
        if(!validate_form()) return;
        validate_fiel();        
    });

    $('#gpoactividad').change(function(){  
      var gpoactividad= $(this).val();
      $.ajax({
        type:'POST',
        url:'/getSubactividades',
        data:{gpoactividad:gpoactividad},
        success:function(data){
          document.getElementById("gpoactividad").classList.remove("is-invalid");
          var o = new Option("-- seleccione una opcion --", "",true, false); 
          $('#subactividad').children().remove().end().append(o) ;
          document.getElementById("subactividad").options[0].disabled = true;
          data.forEach(function(element) {
            var o = new Option(element['descripcion'], element['clave_subactividades']);
            $("#subactividad").append(o);
          });
        }
      });
    });

    $('#subactividad').change(function(){  
      var subactividad= $(this).val();
      $.ajax({
        type:'POST',
        url:'/getActividades',
        data:{subactividad:subactividad},
        success:function(data){
          document.getElementById("actividad").classList.remove("is-invalid");
          var o = new Option("-- seleccione una opcion --", "",true, false); 
          $('#actividad').children().remove().end().append(o) ;
          document.getElementById("actividad").options[0].disabled = true;
          data.forEach(function(element) {
            var o = new Option(element['descripcion'], element['clave_actividades']);
            $("#actividad").append(o);
          });
        }
      });
    });

    $('#codigo').change(function(){
      var codigo= $(this).val();
      $.ajax({
        type:'POST',
        url:'/getCodigos',
        data:{codigo:codigo},
        success:function(data){
          document.getElementById("codigo").classList.remove("is-invalid");
          document.getElementById("municipio").classList.remove("is-invalid");
          document.getElementById("ciudad").classList.remove("is-invalid");
          document.getElementById("colonia").classList.remove("is-invalid");
          $('#municipio').children().remove().end().append(new Option("-- seleccione una opcion --", "",true, false));
          document.getElementById("municipio").options[0].disabled = true;
          $('#ciudad').children().remove().end().append(new Option("-- seleccione una opcion --", "",true, false));
          document.getElementById("ciudad").options[0].disabled = true;
          $('#colonia').children().remove().end().append(new Option("-- seleccione una opcion --", "",true, false));
          document.getElementById("colonia").options[0].disabled = true;
          
          data.forEach(function(element) {
            $("#municipio").append(new Option(element['municipio']));
            $("#ciudad").append(new Option(element['ciudad']));
            $("#colonia").append(new Option(element['colonia'],element['id']));
          });
        }
      });
    });

    function getLocalDate(zulu_time){
        var year = "20" + zulu_time.substring(0,2);
        var month = zulu_time.substring(2,4);
        var day = zulu_time.substring(4,6);
        var hour = zulu_time.substring(6,8);
        var min = zulu_time.substring(8,10);
        var sec = zulu_time.substring(10,12);
        return new Date(year+"-"+month+"-"+day+"T"+hour+":"+min+":"+sec+"Z");
    }

    function parseString(s){
        s=s+"/";
        var parseArray = [];
        var clave = "";
        var val = "";        
        var x = 0;
        for (var i = 0; i < s.length; i++) {
            if(s.charAt(i)==="/"){
                if(i!==0) parseArray[clave] = val;
                var clave = "";
                var val = "";
                x = 0;
            }else if(s.charAt(i)==="="){
                x = 1;
            }
            if(x===0 && s.charAt(i)!="/"){
                clave = clave + s.charAt(i);
            }else if(x===1 && s.charAt(i)!="="){
                val = val + s.charAt(i);
            }            
        }
        return parseArray;
    }

    document.getElementById("fiscal").addEventListener("change", fiscalChange, false);
    function fiscalChange(){
      document.getElementById('fiscal_label').innerHTML = this.files[0].name;
    }

    document.getElementById("domicilio").addEventListener("change", domicilioChange, false);
    function domicilioChange(){
      document.getElementById('domicilio_label').innerHTML = this.files[0].name;
    }

    document.getElementById("key").addEventListener("change", inputKeyChange, false);
    function inputKeyChange(){
        document.getElementById('key_label').innerHTML = this.files[0].name;
    }

    document.getElementById("cer").addEventListener("change", inputCerChange, false);
    function inputCerChange(){
        document.getElementById('cer_label').innerHTML = this.files[0].name;
    }

    function validate_form(){

        document.getElementById("nombre").classList.remove("is-invalid");
        document.getElementById("paterno").classList.remove("is-invalid");
        document.getElementById("materno").classList.remove("is-invalid");
        document.getElementById("actividad").classList.remove("is-invalid");
        document.getElementById("subactividad").classList.remove("is-invalid");
        document.getElementById("fiscal").classList.remove("is-invalid");
        document.getElementById("codigo").classList.remove("is-invalid");
        document.getElementById("municipio").classList.remove("is-invalid");
        document.getElementById("ciudad").classList.remove("is-invalid");
        document.getElementById("colonia").classList.remove("is-invalid");
        document.getElementById("calle").classList.remove("is-invalid");
        document.getElementById("exterior").classList.remove("is-invalid");
        document.getElementById("domicilio").classList.remove("is-invalid");
        document.getElementById("cer").classList.remove("is-invalid");
        document.getElementById("key").classList.remove("is-invalid");
        document.getElementById("password_fiel").classList.remove("is-invalid");

        if(document.getElementById("nombre").value == ""){
          document.getElementById("nombre").classList.add("is-invalid");
          document.getElementById("nombre").focus;
          return false;
        }else if(document.getElementById("paterno").value == ""){
          document.getElementById("paterno").classList.add("is-invalid");
          document.getElementById("paterno").focus;
          return false;
        }else if(document.getElementById("materno").value == ""){
          document.getElementById("materno").classList.add("is-invalid");
          document.getElementById("materno").focus;
          return false;
        }else if(document.getElementById("actividad").value == ""){
          document.getElementById("actividad").classList.add("is-invalid");
          document.getElementById("actividad").focus;
          return false;
        }else if(document.getElementById("subactividad").value == ""){
          document.getElementById("subactividad").classList.add("is-invalid");
          document.getElementById("subactividad").focus;
          return false;
        }else if(document.getElementById("fiscal").value == ""){
          document.getElementById("fiscal").classList.add("is-invalid");
          document.getElementById("fiscal").focus;
          return false;
        }else if(document.getElementById("codigo").value == ""){
          document.getElementById("codigo").classList.add("is-invalid");
          document.getElementById("codigo").focus;
          return false;
        }else if(document.getElementById("municipio").value == ""){
          document.getElementById("municipio").classList.add("is-invalid");
          document.getElementById("municipio").focus;
          return false;
        }else if(document.getElementById("ciudad").value == ""){
          document.getElementById("ciudad").classList.add("is-invalid");
          document.getElementById("ciudad").focus;
          return false;
        }else if(document.getElementById("colonia").value == ""){
          document.getElementById("colonia").classList.add("is-invalid");
          document.getElementById("colonia").focus;
          return false;
        }else if(document.getElementById("calle").value == ""){
          document.getElementById("calle").classList.add("is-invalid");
          document.getElementById("calle").focus;
          return false;
        }else if(document.getElementById("exterior").value == ""){
          document.getElementById("exterior").classList.add("is-invalid");
          document.getElementById("exterior").focus;
          return false;
        }else if(document.getElementById("domicilio").value == ""){
          document.getElementById("domicilio").classList.add("is-invalid");
          document.getElementById("domicilio").focus;
          return false;
        }else if(document.getElementById("cer").value == ""){
          document.getElementById("cer").classList.add("is-invalid");
          document.getElementById("cer").focus;
          return false;
        }else if(document.getElementById("key").value == ""){
          document.getElementById("key").classList.add("is-invalid");
          document.getElementById("key").focus;
          return false;
        }else if(document.getElementById("password_fiel").value == ""){
          document.getElementById("password_fiel").classList.add("is-invalid");
          document.getElementById("password_fiel").focus;
          return false;
        }else return true;
    }

    function validate_fiel(){
        var objFileCertificate = document.getElementById('cer');
        var objFilePrivateKey = document.getElementById('key');
        var contrasena = document.getElementById('password_fiel');
        var readerCertificado = new FileReader();
        readerCertificado.onload = function (event) {
            var bytes = new Uint8Array(event.target.result);
            var binary = "";
            for (var i = 0; i < bytes.byteLength; i++) {
                binary += String.fromCharCode(bytes[i])
            }
            var hex = rstrtohex(binary);  
            var pemString = KJUR.asn1.ASN1Util.getPEMStringFromHex(hex, 'CERTIFICATE');
            var certificado = new X509();
            certificado.readCertPEM(pemString);
            var hSerial    = certificado.getSerialNumberHex();
            var sIssuer    = certificado.getIssuerString(); 
            var sSubject   = parseString(certificado.getSubjectString()); 
            var sNotBefore = getLocalDate(certificado.getNotBefore());
            var sNotAfter  = getLocalDate(certificado.getNotAfter());
            var modulusCer = KEYUTIL.getKey(pemString).n.toString(16);
            var readerPrivateKey = new FileReader();
            readerPrivateKey.onload = function(event) {
                var bytes = new Uint8Array(event.target.result);
                var binary = "";
                for (var i = 0; i < bytes.byteLength; i++) {
                    binary += String.fromCharCode(bytes[i])
                }
                var keyhex = rstrtohex(binary);  
                var pemString = KJUR.asn1.ASN1Util.getPEMStringFromHex(keyhex, 'ENCRYPTED PRIVATE KEY');
                try {
                    var rsakey = KEYUTIL.getKey(pemString, contrasena.value, "PKCS8PRV");
                    var modulusKEY = rsakey.n.toString(16);
                }catch (e) {
                    alert("Error en la comprobacion del La Clave Privada");
                    document.getElementById("password_fiel").classList.add("is-invalid");
                    document.getElementById("key").classList.add("is-invalid");
                    return false;
                }
                if (modulusCer!==modulusKEY) {
                        alert("El certificado no corresponde con la llave privada");
                        document.getElementById("cer").classList.add("is-invalid");
                        return false;
                }else{ 
                       Swal.fire({
                          title: 'Guardando Perfil',
                          html: 'Espere un momento.',
                          onBeforeOpen: () => {
                            Swal.showLoading();
                          },
                        });

                        $.ajax({
                          type:'POST',
                          url: "{{ route('savePerfil') }}",                     
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
                }
            };
            readerPrivateKey.readAsArrayBuffer(objFilePrivateKey.files[0]);
        };
        readerCertificado.readAsArrayBuffer(objFileCertificate.files[0]);
    }
  
});
</script>
@endsection

