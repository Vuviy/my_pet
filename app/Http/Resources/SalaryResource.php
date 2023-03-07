<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Home\Models\Country;
use Modules\Home\Models\Profession;

class SalaryResource extends JsonResource
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
            'amount' => $this->amount,
            'profession' => [new ProfessionResource(Profession::where('id', $this->profession_id)->first())],
            'country' => [new CountryResource(Country::where('id', $this->country_id)->first())] ,
            'respect_index' => $this->respect_index,
        ];
    }
}
