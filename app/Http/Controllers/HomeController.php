<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PDF;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function perfil()
    {

        $actividades = DB::table('actividades')->get();
        return view('perfil',['actividades' => $actividades]);
    }

    public function getSubactividades(Request $request)
    {
        $actividad = $request->input('actividad');
        $subactividades = DB::table('subactividades')->where('clave', $actividad)->get();
        return response()->json($subactividades); 

    }

    public function notificaciones()
    {
        $notificaciones = DB::table('notificaciones')->where('rfc', auth()->user()->name)->get();
        return view('notificaciones',['notificaciones' => $notificaciones]);

    }

    public function savePerfil(Request $request)
    {
        $subactividad = DB::table('subactividades')->where('clave_actividades', '=', $request->input('actividad'))->first();
        $actividad = DB::table('actividades')->where('clave', '=', $subactividad->clave)->first();
        $data = 
         [
            'rfc' => $request->input('rfc'),
            'curp' => $request->input('curp'),
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'actividad' => $actividad->descripcion,
            'subactividad' => $subactividad->descripcion,
            'codigo' => $request->input('codigo'),
            'municipio' => $request->input('municipio'),
            'ciudad' => $request->input('ciudad'),
            'colonia' => $request->input('colonia'),
            'calle' => $request->input('calle'),
            'numero' => $request->input('numero'),
            'notificacion' => $request->input('notificacion'),
            'qrcode' => "Este es el link de la informacion del archivo"
         ];
        
        Storage::disk('local')->put('notificacion/perfil/'.$request->input('rfc').'.pdf', PDF::loadView('pdf_download', $data)->output());           
        DB::table('notificaciones')->insert(
            [
                'rfc' => $request->input('rfc'), 
                'nombre' => $request->input('notificacion'), 
                'documento' => 'notificacion/perfil/'.$request->input('rfc').'.pdf',
                'created_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        return response()->json(['error'=>"No se pudo guardar los datos"]);
    }

    


    public function pdfDownload(){

    }
}
