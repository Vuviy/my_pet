<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Home\Models\Category;

class ProfessionResource extends JsonResource
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
            'category' => [new CategoryResource(Category::where('id', $this->category_id)->first())],
            'translations' =>
                [
                    'uk' => [
                        'name' => $this->translate('uk')->name,
                    ],
                    'en' => [
                        'name' => $this->translate('en')->name,
                    ],
                ]
        ];
    }
}
