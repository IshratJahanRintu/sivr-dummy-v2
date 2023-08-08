<?php

namespace App\Repositories;

use App\Models\SivrApiCompare;
use App\Models\SivrPageElement;

class SivrPageElementRepository
{

    public function create(array $data)
    {

        $sivrPageElement = SivrPageElement::query()->create([

            'page_id' => $data['page_id'],
            'type' => $data['type'],
            'display_name_bn' => $data['display_name_bn'],
            'display_name_en' => $data['display_name_en'],
            'background_color' => $data['background_color'],
            'text_color' => $data['text_color'],
            'name' => $data['name'] ?? null,
            'element_properties' => $data['element_properties'],
            'element_order' => $data['element_order'],
            'rows' => $data['rows'] ?? 0,
            'columns' => $data['columns'] ?? 0,
            'is_visible' => $data['is_visible'],
            'data_provider_function' => $data['data_provider_function'],

        ]);

        $element_id = $sivrPageElement->id;

        if ($data['type'] == 'compare_api') {

            for ($i = 0; $i < $data['compare_count']; $i++) {


                SivrApiCompare::query()->create([
                    'page_id' => $data['page_id'],
                    'element_id' => $element_id,
                    'api_key' => $data['compare_api_key'],
                    'comparison' => $data['compare_api_comparison'][$i],
                    'key_value' => $data['compare_api_key_value'][$i],
                    'transfer_page_id' => $data['compare_api_transfer_page_id'][$i],
                    'transfer_option' => $data['compare_api_transfer_options'][$i],
                ]);
            }

        }

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

            'element_order' => $data['element_order'],
            'rows' => $data['rows'] ?? 0,
            'columns' => $data['columns'] ?? 0,
            'is_visible' => $data['is_visible'],
            'data_provider_function' => $data['data_provider_function'],
            'element_properties' => $data['element_properties'],


        ]);
        if ($data['type'] == 'compare_api') {
            $sivrPageElement->compareApis()->delete();
            for ($i = 0; $i < $data['compare_count']; $i++) {


                SivrApiCompare::query()->create([
                    'page_id' => $sivrPageElement->page_id,

                    'element_id' => $sivrPageElement->id,
                    'api_key' => $data['compare_api_key'],
                    'comparison' => $data['compare_api_comparison'][$i],
                    'key_value' => $data['compare_api_key_value'][$i],
                    'transfer_page_id' => $data['compare_api_transfer_page_id'][$i],
                    'transfer_option' => $data['compare_api_transfer_options'][$i],
                ]);
            }

        }
        return $updated;

    }

    public function deleteItem(SivrPageElement $sivrPageElement)
    {

        return $sivrPageElement->forceDelete();
    }

    public function storeAudio(array $data, SivrPageElement $pageElement)
    {
        $pageElement->update([
            'menu_icon' => $data['menu_icon'],

        ]);
        return $pageElement;
    }

}



