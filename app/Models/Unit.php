<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;

class Unit extends Model
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

    public function setting(){
        return $this->hasOne(Setting::class, 'unit_id', 'id');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'unit_id', 'id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
}
