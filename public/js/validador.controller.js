var tiempoInicialC;
var tiempoFinalC;
var esFirmadoMasivo = 0;
var contadorBloques = 0;

var _rfc_pattern_pm = "^(([A-ZÃ‘&]{3})([0-9]{2})([0][13578]|[1][02])(([0][1-9]|[12][\\d])|[3][01])([A-Z0-9]{3}))|" + "(([A-ZÃ‘&]{3})([0-9]{2})([0][13456789]|[1][012])(([0][1-9]|[12][\\d])|[3][0])([A-Z0-9]{3}))|" + "(([A-ZÃ‘&]{3})([02468][048]|[13579][26])[0][2]([0][1-9]|[12][\\d])([A-Z0-9]{3}))|" + "(([A-ZÃ‘&]{3})([0-9]{2})[0][2]([0][1-9]|[1][0-9]|[2][0-8])([A-Z0-9]{3}))$";
var _rfc_pattern_pf = "^(([A-ZÃ‘&]{4})([0-9]{2})([0][13578]|[1][02])(([0][1-9]|[12][\\d])|[3][01])([A-Z0-9]{3}))|" + "(([A-ZÃ‘&]{4})([0-9]{2})([0][13456789]|[1][012])(([0][1-9]|[12][\\d])|[3][0])([A-Z0-9]{3}))|" + "(([A-ZÃ‘&]{4})([02468][048]|[13579][26])[0][2]([0][1-9]|[12][\\d])([A-Z0-9]{3}))|" + "(([A-ZÃ‘&]{4})([0-9]{2})[0][2]([0][1-9]|[1][0-9]|[2][0-8])([A-Z0-9]{3}))$";

//**************** VALIDACION DE CERTIFICADO Y LLAVE PRIVADA DEL CONTRIBUYENTE****************************************//
/**
 * Obtiene los parÃ¡metros de entrada para la validaciÃ³n de cer y key.
 * AdemÃ¡s inicializa los componentes.
 * @param 
 * @returns
 */
function firmadoIndividual() {
    // Validar valores input cert y key formulario.
    if (!validarInputsFormularioFirmaView()) {
        return false;
    }
    // Obtener elementos para firmado
    var objFileCertificate = document.getElementById('fileInputCer');// FIEL
    var objFilePrivateKey = document.getElementById('fileInput');// Llave privada
    var valorPassEncriptado = document.getElementById('pwdLlavePriv').value;// ContraseÃ±a del usuario
    
    //SAPS - Comienza la desencriptacion del password
    var passwordDesencriptado = Base_64.desencriptar(valorPassEncriptado);
    var passwordUser = passwordDesencriptado;
    // InicializaciÃ³n de componentes de la vista, en donde se muestran mensajes de error.
    ///resetErrorsPrivateKey();
    ///resetErrorsPassword();
    ///resetErrorsCertificate();
    ///resetErrors();
    inicializarMensajeJSFErrorExitoValFIEL();

    // La validaciÃ³n de llave privada no contempla este caso.
    if (!objFilePrivateKey || objFilePrivateKey.value === '') {
        objFilePrivateKey = 'undefined';
    }

    // ValidaciÃ³n de la FIEL del contribuyente.
    // Este mÃ©todo llama el mÃ©todo de firmado.
    validarFiel('...', objFilePrivateKey, passwordUser, objFileCertificate);
}

function validarInputsFormularioFirmaView() {
    try {
        if (!document.getElementById('certificate').value || document.getElementById('certificate').value.replace(/^\s+|\s+$/g, "") === "") {
            mostrarMensajesJSFErrorGeneral(catalogoErrores[15].msg_vista);
            resetShowProgressBarSI();
            return false;
        }
        if (!document.getElementById('privateKey').value || document.getElementById('privateKey').value.replace(/^\s+|\s+$/g, "") === "") {
            mostrarMensajesJSFErrorGeneral(catalogoErrores[12].msg_vista);
            resetShowProgressBarSI();
            return false;
        }
        return true;
    } catch (e) {
    }
}

/**
 * Se invoca desde la vista la iniciar el flujo de validaciÃ³n.
 * @param 
 * @returns
 */
function validacionEntradaInicial() {
    // validaciones de entrada folio
    inicializarFirmadoIndividual();
    dlg1.show();
}

/**
 * Revisa si una cadena es un nÃºmero
 * @param strNumero     NÃºmero en formato cadena.
 * @returns
 */
function isInteger(strNumero) {
    return /^\+?(0|[1-9]\d*)$/.test(strNumero);
}

/**
 * Revisa que una cadena sea un RFC vÃ¡lido.
 * @param strRfc    RFC del contribuyente.
 * @returns
 */
function isRFC(strRfc) {
    if (strRfc.match(_rfc_pattern_pm) || strRfc.match(_rfc_pattern_pf)) {
        return true;
    }
    else {
        return false;
    }
}

/**
 * Inicializa campos del formulario de autenticaciÃ³n para firmado.
 * @param 
 * @returns
 */
function inicializarSigned() {
    try {
        $("#certificate").val('');
        $("#privateKey").val('');
        $("#pwdLlavePriv").val('');
        $("#txtRFC").val('');
        $('#fileInputCer').val('');
        $('#fileInput').val('');
    }
    catch (e) {
        alert('no se encontraron inputs');
    }
}

/**
 * Inicializa la tabla en donde se muestran los resultados de firmado.
 * TambiÃ©n inicializa los campos del formulario.
 * @param 
 * @returns
 */
function inicializarFirmadoIndividual() {
    inicializarSigned();
}

/**
 * Este mÃ©todo toma el origen del firmado(masivo o individual) y ejecuta la acciÃ³n.
 * @param 
 * @returns
 */
function signedCommand() {
    try {
        statusDialog.show();
        firmadoIndividual();
    }
    catch (e) {
        alert('Error...');
    }
}


/**
 * Valida el certificado con el ARA, regresa un 001 si el estatus del certificado se encuentra activo en el ARA.
 * @param       str_rfc_current             RFC del contribuyente a 13/12 posiciones.
 * @param       num_serie_cert              NÃºmero de serie del certificado en formato hexadecimal.
 * @param       cadenaOriginalAplicativo    Cadena original del documento que se desea firmar. Pueder ir vacÃ­o.
 * @param       passwordUser                ContraseÃ±a del contribuyente.
 * @param       llavePrivadaUser            Lllave privada del contribuyente.
 * @returns
 */
function signedIndividualCertificadoState1(str_rfc_current, num_serie_cert, cadenaOriginalAplicativo, passwordUser, llavePrivadaUser) {
    $.ajax({
        async: false,
        url: document.getElementById("certificado_state_1").value,
        data: {rfcContribuyente: str_rfc_current, numSerieCert: num_serie_cert},
        type: 'POST',
        dataType: 'html',
        success: function (data, textStatus, xhr) {
            try {
                var resultAra = processResultARA(data);
                if (resultAra === -1) {
                    mostrarMensajesJSFErrorGeneral("Servicio no disponible. Intente mÃ¡s tarde.")
                } else if (resultAra) {
                    inicializarSigned();
                    mostrarMensajeJSFExitoValFIEL();
                    if (validaOrigenRestablecer()) {   //si el origen es de restablecer
                        try {
                            restablecerConstrasenaExito();
                        } catch (e) {
                            alert('Error...');
                        }
                    }
                } else {
                    inicializarSigned();
                    mostrarMensajeJSFErrorValFIEL();

                }
            } catch (error_interno) {
                resetShowProgressBarSI();
                printOutput("OcurriÃ³ un error al momento de procesar el resultado del ARA : View.");
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            resetShowProgressBarSI();
            alert("OcurriÃ³ un error al momento de realizar la peticiÃ³n.");
        }
    });
}

/**
 * Valida el certificado con el ARA, regresa un 001 si el estatus del certificado se encuentra activo en el ARA.
 * @param       str_rfc_current             RFC del contribuyente a 13/12 posiciones.
 * @param       num_serie_cert              NÃºmero de serie del certificado en formato hexadecimal.
 * @param       url_validador               URL de servicio validador de la fiel.
 * @returns
 */
function signedIndividualCertificadoState1Applet(str_rfc_current, num_serie_cert, url_validador) {
    $.ajax({
        async: false,
        url: url_validador,
        data: {rfcContribuyente: str_rfc_current, numSerieCert: num_serie_cert},
        type: 'POST',
        dataType: 'html',
        success: function (data, textStatus, xhr) {
            try {
                var resultAra = processResultARA(data);
                if (resultAra === -1) {
                    mostrarMensajeErrorGeneralApplet("Servicio no disponible. Intente mÃ¡s tarde.")
                } else if (resultAra) {
                    inicializarFormularioApplet();
                    mostrarMensajeJSFExitoValFIELApplet();
                    if (validaOrigenRestablecerApplet()) {   //si el origen es de restablecer
                        try {
                            restablecerConstrasenaExitoApplet();
                        } catch (e) {
                            alert('Error...');
                        }
                    }
                } else {
                    inicializarFormularioApplet();
                    mostrarMensajeJSFErrorValFIELApplet();
                }
            } catch (error_interno) {
                resetShowProgressBarSI();
                alert("OcurriÃ³ un error al momento de procesar el resultado del ARA : View.");
            }
        },
        error: function (xhr, textStatus, errorThrown) {
        alert("error");
            resetShowProgressBarSI();
            alert("OcurriÃ³ un error al momento de realizar la peticiÃ³n.");
        }
    });
}

/**
 * Valida el certificado con el ARA, regresa un 001 si el estatus del certificado se encuentra activo en el ARA.
 * @param       str_rfc_current             RFC del contribuyente a 13/12 posiciones.
 * @param       num_serie_cert              NÃºmero de serie del certificado en formato hexadecimal.
 * @param       cadenaOriginalAplicativo    Cadena original del documento que se desea firmar. Pueder ir vacÃ­o.
 * @param       passwordUser                ContraseÃ±a del contribuyente.
 * @param       llavePrivadaUser            Lllave privada del contribuyente.
 * @returns
 */
function validarCaptchaController() {
    myfunction_callback('parametro_uno', function (error_code, resultado) {
        if (error_code === 0) {
            //success
        } else {
            alert('Error general. Intente mas tarde.');
        }
    });
}

function myfunction_callback(nada, funcionalidad) {
    var aux = 'mesaage';
    $("button[id$='button_captcha_01']").click();
    funcionalidad(0, aux);
    return;
}

function aux_submit() {
    $.ajax({
        async: false,
        url: document.getElementById("valida_captcha_state_1").value,
        //data: { rfcContribuyente: str_rfc_current, numSerieCert: num_serie_cert },
        type: 'POST',
        dataType: 'html',
        success: function (data, textStatus, xhr) {
            try {
                var $response = $(data);
                var oneval = $response.filter('#estatus_captcha').val();
                reloadCaptcha();
                if (oneval === "exito") {
                    signedCommand();
                } else {
                    mostrarMensajesJSFErrorGeneral(oneval);
                    try {
                        $("input[id$='captcha']").val("");
                    } catch (ecaptcha) {
                    }
                }
            } catch (error_interno) {
                resetShowProgressBarSI();
                printOutput("OcurriÃ³ un error al momento de procesar el resultado del ARA : View.");
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            resetShowProgressBarSI();
            alert("OcurriÃ³ un error al momento de realizar la peticiÃ³n.");
        }
    });
}

function validaOrigenRestablecer() {
    
    var origenRC = false;
    var origen = window.location.href;
    if (origen.indexOf("recuperarContrasenia") != -1) {
        origenRC = true;
    }
    return origenRC;

}

function validaOrigenRestablecerApplet() {
    var origenRCA = false;
    var origen = window.location.href;
    if (origen.indexOf("recuperarContraseniaApp") > -1) {
        origenRCA = true;
    }
    return origenRCA;
}

function restablecerConstrasenaExito() {
    try {
        if(document.getElementById("frmRC:btnSubmit")){
            document.getElementById("frmRC:btnSubmit").click();
        }else{
            $('input[id$="btnSubmit"]').click();
        }
    } catch (e) {
        alert("restablecerConstrasenaExito() -Error: " + e);
    }
}

function restablecerConstrasenaExitoApplet() {
    try {
        if(document.getElementById("frmRC:btnSubmit")){
            document.getElementById("frmRC:btnSubmit").click();
        }else{
            $('input[id$="btnSubmit"]').click();
        }
    } catch (e) {
        alert("restablecerConstrasenaExitoApplet() -Error: " + e);
    }
}

function restablecerConstrasenaError() {
    try {
        ///console.log('restablecerConstrasenaError() - validacion fiel incorrecta, no enviara a reseteo de contraseÃ±a');
    } catch (e) {
        alert("restablecerConstrasenaError() - Error: " + e);
    }
}



/**
 * Procesa el resultado que regresa el servicio ARA y LDAP.
 * @param     response_service          Resultado del servicio en formato texto.
 * @returns
 */
function processResultARA(response_service) {
    try {
        var $response = $(response_service);
        var oneval = $response.filter('#estatus_certificado').val();
        ///alert('RESULTADO ARA : ' + oneval);
        if (oneval === '001') {
            return true;
        } else if (oneval === '002') {
            return -1;
        } else {
            return false;
        }
    }
    catch (exc) {
        printOutput("OcurriÃ³ un error al momento de consumir el servicio ARA.");
        return false;
    }
}

/**
 * Lee el certificado y obtiene su RFC en formato cadena y lo muestra en formulario.
 * @param 
 * @returns
 */
function rfcController() {
    try {
        var objFileCertificate = document.getElementById('fileInputCer');

        leerCertX509(objFileCertificate, function (error_code_1, certificado_1) {
            var rfcSubject = certificado_1.getRFC();
            setearRFC(rfcSubject);
            ///obtenerRFC(objFileCertificate);
        });
    }
    catch (e) {
        printOutput('No se pudo leer el certificado para obtener RFC.');
    }
}

/**
 * Agregando eventos al dom de signed xhtml
 * @param 
 * @returns
 */
function evtAddDom() {
    $("#certificate").bind("click", function () {
        $("#btnCert").click();
    });

    $("#privateKey").bind("click", function () {
        $("#btnPrivateKey").click();
    });
}