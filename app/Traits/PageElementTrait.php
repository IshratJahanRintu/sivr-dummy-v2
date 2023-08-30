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
        'button_title_type',
        'button_title_english',
        'button_title_bangla',
        'button_api_title_english',
        'button_api_title_bangla',
        'button_value_api_key',
        'button_confirmation_message_english',
        'button_confirmation_message_bangla',
        'button_otp_resend_message_english',
        'button_otp_resend_message_bangla',
        'button_otp_resend_time',
        'button_transfer_options',
        'button_transfer_page_id',
        'button_goto_page_id',
        'button_back_page_id',
        'paragraph_api_count',
        'link_type',
        'web_address_bn',
        'web_address_en',
        'link_text_en',
        'link_text_bn',
        'table_key_id',
        'table_key_comparison',
        'table_key_calculation',
        'table_type',
        'table_heading_bn',
        'table_heading_en',
        'rows',
        'columns',
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
        'input_select_type',

        'select_api_option_bn',
        'select_api_option_en',
        'select_api_value',
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

                 if($fieldName=='input_select_count') {
                    // For dynamically created select input fields, create an object for each select value
                    $selectValuesCount = $data[$fieldName];
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
                else if($fieldName=='input_checkbox_count'){
                    // For dynamically created checkbox input fields, create an object for each checkbox value
                    $checkboxValuesCount = $data[$fieldName];
                    $checkboxValuesObject = new stdClass();
                    for ($i = 0; $i < $checkboxValuesCount; $i++) {
                        $checkboxValue = new stdClass();
                        $checkboxValue->checkbox_value = $data['input_checkbox_value'][$i]??'';
                        $checkboxValuesObject->$i = $checkboxValue;
                    }

                    $jsonObject['checkbox_values'] = $checkboxValuesObject;
                }
                else if($fieldName=='input_radio_count'){
                    // For dynamically created radio input fields, create an object for each radio value
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


            else if ($fieldName ==='paragraph_api_count'){
                $paragraphApiValuesObject=new stdClass();
                for ($i = 0; $i < $data['paragraph_api_count']; $i++) {
                    $paragraphApiValues=new stdClass();
                    $paragraphApiValues->api_keys=$data['paragraph_api_keys'][$i]??'';
                    $paragraphApiValues->api_data_comparison=$data['paragraph_api_data_comparison'][$i]??'';
                    $paragraphApiValues->api_data_calculation=$data['paragraph_api_data_calculation'][$i]??'';
                    $paragraphApiValuesObject->$i=$paragraphApiValues;

                }

                $jsonObject['paragraph_api_values']=$paragraphApiValuesObject;
                $jsonObject[$fieldName] = $data[$fieldName];
            }


            $jsonObject[$fieldName] = $data[$fieldName];

        }

    }

    $data['element_properties'] = json_encode($jsonObject);
}

}
