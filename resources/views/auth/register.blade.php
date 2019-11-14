@extends('layouts.app')
@section('styles')
<style type="text/css">
    .custom-file-input ~ .custom-file-label::after {
    content: "Elegir";
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Regístrate con tu E-Firma') }}</div>

                <div class="card-body">
                        <div class="form-group row">
                            <label for="cer" class="col-md-4 col-form-label text-md-right">{{ __('Certificado (.cer):') }}</label>
                            
                            <div class="col-md-6"> 
                                <div class="custom-file" lang="es">
                                        <input type="file" class="custom-file-input" id="cer" name="cer" accept=".cer" autofocus>
                                        <label class="custom-file-label" id="cer_label" for="cer">Archivo .CER</label>
                                </div>
                                
                            </div>  
                        </div>

                        <div class="form-group row">
                            <label for="key" class="col-md-4 col-form-label text-md-right">{{ __('Llave privada (.key):') }}</label>
                            
                            <div class="col-md-6"> 
                                <div class="custom-file" lang="es">
                                        <input type="file" class="custom-file-input" id="key" name="key" accept=".key" autofocus>
                                        <label class="custom-file-label" id="key_label" for="key">Archivo .KEY</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_fiel" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña FIEL') }}</label>

                            <div class="col-md-6">
                                <input id="password_fiel" type="password" class="form-control" name="password__fiel">
                            </div>
                        </div>

                        <div class="form-group row" id="btn_div">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" id="valida_btn" >
                                    {{ __('Validación') }}
                                </button>
                            </div>
                        </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div id="div_form" style="display: none;"> 
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" readonly>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rfc" class="col-md-4 col-form-label text-md-right">{{ __('RFC') }}</label>

                            <div class="col-md-6">
                                <input id="rfc" type="text" class="form-control @error('rfc') is-invalid @enderror" name="rfc" value="{{ old('rfc') }}" required autocomplete="rfc" readonly>

                                @error('rfc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="curp" class="col-md-4 col-form-label text-md-right">{{ __('CURP') }}</label>

                            <div class="col-md-6">
                                <input id="curp" type="text" class="form-control @error('curp') is-invalid @enderror" name="curp" value="{{ old('curp') }}" required autocomplete="curp" readonly>

                                @error('curp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrarme') }}
                                </button>
                                <button type="button" class="btn btn-primary" id="cancela_btn" >
                                    {{ __('Cancelar') }}
                                </button>
                            </div>  
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

<script src="{{ asset('js/jsrsasign-master/jsrsasign-all-min.js') }}"></script>

<script type="text/javascript">

    $(function() {
        
        var inputKey = document.getElementById("key");
        var inputCer = document.getElementById("cer");
        inputKey.addEventListener("change", inputKeyChange, false);
        inputCer.addEventListener("change", inputCerChange, false);
        document.getElementById("valida_btn").addEventListener("click", validaFIEL);
        document.getElementById("cancela_btn").addEventListener("click", limpiarForm);

        @if ($errors->any())
            document.getElementById('cer').disabled = true;
            document.getElementById('key').disabled = true;
            document.getElementById('password_fiel').value = "*********";
            document.getElementById('password_fiel').disabled = true;
            document.getElementById("btn_div").style.display = "none";
            document.getElementById("div_form").style.display = "block";
        @endif
    
    });

    function limpiarForm(){

        $('.invalid-feedback').hide();
        $('.form-control').removeClass("is-invalid");
        
        document.getElementById('name').value = null;
        document.getElementById('rfc').value = null;
        document.getElementById('curp').value = null;
        document.getElementById('email').value = null;
        document.getElementById("password").value = null;

        document.getElementById('password_fiel').value = null;
        document.getElementById('password_fiel').disabled = false;
        document.getElementById('cer').value = null;
        document.getElementById('cer').disabled = false;
        document.getElementById('cer_label').innerHTML = "Archivo .CER";
        document.getElementById('key').value = null;
        document.getElementById('key').disabled = false;
        document.getElementById('key_label').innerHTML = "Archivo .KEY";
        
        document.getElementById("div_form").style.display = "none";
        document.getElementById("btn_div").style.display = "block";
        document.getElementById('cer').focus();

    }

    function validaFIEL(){

        if (!document.getElementById('cer').value || document.getElementById('cer').value.replace(/^\s+|\s+$/g, "") === "") {
            console.log("fallo input file cer");
            return false;
        }
        if (!document.getElementById('key').value || document.getElementById('key').value.replace(/^\s+|\s+$/g, "") === "") {
            console.log("fallo input file key");
            return false;
        }
        if (!document.getElementById('password_fiel').value || document.getElementById('password_fiel').value === "") {
            console.log("fallo password fiel");
            return false;
        }

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
                    console.log("Error en la comprobacion del La Clave Privada");
                    return;
                }
                if (modulusCer!==modulusKEY) {
                        console.log("El certificado no corresponde con la llave privada");
                        return;
                }else{  
                        objFileCertificate.disabled = true;
                        objFilePrivateKey.disabled = true;
                        contrasena.disabled = true;
                        document.getElementById("btn_div").style.display = "none";
                        document.getElementById('name').value = sSubject.CN;
                        document.getElementById('name').readOnly = true;
                        document.getElementById('rfc').value = sSubject.uniqueIdentifier;
                        document.getElementById('rfc').readOnly = true;
                        document.getElementById('curp').value = sSubject.serialNumber;
                        document.getElementById('curp').readOnly = true;
                        document.getElementById('email').value = sSubject.E;
                        document.getElementById("div_form").style.display = "block";
                        document.getElementById("password").focus();    
                }
            };
            readerPrivateKey.readAsArrayBuffer(objFilePrivateKey.files[0])
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

    function inputKeyChange(){
        var currentFiles = this.files;
        document.getElementById('key_label').innerHTML = currentFiles[0].name;
    }

    function inputCerChange(){
        var currentFiles = this.files;
        document.getElementById('cer_label').innerHTML = currentFiles[0].name;
    }

</script>
    
@endsection

