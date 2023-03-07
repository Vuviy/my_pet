<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'median' => $this->median,
            'average' => $this->average,
            'cost_live' => $this->cost_live,
            'rent' => $this->rent,
            'square_meter' => $this->square_meter,
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
