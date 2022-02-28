<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'module_id' => $this->id,
            'name' => ucwords(strtolower($this->name)), //conversãop do primeiro caractere das palavras para maiusculo
            'description' =>$this->description ,
            'video' => $this->video,
        ];
    }
}
