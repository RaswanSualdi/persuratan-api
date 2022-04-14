<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
// use App\Http\Controllers\API\ResponseFormatter;

class MdLettersResource extends JsonResource
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
            // 'current_page'=>$this->current_page,
             'id'=>$this->id,
            'letter'=>$this->letter,
            'slug'=>$this->slug,
            'detail'=> 'http://127.0.0.1:8000/api/letters/'.$this->id,
            

        ];



        
    }
}
