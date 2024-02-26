<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultatAprenentageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return [
        //     'id' => $this->id,
        //     'ordre' => $this->ordre,
        //     'descripcio' => $this->descripcio,
        //     'actiu' => $this->actiu,
        //     'moduls_id' => $this->moduls_id,
        //     'criterisAvaluacio' => $this->criterisAvaluacio->map(function ($criteri) {
        //         return [
        //             'id' => $criteri->id,
        //             'ordre' => $criteri->ordre,
        //             'descripcio' => $criteri->descripcio,
        //             'actiu' => $criteri->actiu,
        //             'rubrica' => $criteri->rubrica
        //         ];
        //     }),
        // ];
        return parent::toArray($request); 
    }
}
