<?php

use Illuminate\Database\Seeder;

class GaleriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('galerias')->insert([
            'titulo' => 'Galeria A',
            'unidade_id' => 1,
            'tipo' => 0
        ]);

        DB::table('galerias')->insert([
            'titulo' => 'Galeria B',
            'unidade_id' => 1,
            'tipo' => 0
        ]);

        DB::table('galerias')->insert([
            'titulo' => 'Galeria C',
            'unidade_id' => 1,
            'tipo' => 0
        ]);

        DB::table('galerias')->insert([
            'titulo' => 'Isolamento',
            'unidade_id' => 1,
            'tipo' => 1

        ]);
    }
}
