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
            'display_name_bn' => $data['display_name_bn']??null,
            'display_name_en' => $data['display_name_en']??null,
            'background_color' => $data['background_color'],
            'text_color' => $data['text_color'],

            'element_properties' => $data['element_properties'],
            'element_order' => $data['element_order'],
            'is_visible' => $data['is_visible'],
            'data_provider_function' => $data['data_provider_function']??null,

        ]);

        $element_id = $sivrPageElement->id;

        if ($data['type'] == 'compare_api') {

            for ($i = 0; $i < $data['compare_count']; $i++) {


                SivrApiCompare::query()->create([
                    'page_id' => $data['page_id']??null,
                    'element_id' => $element_id??null,
                    'api_key' => $data['compare_api_key'][$i]??null,
                    'comparison' => $data['compare_api_comparison'][$i]??null,
                    'key_value' => $data['compare_api_key_value'][$i]??null,
                    'transfer_page_id' => $data['compare_api_transfer_page_id'][$i]??null,
                    'transfer_option' => $data['compare_api_transfer_options'][$i],
                    'goto_page_id'=>$data['compare_api_goto_page_id'][$i]??null,
                    'back_page_id'=>$data['compare_api_back_page_id'][$i]??null,

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
            'display_name_bn' => $data['display_name_bn']??null,
            'display_name_en' => $data['display_name_en']??null,
            'background_color' => $data['background_color'],
            'text_color' => $data['text_color'],

            'element_order' => $data['element_order'],
            'is_visible' => $data['is_visible'],
            'data_provider_function' => $data['data_provider_function']??null,
            'element_properties' => $data['element_properties'],


        ]);
        if ($data['type'] == 'compare_api') {
            $sivrPageElement->compareApis()->delete();
            for ($i = 0; $i < $data['compare_count']; $i++) {

                SivrApiCompare::query()->create([

                    'page_id' => $sivrPageElement->page_id,
                    'element_id' => $sivrPageElement->id??null,
                    'api_key' => $data['compare_api_key'][$i]??null,
                    'comparison' => $data['compare_api_comparison'][$i]??null,
                    'key_value' => $data['compare_api_key_value'][$i]??null,
                    'transfer_page_id' => $data['compare_api_transfer_page_id'][$i]??null,
                    'goto_page_id'=>$data['compare_api_goto_page_id'][$i]??null,
                    'transfer_option' => $data['compare_api_transfer_options'][$i]??null,
                    'back_page_id'=>$data['compare_api_back_page_id'][$i]??null,

                ]);
            }

        }
        return $updated;

    }

    public function deleteItem(SivrPageElement $sivrPageElement)
    {

        return $sivrPageElement->forceDelete();
    }

    public function storeIcon(array $data, SivrPageElement $pageElement)
    {
        $pageElement->update([
            'menu_icon' => $data['menu_icon'],

        ]);
        return $pageElement;
    }

}



