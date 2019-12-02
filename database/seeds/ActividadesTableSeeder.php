<?php

use Illuminate\Database\Seeder;

class ActividadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if(($handle = fopen (public_path().'/Actividades.csv','r')) !== FALSE) {
            
            while( ($csv_data = fgetcsv ( $handle, 1000, '|' )) != FALSE ){
                $codigo = $csv_data[0];
                $descripcion = $csv_data[1];
                if(strlen($codigo) == 2){
                    DB::table('gpoactividades')->insert([
                        'clave_gpoactividades' => $codigo,
                        'descripcion' => strtoupper ( $descripcion )
                    ]);
                }elseif(strlen($codigo) == 3){
                    $codigoGpo = substr($codigo, 0, 2);
                    DB::table('subactividades')->insert([
                        'clave_gpoactividades' => $codigoGpo,
                        'clave_subactividades' => $codigo,
                        'descripcion' => strtoupper ( $descripcion )
                    ]);
                }elseif(strlen($codigo) > 3){
                    $codigoSub = substr($codigo, 0, 3);
                    DB::table('actividades')->insert([
                        'clave_subactividades' => $codigoSub,
                        'clave_actividades' => $codigo,
                        'descripcion' => strtoupper ( $descripcion )
                    ]);
                }

            }
            fclose($handle);
        }
        

    }
}








