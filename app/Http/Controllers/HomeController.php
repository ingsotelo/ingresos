<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
use PDF;
use Zxing\QrReader;
use Symfony\Component\Process\Process;
use Illuminate\Support\Str;




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
        $perfil = DB::table('perfil')->where('rfc', auth()->user()->name)->first();
        if($perfil == null){
            $codigos = DB::table('codigos')->select('codigo')->distinct()->get();
            $gpoactividades = DB::table('gpoactividades')->get();
            return view('perfil',['gpoactividades' => $gpoactividades,'codigos' => $codigos]);
        }
        $user = DB::table('users')->where('name', auth()->user()->name)->first();
        $actividad = DB::table('actividades')->where('clave_actividades', $perfil->actividad)->first();
        $codigo = DB::table('codigos')->where('id', $perfil->colonia)->first();
        return view('perfil',[
            'perfil' => $perfil,
            'user' => $user,
            'actividad'=> $actividad->descripcion,
            'codigo'=> $codigo,
        ]);
    }

    public function getSubactividades(Request $request)
    {
        $gpoactividad = $request->input('gpoactividad');
        $subactividades = DB::table('subactividades')->where('clave_gpoactividades', $gpoactividad)->get();
        return response()->json($subactividades); 

    }

    public function getActividades(Request $request)
    {
        $subactividad = $request->input('subactividad');
        $actividades = DB::table('actividades')->where('clave_subactividades', $subactividad)->get();
        return response()->json($actividades); 

    }

    public function getCodigos(Request $request)
    {
        $codigo = $request->input('codigo');
        $codigos = DB::table('codigos')->where('codigo', $codigo)->get();
        return response()->json($codigos); 

    }



    public function notificaciones()
    {
        $notificaciones = DB::table('notificaciones')->where('rfc', auth()->user()->name)->get();
        return view('notificaciones',['notificaciones' => $notificaciones]);

    }

    public function savePerfil(Request $request)
    {          

        $validator = Validator::make($request->all(), [            
            'rfc' => 'required',
            'nombre' => 'required',       
        ]);

        if ($validator->fails()) {
            return response()->json([
               'message'   => 'error',
               'errors' => $validator->errors()->all(),
              ]); 
        }    
        
        $user = DB::table('users')->where('name', '=', $request->input('rfc'))->first();
        $actividad = DB::table('actividades')->where('clave_actividades', '=', $request->input('actividad'))->first();
        $subactividad = DB::table('subactividades')->where('clave_subactividades', '=', $actividad->clave_subactividades)->first();
        $gpoactividad = DB::table('gpoactividades')->where('clave_gpoactividades', '=', $subactividad->clave_gpoactividades)->first();
        $codigo = DB::table('codigos')->where('id', '=', $request->input('colonia'))->first();
        $data = 
         [
            'rfc' => $request->input('rfc'),
            'curp' => $user->curp,
            'nombre' => $user->full_name,
            'email' => $user->email,
            'actividad' => $actividad->descripcion,
            'subactividad' => $subactividad->descripcion,
            'gpoactividad' => $gpoactividad->descripcion,
            'colonia' => $codigo->colonia,
            'municipio' => $codigo->municipio,
            'ciudad' => $codigo->ciudad,
            'codigo' => $codigo->codigo,
            'calle' => $request->input('calle'),
            'numero' => $request->input('exterior'),
            'fijo' =>   $request->input('fijo'),
            'movil' => $request->input('movil'),
            'qrcode' => "Este es el link de la informacion del archivo"
         ];
        
        Storage::disk('local')->put('notificacion/perfil/'.$request->input('rfc').'/'.$request->input('rfc').'.pdf', PDF::loadView('pdf_perfil', $data)->output());
        
        DB::table('notificaciones')->insert(
            [
                'rfc' => $request->input('rfc'), 
                'nombre' => 'Registro del Perfil del Contribuyente', 
                'documento' => 'notificacion/perfil/'.$request->input('rfc').'/'.$request->input('rfc').'.pdf',
                'tipo' => 'perfil', 
                'created_at' => Carbon::now()->toDateTimeString(),
            ]
        );

        if ($request->hasFile('fiscal')){
            Storage::disk('local')->putFileAs('notificacion/perfil/'.$request->input('rfc'),$request->file('fiscal'),'CSF_'.$request->input('rfc').'.pdf');
        }

        if ($request->hasFile('domicilio')){
            Storage::disk('local')->putFileAs('notificacion/perfil/'.$request->input('rfc'),$request->file('domicilio'),'CD_'.$request->input('rfc').'.pdf');
        }
            
        try {
            DB::table('perfil')->insert([
                'rfc' => $request->input('rfc'), 
                'nombre' => $request->input('nombre'),
                'paterno' => $request->input('paterno'),
                'materno' => $request->input('materno'),
                'actividad' => $request->input('actividad'),
                'colonia' => $request->input('colonia'),
                'calle' => $request->input('calle'),
                'exterior' => $request->input('exterior'),
                'interior' => ($request->input('interior') == null) ? '' : $request->input('interior'),
                'fijo' => $request->input('fijo'),
                'movil' => $request->input('movil'),
                'constancia' => 'notificacion/perfil/'.$request->input('rfc').'/CSF_'.$request->input('rfc').'.pdf',
                'comprobante' => 'notificacion/perfil/'.$request->input('rfc').'/CD_'.$request->input('rfc').'.pdf',
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
        } catch (\Exception $e) {
             return response()->json([
                'message'   => 'error',
                'errors' => $e,
            ]);
        }
 
        return response()->json([
            'message'   => 'success',
            'errors' => '',
        ]);
    }

    public function perfilDownload($rfc)
    {
        return Storage::download('notificacion/perfil/'.$rfc.'/'.$rfc.'.pdf');
    }

    public function constanciaDownload($rfc)
    {
        return Storage::download('notificacion/perfil/'.$rfc.'/CSF_'.$rfc.'.pdf');
    }

    public function comprobanteDownload($rfc)
    {
        return Storage::download('notificacion/perfil/'.$rfc.'/CD_'.$rfc.'.pdf');
    }

    public function getpdf($file)
    {   
        return Storage::download(str_replace('%', '/', $file));
    }

    public function getPdfdata(request $request)
    {
        
        //poppler-utils
           
        if($request->hasFile('fiscal')){
            $tmpFileName = Str::random(40);
            Storage::disk('local')->putFileAs('tmp',$request->file('fiscal'),$tmpFileName);
            $processImages = new Process('pdfimages -all '.storage_path('app/tmp/').$tmpFileName.' '.storage_path('app/tmp/').$tmpFileName); 
            $processText = new Process('pdftotext '.storage_path('app/tmp/').$tmpFileName.' '.storage_path('app/tmp/').$tmpFileName.'.log');
            try{
                $processImages->mustRun();
                $processText->mustRun();
            }catch (ProcessFailedException $e){
                return response()->json([
                    'message'   =>  null,
                    'errors' => $e->getMessage(),
                ]);   
            }
            //Storage::delete('tmp/'.$tmpFileName.'.log');
            //Storage::delete('tmp/'.$tmpFileName);

        }else{        
            return response()->json([
                'message'   => null,
                'errors' => 'no file uploaded',
            ]);
        }
    }
}
