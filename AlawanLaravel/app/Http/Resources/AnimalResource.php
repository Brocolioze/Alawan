<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnimalResource extends JsonResource
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
            'idPerson' => $this->idPerson,
            'idRace' => $this->idRace,
            'idNecklace' => $this->idNecklace,
            'name' => $this->name,
            'picture' => $this->picture,
            'birth' => $this->birth,
            'research' => $this->research,
        ];
    }
}
