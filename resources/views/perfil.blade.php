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
                <div class="card-header  text-center text-white bg-success">Registro del Perfil del Contribuyente</div>
                <div class="card-body">
                    

                    <div class="form-group row"> 
                      <div class="col-md-4">
                        <label for="rfc" class="col-form-label">{{ __('RFC:') }}</label>
                        <input id="rfc" type="text" class="form-control" name="rfc"  value="{{ Auth::user()->name }}" disabled>
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
                        <label for="actividad" class="col-form-label">{{ __('Actividad Economica:') }}</label>
                        <select id="actividad" class="form-control" name="actividad">
                          <option disabled selected value> -- seleccione una opcion -- </option>
                          @foreach ($actividades as $actividad)
                            <option value="{{$actividad->clave}}">{{$actividad->descripcion}}</option>
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
                      <div class="col-md-12"> 
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
                        <input id="codigo" type="number" class="form-control" name="codigo">
                          <span class="invalid-feedback" role="alert" >
                            <strong>El codigo postal es requerido.</strong>
                          </span>
                      </div>
                      <div class="col-md-5">
                        <label for="municipio" class="col-form-label">{{ __('Municipio:') }}</label>
                        <input id="municipio" type="text" class="form-control" name="municipio">
                          <span class="invalid-feedback" role="alert" >
                            <strong>El municipio es requerido.</strong>
                          </span>
                      </div>
                      <div class="col-md-5">
                        <label for="ciudad" class="col-form-label">{{ __('Ciudad:') }}</label>
                        <input id="ciudad" type="text" class="form-control" name="ciudad">
                          <span class="invalid-feedback" role="alert" >
                            <strong>La ciudad es requerida.</strong>
                          </span>
                      </div>
                    </div>

                    <div class="form-group row"> 
                     
                     <div class="col-md-4">
                        <label for="colonia" class="col-form-label">{{ __('Colonia:') }}</label>
                        <input id="colonia" type="text" class="form-control" name="colonia">
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
                      <div class="col-md-12"> 
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
                        <button class="btn btn-primary" id="btn_send">
                          {{ __('Firmar y Registrar') }}
                        </button>
                        <a class="btn btn-primary" href="{{ route('home') }}" role="button">
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
    $('#actividad').change(function(){  
    var actividad= $(this).val();
      $.ajax({
        type:'POST',
        url:'/getSubactividades',
        data:{actividad:actividad},
        success:function(data){
          document.getElementById("actividad").classList.remove("is-invalid");
          var o = new Option("-- seleccione una opcion --", "",true, false); 
          $('#subactividad').children().remove().end().append(o) ;
          document.getElementById("subactividad").options[0].disabled = true;
          data.forEach(function(element) {
            var o = new Option(element['descripcion'], element['clave_actividades']);
            $("#subactividad").append(o);
          });
        }
      });
    });

    $("#btn_send").click(function(e){   
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
        }
        
        console.log("valida fiel");
        validaFIEL();
    });

    

    function validaFIEL(){

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
                    return;
                }
                if (modulusCer!==modulusKEY) {
                        alert("El certificado no corresponde con la llave privada");
                        document.getElementById("cer").classList.add("is-invalid");
                        return;
                }else{  

                        //document.getElementById('name').value = sSubject.CN;
                  
                        Swal.fire({
                            title: 'Guardando Perfil',
                            html: 'Espere un momento.',
                            onBeforeOpen: () => {
                                Swal.showLoading();
                            },
                        });
  
                        $.ajax({
                          type:'POST',
                          url:'/savePerfil',
                          data:{
                                rfc:"{{ Auth::user()->name }}",
                                curp:"{{ Auth::user()->curp }}",
                                nombre:"{{ Auth::user()->full_name }}",
                                email:"{{ Auth::user()->email }}",
                                actividad: document.getElementById("subactividad").value,
                                codigo:document.getElementById("codigo").value,
                                municipio:document.getElementById("municipio").value,
                                ciudad:document.getElementById("ciudad").value,
                                colonia:document.getElementById("colonia").value,
                                calle:document.getElementById("calle").value,
                                numero:document.getElementById("exterior").value,
                                notificacion:"Actualizacion de Perfil",
                          },
                          success:function(data){
                            console.log(data.error);
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
  
});
</script>
@endsection

