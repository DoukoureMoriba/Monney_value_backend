<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PairResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'id_sources' => $this->id_sources,
            'currency_sources' => $this->sourceCurrency->code_currency,
            'id_target' => $this->id_target,
            'currency_target' => $this->targetCurrency->code_currency,
            'conversion_rates' => $this->conversion_rates,
            'count' => $this->count,
        ];
    }
}
