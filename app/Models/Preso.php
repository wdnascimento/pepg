<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preso extends Model
{
    protected $fillable = ['prontuario','nome','rg','mae','data_nascimento','artigos','situacao','origem','url_foto','data_prisao','data_depen','data_entrada']; 

    

}
