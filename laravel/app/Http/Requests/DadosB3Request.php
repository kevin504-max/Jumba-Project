<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DadosB3Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "id_open_position"  => "nullable",
            "RptDt"             => "nullable",
            "TckrSymb"          => "nullable",
            "Asst"              => "nullable",
            "BalQty"            => "nullable",
            "TradAvrgPric"      => "nullable",
            "PricFctr"          => "nullable",
            "BalVal"            => "nullable",
        ];
    }
}
