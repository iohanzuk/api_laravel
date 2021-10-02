<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class DeveloperGetRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'sometimes|string',
            'sexo' => 'sometimes|size:1',
            'idade' => 'sometimes|integer',
            'hobby' => 'sometimes|string',
            'data_nascimento' => 'sometimes|date_format:Y-m-d',
            'perPage' =>'sometimes|integer',
            'page' => 'sometimes|integer',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response['mensagem'] = $validator->errors()->all()[0];

        throw new HttpResponseException(response()->json($response, Response::HTTP_BAD_REQUEST));
    }
}
