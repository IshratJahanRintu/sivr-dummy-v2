<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SivrPage extends Model
{
    use HasFactory;

    protected $fillable=[
        'parent_page_id',
        'vivr_id',
        'page_heading_ban',
        'page_heading_en',
        'task',
        'has_previous_menu',
        'has_main_menu',
        'audio_file_ban',
        'audio_file_en',
        'service_title_id',
    ];

    public function parent(){
        return $this->belongsTo(SivrPage::class,'parent_page_id');
    }
    public function children(){
        return $this->hasMany(SivrPage::class,'parent_page_id');
    }

    public function  pageElements(){
        return $this->hasMany(SivrPageElement::class,'page_id');
    }
    public function hasChildren()
    {
        return $this->children()->exists();
    }
}
