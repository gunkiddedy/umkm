<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'brand' => $this->brand,
            'price' => $this->price,
            'description' => $this->description,
            'user_id' => $this->user_id,
            'provinsi_id' => $this->provinsi_id,
            'kabupaten_id' => $this->kabupaten_id,
            'kecamatan_id' => $this->kecamatan_id,
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
            'hs_code' => $this->hs_code,
            'sni' => $this->sni,
            'company_name' => $this->company_name,
            'image_path' => $this->image_path
        ];
    }
}
