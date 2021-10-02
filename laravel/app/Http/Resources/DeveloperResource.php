<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeveloperResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'idade' => $this->idade,
            'sexo' => $this->sexo,
            'hobby' => $this->hobby,
            'data_nascimento' => $this->datanascimento,
        ];
    }
}
