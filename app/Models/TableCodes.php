<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableCodes extends Model
{
    protected $fillable = ['id', 'pai', 'item', 'valor', 'descricao'];

    public function select($pai, $flag = NULL){
        if($flag){
            return $this->where('pai',$pai)->where('flag',$flag)->where('item','<>',0)->orderBy('descricao')->get()->pluck('descricao','valor');
        }else{
            return $this->where('pai',$pai)->where('item','<>',0)->orderBy('descricao')->get()->pluck('descricao','valor');
        }
        
    }

    public function selectExcept($pai,$item){
        return $this->where('pai',$pai)->where('item','<>',0)->where('item','<>',$item)->orderBy('descricao')->get()->pluck('descricao','valor');
    }

    public function getDescricaoById($pai,$valor){
        return $this->select('descricao')->where('pai',$pai)->where('item','=',$valor)->first()->toArray();
    }
}
