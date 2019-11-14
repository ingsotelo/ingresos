<?php

use Illuminate\Database\Seeder;

class SubactividadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subactividades')->insert([
            'clave' => '01',
            'descripcion' => 'Agricultura',
            'clave_actividades' => '0101'
        ]);
        DB::table('subactividades')->insert([
            'clave' => '01',
            'descripcion' => 'Ganadería',
            'clave_actividades' => '0102'
        ]);
		DB::table('subactividades')->insert([
		    'clave' => '01',
		    'descripcion' => 'Silvicultura',
		    'clave_actividades' => '0103'
		]);
		DB::table('subactividades')->insert([
		    'clave' => '01',
		    'descripcion' => 'Pesca',
		    'clave_actividades' => '0104'
		]);
		DB::table('subactividades')->insert([
		    'clave' => '01',
		    'descripcion' => 'Minería y extracción de petróleo y gas',
		    'clave_actividades' => '0105'
		]);
		DB::table('subactividades')->insert([
		    'clave' => '01',
		    'descripcion' => 'Generación y suministro de energía eléctrica, agua y gas',
		    'clave_actividades' => '0106'
		]);

		DB::table('subactividades')->insert([
		    'clave' => '02',
		    'descripcion' => 'Vivienda, comercial e industrial',
		    'clave_actividades' => '0201'
		]);

		DB::table('subactividades')->insert([
		    'clave' => '02',
		    'descripcion' => 'Obras de ingeniería civil',
		    'clave_actividades' => '0202'
		]);


		DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Alimentos, embutidos, agua o hielo',
		    'clave_actividades' => '0301'
		]);

DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Dulces, chocolates, botanas y similares',
		    'clave_actividades' => '0302'
		]);

DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Conservas, corte y empacado',
		    'clave_actividades' => '0303'
		]);

DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Pan, tortillas, harinas y cereales',
		    'clave_actividades' => '0304'
		]);

DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Bebidas no alcohólicas y concentrados para prepararlas',
		    'clave_actividades' => '0305'
		]);

DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Bebidas con contenido alcohólico y tabacos',
		    'clave_actividades' => '0306'
		]);

DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Textiles e insumos textiles',
		    'clave_actividades' => '0307'
		]);

DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Prendas y accesorios de vestir y calzado',
		    'clave_actividades' => '0308'
		]);

DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Impresión, madera, papel, cartón y pañales',
		    'clave_actividades' => '0310'
		]);

DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Química y del petróleo',
		    'clave_actividades' => '0311'
		]);

DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Plástico, hule, pegamentos, pinturas y llantas',
		    'clave_actividades' => '0312'
		]);

DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Industria metálica y productos metálicos',
		    'clave_actividades' => '0313'
		]);

DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Maquinaria y equipo industrial, comercial y doméstico',
		    'clave_actividades' => '0314'
		]);

DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Equipo de oficina, comunicación y eléctrico y productos relacionados',
		    'clave_actividades' => '0315'
		]);

DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Equipo de transporte y productos relacionados',
		    'clave_actividades' => '0316'
		]);

DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Equipo médico, deportivo, juguetes, farmacéuticos y perfumería y otros productos',
		    'clave_actividades' => '0317'
		]);

DB::table('subactividades')->insert([
		    'clave' => '03',
		    'descripcion' => 'Vidrio, arcilla, loza, cemento y minerales no metálicos',
		    'clave_actividades' => '0318'
		]);
DB::table('subactividades')->insert([
		    'clave' => '04',
		    'descripcion' => 'Abarrotes, carnes, pescados, leche, frutas o verduras, pan y pasteles al por mayor',
		    'clave_actividades' => '0401'
		]);

DB::table('subactividades')->insert([
		    'clave' => '04',
		    'descripcion' => 'Dulces, botanas, helados, hielo y bebidas no alcohólicas al por mayor',
		    'clave_actividades' => '0402'
		]);

DB::table('subactividades')->insert([
		    'clave' => '04',
		    'descripcion' => 'Bebidas con contenido alcohólico, alcohol y tabacos al por mayor',
		    'clave_actividades' => '0403'
		]);

DB::table('subactividades')->insert([
		    'clave' => '04',
		    'descripcion' => 'Textiles, prendas de vestir, joyas y calzado al por mayor',
		    'clave_actividades' => '0404'
		]);

DB::table('subactividades')->insert([
		    'clave' => '04',
		    'descripcion' => 'Perfumería, farmacia, juguetes, artículos deportivos al por mayor',
		    'clave_actividades' => '0405'
		]);

DB::table('subactividades')->insert([
		    'clave' => '04',
		    'descripcion' => 'Maquinaria y equipo industrial, eléctrico, comercial, doméstico y de transporte al por mayor',
		    'clave_actividades' => '0406'
		]);

DB::table('subactividades')->insert([
		    'clave' => '04',
		    'descripcion' => 'Papelería, papel, madera, construcción y desechos al por mayor',
		    'clave_actividades' => '0407'
		]);

DB::table('subactividades')->insert([
		    'clave' => '04',
		    'descripcion' => 'Otros productos y servicios al por mayor',
		    'clave_actividades' => '0408'
		]);

DB::table('subactividades')->insert([
		    'clave' => '05',
		    'descripcion' => 'Abarrotes, carnes, pescados, leche, frutas o verduras, pan, pasteles y otros alimentos al por menor',
		    'clave_actividades' => '0501'
		]);

DB::table('subactividades')->insert([
		    'clave' => '05',
		    'descripcion' => 'Bebidas con contenido alcohólico, alcohol y tabacos al por menor',
		    'clave_actividades' => '0502'
		]);

DB::table('subactividades')->insert([
		    'clave' => '05',
		    'descripcion' => 'Textiles, prendas de vestir, joyas y calzado al por menor',
		    'clave_actividades' => '0503'
		]);

DB::table('subactividades')->insert([
		    'clave' => '05',
		    'descripcion' => 'Perfumería, farmacia, juguetes, regalos, artículos naturistas y deportivos al por menor',
		    'clave_actividades' => '0504'
		]);

DB::table('subactividades')->insert([
		    'clave' => '05',
		    'descripcion' => 'Maquinaria y equipo industrial, eléctrico, comercial, doméstico y de transporte al por menor',
		    'clave_actividades' => '0505'
		]);

DB::table('subactividades')->insert([
		    'clave' => '05',
		    'descripcion' => 'Autotransporte y refacciones, gas, gasolina y diesel al por menor',
		    'clave_actividades' => '0506'
		]);

DB::table('subactividades')->insert([
		    'clave' => '05',
		    'descripcion' => 'Lentes, libros, papelería, súper y minisúper al por menor',
		    'clave_actividades' => '0507'
		]);

DB::table('subactividades')->insert([
		    'clave' => '05',
		    'descripcion' => 'Otros productos al por menor',
		    'clave_actividades' => '0508'
		]);

DB::table('subactividades')->insert([
		    'clave' => '06',
		    'descripcion' => 'Aéreo, marítimo y ferrocarril',
		    'clave_actividades' => '0601'
		]);

DB::table('subactividades')->insert([
		    'clave' => '06',
		    'descripcion' => 'Terrestre de carga',
		    'clave_actividades' => '0601'
		]);

DB::table('subactividades')->insert([
		    'clave' => '06',
		    'descripcion' => 'Terrestre de pasaje y turismo',
		    'clave_actividades' => '0601'
		]);

DB::table('subactividades')->insert([
		    'clave' => '06',
		    'descripcion' => 'Por ductos',
		    'clave_actividades' => '0601'
		]);

DB::table('subactividades')->insert([
		    'clave' => '06',
		    'descripcion' => 'Servicios relacionados con el autotransporte',
		    'clave_actividades' => '0601'
		]);

DB::table('subactividades')->insert([
		    'clave' => '06',
		    'descripcion' => 'Mensajería y almacenamiento',
		    'clave_actividades' => '0601'
		]);






DB::table('subactividades')->insert([
		    'clave' => '07',
		    'descripcion' => 'Medios impresos, bibliotecas y de información',
		    'clave_actividades' => '0701'
		]);

DB::table('subactividades')->insert([
		    'clave' => '07',
		    'descripcion' => 'Radio, televisión, cine y música',
		    'clave_actividades' => '0701'
		]);

DB::table('subactividades')->insert([
		    'clave' => '07',
		    'descripcion' => 'Telecomunicaciones',
		    'clave_actividades' => '0701'
		]);

DB::table('subactividades')->insert([
		    'clave' => '07',
		    'descripcion' => 'Otros servicios relacionados con la comunicación',
		    'clave_actividades' => '0701'
		]);






DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Apoyo a subactividades agropecuarias y forestales',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Apoyo a la construcción',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Financieros',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Alquiler',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Profesionales',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Técnicos',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Educativos',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Salud',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Asistencia o rehabilitación, culturales y ecológicas',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Orientación, capacitación y guarderías',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Agencias, investigación de mercado, publicidad y turismo',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Apoyo a los negocios y manejo de desechos',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Recreativos',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Juegos y apuestas',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Hospedaje',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Alimentos y bebidas',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Otros servicios',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Cámaras, gremios y agrupaciones',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Servicios inmobiliarios y de administración de inmuebles',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Guía de turismo',
		    'clave_actividades' => '0801'
		]);

DB::table('subactividades')->insert([
		    'clave' => '08',
		    'descripcion' => 'Otros servicios de apoyo',
		    'clave_actividades' => '0801'
		]);


DB::table('subactividades')->insert([
		    'clave' => '09',
		    'descripcion' => 'Otros ingresos',
		    'clave_actividades' => '0901'
		]);


DB::table('subactividades')->insert([
		    'clave' => '10',
		    'descripcion' => 'Exclusivas sector gobierno',
		    'clave_actividades' => '1001'
		]);


    }
}

































