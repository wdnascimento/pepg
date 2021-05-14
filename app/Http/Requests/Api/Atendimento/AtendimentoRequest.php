<?php

namespace App\Http\Requests\Api\Atendimento;

use Illuminate\Foundation\Http\FormRequest;

class AtendimentoRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //
        ];
    }

    public function messages(){
        return [

        ];
    }

    public function attributes()
    {
        return [

        ];
    }
}
