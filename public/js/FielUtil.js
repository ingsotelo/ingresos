if (typeof PKI === 'undefined' || !PKI) PKI = {};
if (typeof PKI.SAT === 'undefined' || !PKI.SAT) PKI.SAT = {};
PKI.SAT.FielUtil = new function() {
    this.validaFiel = function(filePrivateKey, contrasena, fileCertificado, callback) {
        if (!this.validaEntradasCertificado(fileCertificado, callback)) {
            return
        }
        if (!this.validaEntradasFirma(filePrivateKey, contrasena, '...', callback)) {
            return
        }
        var readerCertificado = new FileReader();
        readerCertificado.onload = function(e) {
            var bytes = new Uint8Array(readerCertificado.result);
            var binary = "";
            for (var i = 0; i < bytes.byteLength; i++) {
                binary += String.fromCharCode(bytes[i])
            }
            var hex = rstrtohex(binary);
            var pemString = KJUR.asn1.ASN1Util.getPEMStringFromHex(hex, 'CERTIFICATE');
            var certificado = new X509();
            certificado.readCertPEM(pemString);
            var modulusCertificado = certificado.subjectPublicKeyRSA.n;
            if (typeof(modulusCertificado) === 'undefined') {
                callback(27);
                return
            }
            var readerPrivateKey = new FileReader();
            readerPrivateKey.onload = function(e) {
                var bytes = new Uint8Array(readerPrivateKey.result);
                var binary = "";
                for (var i = 0; i < bytes.byteLength; i++) {
                    binary += String.fromCharCode(bytes[i])
                }
                var hex = rstrtohex(binary);
                var pemString = KJUR.asn1.ASN1Util.getPEMStringFromHex(hex, 'ENCRYPTED PRIVATE KEY');
                try {
                    var rsakey = KEYUTIL.getKey(pemString, contrasena, "PKCS8PRV");
                    contrasena = null;
                    var modulusPrivada = rsakey.n;
                    if (!modulusCertificado.equals(modulusPrivada)) {
                        callback(28);
                        return
                    }
                } catch (e) {
                    if (e.indexOf('malformed format: SEQUENCE(0).items != 2') !== -1) {
                        callback(24);
                        return
                    } else if (e === 'malformed plain PKCS8 private key(code:001)') {
                        callback(25);
                        return
                    } else {
                        callback(41);
                        return
                    }
                }
                callback(0, certificado)
            };
            readerPrivateKey.readAsArrayBuffer(filePrivateKey.files[0])
        };
        readerCertificado.readAsArrayBuffer(fileCertificado.files[0])
    };




    this.validaStatusFielX509 = function(filePrivateKey, contrasena, fileCertificado, callback) {
        
        if (!this.validaEntradasCertificado(fileCertificado, callback)) {
            return
        }
        
        if (!this.validaEntradasFirma(filePrivateKey, contrasena, '...', callback)) {
            return
        }
        
        var readerCertificado = new FileReader();
        readerCertificado.onload = function(e) {

            var bytes = new Uint8Array(readerCertificado.result);
            var binary = "";
            for (var i = 0; i < bytes.byteLength; i++) {
                binary += String.fromCharCode(bytes[i])
            }

            var hex = rstrtohex(binary);
            var pemString = KJUR.asn1.ASN1Util.getPEMStringFromHex(hex, 'CERTIFICATE');
            var certificado = new X509();
            certificado.readCertPEM(pemString);
            var modulusCertificado = certificado.subjectPublicKeyRSA.n;

            if (typeof(modulusCertificado) === 'undefined') {
                callback(27);
                return
            }

            var readerPrivateKey = new FileReader();
            readerPrivateKey.onload = function(e) {
                try {
                    var asn1Llave = ASN1.decode(Base64.unarmor(readerPrivateKey.result.split("base64,")[1]));
                    var rsakey = getKeyFromPlainPrivatePKCS8Hex(obtieneLlavePrivada(asn1Llave.toHexString(), contrasena));
                    contrasena = null;
                    var modulusPrivada = rsakey.n;

                    if (!modulusCertificado.equals(modulusPrivada)) {
                        callback(28);
                        return
                    }
                    
                } catch (e) {
                    if (e.indexOf('malformed format: SEQUENCE(0).items != 2') !== -1) {
                        callback(24);
                        return
                    } else if (e === 'malformed plain PKCS8 private key(code:001)') {
                        callback(25);
                        return
                    } else {
                        callback(41);
                        return
                    }
                }
                callback(0, certificado)
            };
            readerPrivateKey.readAsDataURL(filePrivateKey.files[0])
        };
        readerCertificado.readAsArrayBuffer(fileCertificado.files[0])
    };




    this.firmaCadena = function(filePrivateKey, contrasena, cadena_firmar, callback) {
        if (!this.validaEntradasFirma(filePrivateKey, contrasena, cadena_firmar, callback)) {
            return
        }
        var readerPrivateKey = new FileReader();
        readerPrivateKey.onload = function(e) {
            var bytes = new Uint8Array(readerPrivateKey.result);
            var binary = "";
            for (var i = 0; i < bytes.byteLength; i++) {
                binary += String.fromCharCode(bytes[i])
            }
            var hex = rstrtohex(binary);
            var pemString = KJUR.asn1.ASN1Util.getPEMStringFromHex(hex, 'ENCRYPTED PRIVATE KEY');
            var firmaB64 = '';
            try {
                var rsakey = KEYUTIL.getKey(pemString, contrasena, "PKCS8PRV");
                contrasena = null;
                var hSig = rsakey.signString(cadena_firmar, 'sha256');
                firmaB64 = hex2b64(hSig)
            } catch (e) {
                if (e.indexOf('malformed format: SEQUENCE(0).items != 2') !== -1) {
                    callback(24);
                    return
                } else if (e === 'malformed plain PKCS8 private key(code:001)') {
                    callback(25);
                    return
                } else {
                    callback(41);
                    return
                }
            }
            callback(0, firmaB64)
        };
        readerPrivateKey.readAsArrayBuffer(filePrivateKey.files[0])
    };
    this.validaEntradasCertificado = function(fileCertificado, callback) {
        if (typeof(callback) !== 'function') {
            throw "Se requiere una función callback al invocar el método firmar()"
        }
        if (typeof(fileCertificado) === 'undefined' || fileCertificado === null) {
            callback(15);
            return false
        }
        if (typeof(fileCertificado.files) === 'undefined') {
            callback(16);
            return false
        }
        if (fileCertificado.files.length === 0) {
            callback(26);
            return false
        }
        return true
    };
    this.validaEntradasFirma = function(filePrivateKey, contrasena, cadena_firmar, callback) {
        if (typeof(callback) !== 'function') {
            throw "Se requiere una función callback al invocar el método firmar()"
        }
        if (typeof(filePrivateKey) === 'undefined' || filePrivateKey === null) {
            callback(11);
            return false
        }
        if (typeof(filePrivateKey.files) === 'undefined') {
            callback(12);
            return false
        }
        if (typeof(contrasena) === 'undefined' || contrasena === null) {
            callback(13);
            return false
        }
        if (typeof(cadena_firmar) === 'undefined') {
            callback(14);
            return false
        }
        if (filePrivateKey.files.length === 0) {
            callback(21);
            return false
        }
        if (contrasena === '') {
            callback(22);
            return false
        }
        if (cadena_firmar === '') {
            callback(23);
            return false
        }
        return true
    };
    this.obtenMensajeError = function(codigo_error) {
        var msgErrorUTF8;
        if (typeof(codigo_error) === 'undefined' || codigo_error === null) {
            return 'Desconocido'
        }
        switch (codigo_error) {
            case 11:
                msgErrorUTF8 = 'No se ha pasado un valor para filePrivateKey para llave privada';
                break;
            case 12:
                msgErrorUTF8 = 'No se ha pasado un input del tipo file para llave privada';
                break;
            case 13:
                msgErrorUTF8 = 'No se ha pasado un valor para contraseña';
                break;
            case 14:
                msgErrorUTF8 = 'No se ha pasado un valor para la cadena a firmar';
                break;
            case 15:
                msgErrorUTF8 = 'No se ha pasado un valor para fileCertificado para Certificado';
                break;
            case 16:
                msgErrorUTF8 = 'No se ha pasado un input del tipo file para Certificado';
                break;
            case 21:
                msgErrorUTF8 = 'No se ha seleccionado un archivo de llave privada';
                break;
            case 22:
                msgErrorUTF8 = 'La contraseña es vacía';
                break;
            case 23:
                msgErrorUTF8 = 'La cadena a firmar es vacía';
                break;
            case 24:
                msgErrorUTF8 = 'El archivo no es una llave privada';
                break;
            case 25:
                msgErrorUTF8 = 'La contraseña es incorrecta';
                break;
            case 26:
                msgErrorUTF8 = 'No se ha seleccionado un archivo de Certificado';
                break;
            case 27:
                msgErrorUTF8 = 'El archivo no es un Certificado';
                break;
            case 28:
                msgErrorUTF8 = 'El certificado no corresponde con la llave privada';
                break;
            default:
                msgErrorUTF8 = 'Desconocido';
                break
        }
        if (document.characterSet.toUpperCase() === 'ISO-8859-1' || document.characterSet.toUpperCase() === 'WINDOWS-1252') {
            var msgErrorISO = decodeURIComponent(escape(msgErrorUTF8));
            return msgErrorISO
        } else {
            return msgErrorUTF8
        }
    };
    this.readPrivateKeyPEM = function(filePrivateKey, contrasena, callback) {
        if (!this.validaEntradasFirma(filePrivateKey, contrasena, '...', callback)) {
            return
        }
        var readerPrivateKey = new FileReader();
        readerPrivateKey.onload = function(e) {
            var bytes = new Uint8Array(readerPrivateKey.result);
            var binary = "";
            for (var i = 0; i < bytes.byteLength; i++) {
                binary += String.fromCharCode(bytes[i])
            }
            var hex = rstrtohex(binary);
            var pemString = KJUR.asn1.ASN1Util.getPEMStringFromHex(hex, 'ENCRYPTED PRIVATE KEY');
            var rsakey = null;
            try {
                rsakey = KEYUTIL.getKey(pemString, contrasena, "PKCS8PRV");
                contrasena = null
            } catch (e) {
                if (e.indexOf('malformed format: SEQUENCE(0).items != 2') !== -1) {
                    callback(24);
                    return
                } else if (e === 'malformed plain PKCS8 private key(code:001)') {
                    callback(25);
                    return
                } else {
                    callback(41);
                    return
                }
            }
            callback(0, rsakey)
        };
        readerPrivateKey.readAsArrayBuffer(filePrivateKey.files[0])
    }
};
