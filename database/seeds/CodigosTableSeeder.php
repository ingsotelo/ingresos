<?php

use Illuminate\Database\Seeder;

class CodigosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	if(($handle = fopen (public_path().'/Guerrero.csv','r')) !== FALSE) {
    		
    		while( ($csv_data = fgetcsv ( $handle, 1000, '|' )) != FALSE ){
    			
    			$codigo = (int)$csv_data[0];
    			$colonia = $csv_data[1];
    			$municipio = $csv_data[2];
    			$ciudad = $csv_data[3];

		    	DB::table('codigos')->insert([
		            'codigo' => $codigo,
		            'colonia' => $colonia,
		            'municipio' => $municipio,
		            'ciudad' => ($ciudad == 'null') ? $municipio : $ciudad
		        ]);

    		}
    		fclose($handle);
    	}


        
    }
}
