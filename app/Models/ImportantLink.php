<?php

namespace App\Models;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ImportantLink extends Model
{
    use HasFactory, SoftDeletes;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }

    protected $guarded  = [];
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        $filePath = 'storage/important_link/' . $this->file;
        if (!$this->file || !file_exists(public_path($filePath))) {
            return asset('assets/media/images/no-image.png');
        }
        return asset($filePath);
    }
}
