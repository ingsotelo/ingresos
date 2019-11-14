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
        DB::table('actividades')->insert([
            'clave' => '01',
            'descripcion' => 'Recursos Naturales'
        ]);

        DB::table('actividades')->insert([
            'clave' => '02',
            'descripcion' => 'Construcción'
        ]);
        DB::table('actividades')->insert([
            'clave' => '03',
            'descripcion' => 'Fabricación, producción o elaboración'
        ]);

        DB::table('actividades')->insert([
            'clave' => '04',
            'descripcion' => 'Comercio al por mayor'
        ]);
        DB::table('actividades')->insert([
            'clave' => '05',
            'descripcion' => 'Comercio al por menor'
        ]);

        DB::table('actividades')->insert([
            'clave' => '06',
            'descripcion' => 'Transporte'
        ]);
        DB::table('actividades')->insert([
            'clave' => '07',
            'descripcion' => 'Comunicación'
        ]);

        DB::table('actividades')->insert([
            'clave' => '08',
            'descripcion' => 'Servicios'
        ]);
        DB::table('actividades')->insert([
            'clave' => '09',
            'descripcion' => 'Otros Ingresos'
        ]);

        DB::table('actividades')->insert([
            'clave' => '10',
            'descripcion' => 'Gobierno'
        ]);
    }
}








