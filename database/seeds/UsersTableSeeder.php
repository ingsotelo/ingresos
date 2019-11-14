<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'SOSS821123JK1',
            'full_name' => 'SALOMON SOTELO SUASTEGUI',
            'curp' => 'SOSS821123HGRTSL19',
            'email' => 'ing.sotelo@outlook.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
