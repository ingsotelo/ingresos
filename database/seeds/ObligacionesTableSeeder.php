<?php

use Illuminate\Database\Seeder;

class ObligacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obligaciones')->insert([
            'clave' => 'O001',
            'obligacion' => 'NOMINA',
            'finaliza' => 10,
            'impuesto' => 0.02,
            'recargo' => 0.147
        ]);

        DB::table('obligaciones')->insert([
            'clave' => 'O002',
            'obligacion' => 'HOSPEDAJE',
            'finaliza' => 10,
            'impuesto' => 0.03,
            'recargo' => 0.147
        ]);
    }
}
