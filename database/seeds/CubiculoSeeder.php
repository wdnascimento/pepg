<?php

use Illuminate\Database\Seeder;



class CubiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $galerias = DB::table('galerias')->select('id')->where('tipo',0)->get();
        foreach($galerias as $galeria){
            for($piso= 100;$piso<=200; $piso=$piso+100 ){
                //id, numero, capacidade, galeria_id, created_at, updated_at
                for($cubiculo= 1;$cubiculo<=18; $cubiculo++ ){
                    DB::table('cubiculos')->insert([
                        'numero' => $piso+$cubiculo,
                        'capacidade' => 4,
                        'galeria_id' => $galeria->id
                    ]);
                }
            }
            
        }
        
    }
}
