<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SivrPageElement extends Model
{
    use HasFactory;
protected  $fillable=[
    'page_id',
    'type',
    'display_name_bn' ,
    'display_name_en' ,
    'background_color' ,
    'text_color',
    'name' ,
    'value' ,
    'element_order',
    'rows',
    'columns',
    'is_visible',
    'data_provider_function' ,
];
    public function sivrPage(){
        return $this->belongsTo(SivrPage::class,'page_id');
    }
}
