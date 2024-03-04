<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'idAnimal' => $this->idAnimal,
            'dateLost' => $this->dateLost,
            'dateFind' => $this->dateFind,
            'place' => $this->place,
            'description' => $this->description,
            'alerteFound' => $this->alerteFound,
        ];
    }
}
