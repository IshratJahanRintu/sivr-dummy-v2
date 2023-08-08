<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SivrApiCompare extends Model
{
    protected $table='sivr_api_compare';
    use HasFactory;
protected $fillable=[
    'page_id',
    'element_id',
    'api_key',
    'comparison',
    'key_value',
    'transfer_page_id',
    'transfer_option'
];
    public function sivrPage(){
        return $this->belongsTo(SivrPage::class,'page_id');
    }

    public function pageElement(){
        return $this->belongsTo(SivrPageElement::class,'element_id');
    }

}
