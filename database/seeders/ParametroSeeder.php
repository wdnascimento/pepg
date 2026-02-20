<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParametroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parametros')->insert([
            'titulo' => 'limite_atendimento',
            'valor' => '3',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('parametros')->insert([
            'titulo' => 'tempo_limite_atendimento',
            'valor' => '30',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
