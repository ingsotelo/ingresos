<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyApp\DescargaMasivaCfdi;
use App\MyApp\BusquedaEmitidos;
use App\MyApp\DescargaAsincrona;
use Illuminate\Support\Facades\Storage;

class ImpuestoHospedajeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('hospedaje');
    }

    public function registro()
    {
        return view('hospedaje_registro',['hoy' => date("Y-m-d")]);
    }

    public function declaracion()
    {     
        $descargaCfdi = new DescargaMasivaCfdi();
        $imagenBase64 = $descargaCfdi->obtenerCaptcha();
        $sesionStr = $descargaCfdi->obtenerSesion();
        return view('hospedaje_declaracion', ['imagenBase64' => $imagenBase64,'sesionStr' => $sesionStr]);
    }

    public function estados()
    {
        return view('hospedaje_edoscta');
    }
}
