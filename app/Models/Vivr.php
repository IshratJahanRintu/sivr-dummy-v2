<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vivr extends Model
{
    protected $table='vivr';
    use HasFactory;

    protected $fillable=[
        'title',
    ];
    public function sivrPages(){
        return $this->hasMany(SivrPage::class,'vivr_id');
    }

}
