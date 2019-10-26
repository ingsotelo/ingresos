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
                <div class="card-header">{{ __('Regístrate') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                                            <p class="header-block">Parse loaded/created X.509 certificate</p>
                                            <div id="cert-data-block" class="border-block">
                                                <p>
                                                    <label for="cert-file">Select binary X.509 cert file:</label>
                                                    <input type="file" id="cert-file" title="X.509 certificate" />
                                                </p>
                                                <div id="cert-issuer-div" class="two-col">
                                                    <p class="subject">Issuer:</p>
                                                    <table id="cert-issuer-table">
                                                        <tr>
                                                            <th>OID</th><th>Value</th>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div id="cert-subject-div" class="two-col">
                                                    <p class="subject">Subject:</p>
                                                    <table id="cert-subject-table">
                                                        <tr>
                                                            <th>OID</th><th>Value</th>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <p><span class="type">Serial number:</span> <span id="cert-serial-number"></span></p>
                                                <p><span class="type">Issuance date:</span> <span id="cert-not-before"></span></p>
                                                <p><span class="type">Expiration date:</span> <span id="cert-not-after"></span></p>
                                                <p><span class="type">Public key size (bits):</span> <span id="cert-keysize"></span></p>
                                                <p><span class="type">Signature algorithm:</span> <span id="cert-sign-algo"></span></p>

                                                <div id="cert-extn-div" class="two-col" style="display:none;">
                                                    <p class="subject">Extensions:</p>
                                                    <table id="cert-extn-table"><tr><th>OID</th></tr></table>
                                                </div>
                                                
                                            </div>

                        <div class="form-group row">
                            <label for="cer" class="col-md-4 col-form-label text-md-right">{{ __('Certificado (.cer):') }}</label>
                            
                            <div class="col-md-6"> 
                                <div class="custom-file" lang="es">
                                        <input type="file" class="cer-file-input" id="cer" name="cer" accept=".cer" >
                                        <label class="custom-file-label" for="cer">
                                           Archivo .CER
                                        </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

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
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
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

<script src="{{ asset('js/polyfill.js') }}"></script>
<script src="{{ asset('js/X509_cert_complex_example.js') }}"></script>

<script type="text/javascript">

    /*$('.cer-file-input').on('change',function(){
      var fileName = $(this).val();
      $(this).next('.custom-file-label').addClass("selected").html(fileName);
    })
    */
    document.getElementById('cert-file').addEventListener('change', handleFileBrowse, false);
    //console.log(certificateBuffer);
</script>
    
@endsection

