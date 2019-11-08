function getKeyFromPlainPrivatePKCS8Hex(prvKeyHex) {
    var p8 = parsePlainPrivatePKCS8Hex(prvKeyHex);
    if (p8.algoid == "2a864886f70d010101") {
        parsePrivateRawRSAKeyHexAtObj(prvKeyHex, p8);
        var k = p8.key;
        var key = new RSAKey();
        key.setPrivateEx(k.n, k.e, k.d, k.p, k.q, k.dp, k.dq, k.co);
        return key
    } else if (p8.algoid == "2a8648ce3d0201") {
        this.parsePrivateRawECKeyHexAtObj(prvKeyHex, p8);
        if (KJUR.crypto.OID.oidhex2name[p8.algparam] === undefined) throw "KJUR.crypto.OID.oidhex2name undefined: " + p8.algparam;
        var curveName = KJUR.crypto.OID.oidhex2name[p8.algparam];
        var key = new KJUR.crypto.ECDSA({
            'curve': curveName
        });
        key.setPublicKeyHex(p8.pubkey);
        key.setPrivateKeyHex(p8.key);
        key.isPublic = false;
        return key
    } else if (p8.algoid == "2a8648ce380401") {
        var hP = ASN1HEX.getVbyList(prvKeyHex, 0, [1, 1, 0], "02");
        var hQ = ASN1HEX.getVbyList(prvKeyHex, 0, [1, 1, 1], "02");
        var hG = ASN1HEX.getVbyList(prvKeyHex, 0, [1, 1, 2], "02");
        var hX = ASN1HEX.getVbyList(prvKeyHex, 0, [2, 0], "02");
        var biP = new BigInteger(hP, 16);
        var biQ = new BigInteger(hQ, 16);
        var biG = new BigInteger(hG, 16);
        var biX = new BigInteger(hX, 16);
        var key = new KJUR.crypto.DSA();
        key.setPrivate(biP, biQ, biG, null, biX);
        return key
    } else {
        throw "unsupported private key algorithm"
    }
}

function parsePlainPrivatePKCS8Hex(pkcs8PrvHex) {
    var result = {};
    result.algparam = null;
    if (pkcs8PrvHex.substr(0, 2) != "30") throw "malformed plain PKCS8 private key(code:001)";
    var a1 = ASN1HEX.getPosArrayOfChildren_AtObj(pkcs8PrvHex, 0);
    if (a1.length != 3) throw "malformed plain PKCS8 private key(code:002)";
    if (pkcs8PrvHex.substr(a1[1], 2) != "30") throw "malformed PKCS8 private key(code:003)";
    var a2 = ASN1HEX.getPosArrayOfChildren_AtObj(pkcs8PrvHex, a1[1]);
    if (a2.length != 2) throw "malformed PKCS8 private key(code:004)";
    if (pkcs8PrvHex.substr(a2[0], 2) != "06") throw "malformed PKCS8 private key(code:005)";
    result.algoid = ASN1HEX.getHexOfV_AtObj(pkcs8PrvHex, a2[0]);
    if (pkcs8PrvHex.substr(a2[1], 2) == "06") {
        result.algparam = ASN1HEX.getHexOfV_AtObj(pkcs8PrvHex, a2[1])
    }
    if (pkcs8PrvHex.substr(a1[2], 2) != "04") throw "malformed PKCS8 private key(code:006)";
    result.keyidx = ASN1HEX.getStartPosOfV_AtObj(pkcs8PrvHex, a1[2]);
    return result
}

function parsePrivateRawRSAKeyHexAtObj(pkcs8PrvHex, info) {
    var keyIdx = info.keyidx;
    if (pkcs8PrvHex.substr(keyIdx, 2) != "30") throw "malformed RSA private key(code:001)";
    var a1 = ASN1HEX.getPosArrayOfChildren_AtObj(pkcs8PrvHex, keyIdx);
    if (a1.length != 9) throw "malformed RSA private key(code:002)";
    info.key = {};
    info.key.n = ASN1HEX.getHexOfV_AtObj(pkcs8PrvHex, a1[1]);
    info.key.e = ASN1HEX.getHexOfV_AtObj(pkcs8PrvHex, a1[2]);
    info.key.d = ASN1HEX.getHexOfV_AtObj(pkcs8PrvHex, a1[3]);
    info.key.p = ASN1HEX.getHexOfV_AtObj(pkcs8PrvHex, a1[4]);
    info.key.q = ASN1HEX.getHexOfV_AtObj(pkcs8PrvHex, a1[5]);
    info.key.dp = ASN1HEX.getHexOfV_AtObj(pkcs8PrvHex, a1[6]);
    info.key.dq = ASN1HEX.getHexOfV_AtObj(pkcs8PrvHex, a1[7]);
    info.key.co = ASN1HEX.getHexOfV_AtObj(pkcs8PrvHex, a1[8])
}

function parsePrivateRawECKeyHexAtObj(pkcs8PrvHex, info) {
    var keyIdx = info.keyidx;
    var key = ASN1HEX.getVbyList(pkcs8PrvHex, keyIdx, [1], "04");
    var pubkey = ASN1HEX.getVbyList(pkcs8PrvHex, keyIdx, [2, 0], "03").substr(2);
    info.key = key;
    info.pubkey = pubkey
}

function obtieneInfoPKCS8(sHEX) {
    var info = {};
    var a0 = ASN1HEX.getPosArrayOfChildren_AtObj(sHEX, 0);
    if (a0.length != 2) throw "malformed format: SEQUENCE(0).items != 2: " + a0.length;
    info.ciphertext = ASN1HEX.getHexOfV_AtObj(sHEX, a0[1]);
    var a0_0 = ASN1HEX.getPosArrayOfChildren_AtObj(sHEX, a0[0]);
    if (a0_0.length != 2) throw "malformed format: SEQUENCE(0.0).items != 2: " + a0_0.length;
    var x = ASN1HEX.getHexOfV_AtObj(sHEX, a0_0[0]);
    if (ASN1HEX.getHexOfV_AtObj(sHEX, a0_0[0]) != "2A864886F70D01050D") throw "this only supports pkcs5PBES2";
    var a0_0_1 = ASN1HEX.getPosArrayOfChildren_AtObj(sHEX, a0_0[1]);
    if (a0_0.length != 2) throw "malformed format: SEQUENCE(0.0.1).items != 2: " + a0_0_1.length;
    var a0_0_1_0 = ASN1HEX.getPosArrayOfChildren_AtObj(sHEX, a0_0_1[0]);
    if (a0_0_1_0.length != 2) throw "malformed format: SEQUENCE(0.0.1.0).items != 2: " + a0_0_1_0.length;
    var a0_0_1_1 = ASN1HEX.getPosArrayOfChildren_AtObj(sHEX, a0_0_1[1]);
    if (a0_0_1_1.length != 2) throw "malformed format: SEQUENCE(0.0.1.1).items != 2: " + a0_0_1_1.length;
    var algoritmo = ASN1HEX.getHexOfV_AtObj(sHEX, a0_0_1_1[0]);
    if (algoritmo === "2A864886F70D0307" || algoritmo === "3ECE45092C62A8B9") info.encryptionSchemeAlg = "TripleDES";
    else if (algoritmo === "2B0E030207") info.encryptionSchemeAlg = "DES";
    else if (algoritmo === "608648016503040116") info.encryptionSchemeAlg = "AES-192";
    else if (algoritmo === "608648016503040102") info.encryptionSchemeAlg = "AES-128";
    else if (algoritmo === "60864801650304012A") info.encryptionSchemeAlg = "AES-256";
    else if (algoritmo === "2A864886F70D0302") info.encryptionSchemeAlg = "RC2";
    else throw "Algortimo no soportado " + algoritmo;
    if (info.encryptionSchemeAlg !== "RC2") info.encryptionSchemeIV = ASN1HEX.getHexOfV_AtObj(sHEX, a0_0_1_1[1]);
    else {
        var a0_0_1_1_1 = ASN1HEX.getPosArrayOfChildren_AtObj(sHEX, a0_0_1_1[1]);
        info.effectiveKey = ASN1HEX.getHexOfV_AtObj(sHEX, a0_0_1_1_1[0]);
        info.encryptionSchemeIV = ASN1HEX.getHexOfV_AtObj(sHEX, a0_0_1_1_1[1])
    }
    var x1 = ASN1HEX.getHexOfV_AtObj(sHEX, a0_0_1_0[0]);
    if (ASN1HEX.getHexOfV_AtObj(sHEX, a0_0_1_0[0]) != "2A864886F70D01050C") throw "this only supports pkcs5PBKDF2";
    var a0_0_1_0_1 = ASN1HEX.getPosArrayOfChildren_AtObj(sHEX, a0_0_1_0[1]);
    if (a0_0_1_0_1.length < 2) throw "malformed format: SEQUENCE(0.0.1.0.1).items < 2: " + a0_0_1_0_1.length;
    info.pbkdf2Salt = ASN1HEX.getHexOfV_AtObj(sHEX, a0_0_1_0_1[0]);
    var iterNumHex = ASN1HEX.getHexOfV_AtObj(sHEX, a0_0_1_0_1[1]);
    try {
        info.pbkdf2Iter = parseInt(iterNumHex, 16)
    } catch (ex) {
        throw "malformed format pbkdf2Iter: " + iterNumHex
    }
    if (info.encryptionSchemeAlg === "RC2") {
        var tamLlave_ = ASN1HEX.getHexOfV_AtObj(sHEX, a0_0_1_0_1[2]);
        try {
            info.tamLlave = parseInt(tamLlave_, 16)
        } catch (ex) {
            throw "malformed format tamLlave: " + tamLlave_
        }
    }
    return info
}

function obtenLlaveDerivada(info, passcode) {
    var pbkdf2SaltWS = CryptoJS.enc.Hex.parse(info.pbkdf2Salt);
    var pbkdf2Iter = info.pbkdf2Iter;
    var pbkdf2KeyWS;
    var hmacSHA1 = function(key) {
        var hasher = new sjcl.misc.hmac(key, sjcl.hash.sha1);
        this.encrypt = function() {
            return hasher.encrypt.apply(hasher, arguments)
        }
    };
    var sjclSalt = sjcl.codec.hex.toBits(info.pbkdf2Salt);
    if (info.encryptionSchemeAlg == "DES" || info.encryptionSchemeAlg == "TripleDES") {
        pbkdf2KeyWS = sjcl.misc.pbkdf2(passcode, sjclSalt, pbkdf2Iter, 192, hmacSHA1)
    } else if (info.encryptionSchemeAlg == "AES-256") {
        pbkdf2KeyWS = sjcl.misc.pbkdf2(passcode, sjclSalt, pbkdf2Iter, 256, hmacSHA1)
    } else if (info.encryptionSchemeAlg == "AES-128") {
        pbkdf2KeyWS = sjcl.misc.pbkdf2(passcode, sjclSalt, pbkdf2Iter, 128, hmacSHA1)
    } else if (info.encryptionSchemeAlg == "AES-192") {
        pbkdf2KeyWS = sjcl.misc.pbkdf2(passcode, sjclSalt, pbkdf2Iter, 192, hmacSHA1)
    } else if (info.encryptionSchemeAlg == "RC2") {
        pbkdf2KeyWS = sjcl.misc.pbkdf2(passcode, sjclSalt, pbkdf2Iter, info.tamLlave, hmacSHA1)
    } else throw "Algoritmo no soportado";
    var pbkdf2KeyHex = sjcl.codec.hex.fromBits(pbkdf2KeyWS);
    return pbkdf2KeyHex
}

function obtieneLlavePrivada(pkcs8DER, passcode) {
    var decWS;
    var info = obtieneInfoPKCS8(pkcs8DER);
    var pbkdf2KeyHex = obtenLlaveDerivada(info, passcode);
    var encrypted = {};
    encrypted.ciphertext = CryptoJS.enc.Hex.parse(info.ciphertext);
    var pbkdf2KeyWS = CryptoJS.enc.Hex.parse(pbkdf2KeyHex);
    var IVWS = CryptoJS.enc.Hex.parse(info.encryptionSchemeIV);
    if (info.encryptionSchemeAlg === "TripleDES") decWS = CryptoJS.TripleDES.decrypt(encrypted, pbkdf2KeyWS, {
        iv: IVWS
    });
    else if (info.encryptionSchemeAlg === "DES") decWS = CryptoJS.DES.decrypt(encrypted, pbkdf2KeyWS, {
        iv: IVWS
    });
    else if (info.encryptionSchemeAlg === "AES-128" || info.encryptionSchemeAlg === "AES-192" || info.encryptionSchemeAlg === "AES-256") decWS = CryptoJS.AES.decrypt(encrypted, pbkdf2KeyWS, {
        iv: IVWS
    });
    else if (info.encryptionSchemeAlg === "RC2") {
        var effectiveKey = CryptoJS.enc.Hex.parse(info.effectiveKey);
        decWS = CryptoJS.RC2.decrypt(encrypted, pbkdf2KeyWS, {
            effectiveKeyBits: info.effectiveKey,
            iv: IVWS
        });
        var decHex = CryptoJS.enc.Hex.stringify(decWS);
        decWS = CryptoJS.RC2.decrypt(encrypted, pbkdf2KeyWS, {
            effectiveKeyBits: effectiveKey,
            iv: IVWS
        });
        var decHex = CryptoJS.enc.Hex.stringify(decWS);
        decWS = CryptoJS.RC2.decrypt(encrypted, pbkdf2KeyWS, {
            iv: IVWS
        });
        var decHex = CryptoJS.enc.Hex.stringify(decWS);
        decWS = CryptoJS.RC2.decrypt(encrypted, pbkdf2KeyWS, {
            effectiveKeyBits: 40,
            iv: IVWS
        });
        var decHex = CryptoJS.enc.Hex.stringify(decWS);
        decWS = CryptoJS.RC2.decrypt(encrypted, pbkdf2KeyWS, {
            effectiveKeyBits: 160,
            iv: IVWS
        });
        var decHex = CryptoJS.enc.Hex.stringify(decWS);
        decWS = CryptoJS.RC2.decrypt(encrypted, pbkdf2KeyWS, {
            effectiveKeyBits: 120,
            iv: IVWS
        });
        var decHex = CryptoJS.enc.Hex.stringify(decWS);
        decWS = CryptoJS.RC2.decrypt(encrypted, pbkdf2KeyWS, {
            effectiveKeyBits: 58,
            iv: IVWS
        });
        var decHex = CryptoJS.enc.Hex.stringify(decWS);
        decWS = CryptoJS.RC2.decrypt(encrypted, pbkdf2KeyWS, {
            effectiveKeyBits: effectiveKey
        })
    }
    var decHex = CryptoJS.enc.Hex.stringify(decWS);
    return decHex
}
