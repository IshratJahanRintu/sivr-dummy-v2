<?php

namespace App\Traits;


use Illuminate\Support\Str;
use stdClass;


trait PageElementTrait
{

protected function createElementProperties(array &$data){
    $jsonObject = [];
    $inputFields = [
        'button_type',
        'button_value',
        'button_api_keys',
        'button_api_data_comparison',
        'button_api_data_calculation',
        'button_transfer_options',
        'button_transfer_page_id',
        'paragraph_api_keys',
        'paragraph_api_data_comparison',
        'paragraph_api_data_calculation',
        'paragraph_web_address_bn',
        'paragraph_web_address_en',
        'table_key_id',
        'table_key_comparison',
        'table_key_calculation',
        'table_type',
        'table_heading_bn',
        'table_heading_en',
        'compare_count',
        'input_type',
        'input_text_placeholder_bn',
        'input_text_placeholder_en',
        'input_text_min_length',
        'input_text_max_length',
        'input_text_pattern',
        'input_text_default_value',
        'input_text_required',
        'input_number_placeholder_bn',
        'input_number_placeholder_en',
        'input_number_min_length',
        'input_number_max_length',
        'input_number_pattern',
        'input_number_default_value',
        'input_number_required',
        'input_password_placeholder_bn',
        'input_password_placeholder_en',
        'input_password_min_length',
        'input_password_max_length',
        'input_password_pattern',
        'input_password_default_value',
        'input_password_required',
        'input_select_count',
        'input_select_required',
        'input_radio_count',
        'input_checkbox_count',
        'input_pin_placeholder_bn',
        'input_pin_placeholder_en',
        'input_pin_min_length',
        'input_pin_max_length',
        'input_pin_pattern',
        'input_pin_default_value',
        'input_pin_required',
        'input_otp_placeholder_bn',
        'input_otp_placeholder_en',
        'input_otp_min_length',
        'input_otp_max_length',
        'input_otp_pattern',
        'input_otp_default_value',
        'input_otp_required',
        'input_expire_date_placeholder_bn',
        'input_expire_date_placeholder_en',
        'input_expire_date_min_length',
        'input_expire_date_max_length',
        'input_expire_date_pattern',
        'input_expire_date_default_value',
        'input_expire_date_required',
    ];

    foreach ($inputFields as $fieldName) {
        if (isset($data[$fieldName])) {
            if ($fieldName === 'input_type'){
                if($data[$fieldName]=='input_select') {
                    // For dynamically created select input fields, create an object for each select value
                    $selectValuesCount = $data['input_select_count'];
                    $selectValuesObject = new stdClass();
                    for ($i = 0; $i < $selectValuesCount; $i++) {
                        $selectValue = new stdClass();
                        $selectValue->option_bn = $data['input_select_option_bn'][$i]??'';
                        $selectValue->option_en = $data['input_select_option_en'][$i] ??'';
                        $selectValue->value = $data['input_select_value'][$i]??'';
                        $selectValuesObject->$i = $selectValue;
                    }

                    $jsonObject['select_values'] = $selectValuesObject;
                }
                if($data[$fieldName]=='input_checkbox'){
                    $checkboxValuesCount = $data['input_checkbox_count'];
                    $checkboxValuesObject = new stdClass();
                    for ($i = 0; $i < $checkboxValuesCount; $i++) {
                        $checkboxValue = new stdClass();
                        $checkboxValue->checkbox_value = $data['input_checkbox_value'][$i]??'';
                        $checkboxValuesObject->$i = $checkboxValue;
                    }

                    $jsonObject['checkbox_values'] = $checkboxValuesObject;
                }
                if($data[$fieldName]=='input_radio'){
                    $radioValuesCount = $data['input_radio_count'];
                    $radioValuesObject = new stdClass();
                    for ($i = 0; $i < $radioValuesCount; $i++) {
                        $radioValue = new stdClass();
                        $radioValue->radio_label_bn = $data['input_radio_label_bn'][$i]??'';
                        $radioValue->radio_label_en = $data['input_radio_label_en'][$i]??'';
                        $radioValuesObject->$i = $radioValue;
                    }

                    $jsonObject['radio_values'] = $radioValuesObject;

                }
                $jsonObject[$fieldName] = $data[$fieldName];
            }
            else {
                // For other input fields, store the value directly
                $jsonObject[$fieldName] = $data[$fieldName];
            }

        }

    }

    $data['element_properties'] = json_encode($jsonObject);
}

}
