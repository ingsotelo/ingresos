<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyApp\DescargaMasivaCfdi;
use App\MyApp\BusquedaEmitidos;
use App\MyApp\DescargaAsincrona;
use Illuminate\Support\Facades\Storage;

class ImpuestoNominaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('nomina');
    }

    public function registro()
    {
        return view('nomina_registro',['hoy' => date("Y-m-d")]);
    }

    public function declaracion()
    {     
        $descargaCfdi = new DescargaMasivaCfdi();
        $imagenBase64 = $descargaCfdi->obtenerCaptcha();
        $sesionStr = $descargaCfdi->obtenerSesion();
        return view('nomina_declaracion', ['imagenBase64' => $imagenBase64,'sesionStr' => $sesionStr]);
    }

    public function estados()
    {
        return view('nomina_edoscta');
    }

    public function xmlsat(Request $request)
    {
        $contrasenaStr = $request->input('ciec');
        $captchaStr = $request->input('captcha');
        $sesionStr = $request->input('sesionStr');
        $rfcStr = $request->input('rfcStr');
        $maxDescargasSimultaneas = 10;
        $anio = $request->input('ejercicio');
        $a = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
        $mes = array_search($request->input('periodo'),$a)+1;    
        $diaI = 1; //Primer dia del mes siempre es 1
        $diaF = 30; // TODO: Calcular el ultimo dia segun el mes   
        $rutaDescarga ="/descargas/".$rfcStr."/".$anio."/".$mes."/";
        $descargaCfdi = new DescargaMasivaCfdi();
        $descargaCfdi->restaurarSesion($sesionStr);   
        $inicioSesionOk = $descargaCfdi->iniciarSesionCiecCaptcha($rfcStr, $contrasenaStr, $captchaStr);
        if($inicioSesionOk == false) {
            $descargaCfdi = new DescargaMasivaCfdi();
            $imagenBase64 = $descargaCfdi->obtenerCaptcha();
            $sesionStr = $descargaCfdi->obtenerSesion();
            return response()->json(['error'=>"Error al iniciar sesión en el SAT. El captcha o contraseña son incorrectos. Verifique su información e inténtelo de nuevo.",'imagenBase64' => $imagenBase64,'sesionStr' => $sesionStr]);
        }
        $busqueda = new BusquedaEmitidos();
        $busqueda->establecerFechaInicial($anio, $mes, $diaI);
        $busqueda->establecerFechaFinal($anio, $mes, $diaF);
        $xmlInfoArr = $descargaCfdi->buscar($busqueda);
        if($xmlInfoArr){
            $descarga = new DescargaAsincrona($maxDescargasSimultaneas);
            foreach ($xmlInfoArr as $xmlInfo) {
                $descarga->agregarXml(
                    $xmlInfo->urlDescargaXml,
                    $rutaDescarga,
                    $xmlInfo->folioFiscal
                );
            }
            $descarga->procesar();
        }else{
            return response()->json(['error'=>"No se han encontrado CFDIS."]);
        }
        $uuidArr = $descarga->resultado();
        $array = array();
        foreach ($uuidArr as $uuid ) {
            if($uuid["guardado"]){
                $xml = Storage::get($rutaDescarga.$uuid["uuid"].'.xml');
                $timbre = new \SimpleXMLElement($xml);
                $ns = $timbre->getNamespaces(true);

                foreach($timbre->xpath('//cfdi:Comprobante//cfdi:Emisor') as $Emisor){
                    $emisorRFC = $Emisor['Rfc'];
                }

                foreach($timbre->xpath('//cfdi:Comprobante//cfdi:Receptor') as $Receptor){
                    $receptorNombre = strval($Receptor['Nombre']);
                    $receptorRFC = strval($Receptor['Rfc']);
                }

                foreach($timbre->xpath('//cfdi:Comprobante//nomina12:Nomina//nomina12:Receptor') as $Receptor){
                    $receptorCURP = strval($Receptor['Curp']);
                }

                foreach($timbre->xpath('//cfdi:Comprobante') as $Comprobante){
                    $total = strval($Comprobante['Total']);
                } 
                $data['receptorNombre'] = $receptorNombre;
                $data['receptorRFC'] = $receptorRFC;
                $data['receptorCURP'] = $receptorCURP;
                $data['total'] = $total;                   
                array_push($array, $data);
            }
        }
        return response()->json($array); 
    }
}
