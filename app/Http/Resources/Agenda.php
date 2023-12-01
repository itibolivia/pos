<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Agenda extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => strtoupper($this->accion) . ' Prospecto: ' . $this->prospecto->persona->nombre,
            'start' => $this->fecha .'T'.$this->hora,
            'color' => '#1ABC9C',
            'textColor' => '#ffffff',
        ];
    }
}
