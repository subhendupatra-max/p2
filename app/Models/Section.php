<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;

class Section extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded  = [];

     public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }

    public function menu(){
        return $this->belongsTo(Menu::class,'menu_id');
    }

    public function unit(){
         return $this->belongsTo(Unit::class,'unit_id');
    }
}
