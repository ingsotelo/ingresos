//************************************ FIRMADO INDIVIDUAL ************************************************************//
/**
 * MÃ©todo que se utiliza en el aplicativo para validar la FIEL con el ARA.
 *
 * @param llavePrivadaUser              El elemento input del tipo "file" de la llave privada.
 * @param passwordUser                  String con la contraseÃ±a de la llave privada.
 * @param cadenaOriginalAplicativo      String con la cadena a firmar
 * @param fileCertificado               FIEL que se desea validar, tipo cer(X509).
 * @returns
 */
function validarFiel(cadenaOriginalAplicativo, llavePrivadaUser, passwordUser, fileCertificado) {
    
    PKI.SAT.FielUtil.validaStatusFielX509(llavePrivadaUser, passwordUser, fileCertificado, function (error_code, certificado) {
        document.getElementById('codigoErrorJS').value = error_code;
        if (error_code === 0) {
            mostrarVigenciaCert(certificado.getNotBefore(), certificado.getNotAfter());
            leerCertX509(fileCertificado, function (error_code_1, certificado_1) {
                var rfcSubject = certificado_1.getRFC();
                signedIndividualCertificadoState1(rfcSubject, certificado.getSerialNumberHex(), '...', passwordUser, llavePrivadaUser);
                resetShowProgressBarSI();
            });
        } else {
            resetShowProgressBarSI();
            mapaErrores.execute(error_code);
            ///alert('OcurriÃ³ un error al validar la FIEL: \n' + PKI.SAT.FielUtil.obtenMensajeError(error_code));
        }
    });
}