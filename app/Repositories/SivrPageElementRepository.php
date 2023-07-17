<?php

namespace App\Repositories;

use App\Models\SivrPageElement;

class SivrPageElementRepository
{

    public function listing()
    {

    }

    public function show($id)
    {


    }


    public function create(array $data)
    {

        SivrPageElement::query()->create([

            'page_id' => $data['page_id'],
            'type' => $data['type'],
            'display_name_bn' =>$data['display_name_bn'],
            'display_name_en' =>$data['display_name_en'],
            'background_color' =>$data['background_color'],
            'text_color' => $data['text_color'],
            'name' => $data['name'] ?? null,
            'value' => $data['value'] ?? null,
            'element_order' => $data['element_order'],
            'rows' => $data['rows'] ?? 0,
            'columns' => $data['columns'] ?? 0,
            'is_visible' => $data['is_visible'],
            'data_provider_function' =>$data['data_provider_function'],


        ]);

      return $data['page_id'];
    }


    public function update(array $data, SivrPageElement $sivrPageElement)
    {

        // Update user detail
        $updated = $sivrPageElement->update([

            'type' => $data['type'],
            'display_name_bn' => $data['display_name_bn'],
            'display_name_en' => $data['display_name_en'],
            'background_color' => $data['background_color'],
            'text_color' => $data['text_color'],
            'name' => $data['name'],
            'value' => $data['value'],
            'element_order' => $data['element_order'],
            'rows' => $data['rows']??0,
            'columns'=>$data['columns']??0,
            'is_visible' => $data['is_visible'],
            'data_provider_function' => $data['data_provider_function'],


        ]);
        return $updated;

    }

    public function deleteItem(SivrPageElement $sivrPageElement)
    {

       return $sivrPageElement->forceDelete();
    }

}



