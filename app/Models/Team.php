<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;

class Team extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded  = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
    protected $appends = ['image_path'];
    public function getImagePathAttribute()
    {
        $filePath = 'storage/team/' . $this->file;
        if (!$this->file || !file_exists(public_path($filePath))) {
            return asset('assets/media/images/no-image.png');
        }
        return asset($filePath);
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }


}
