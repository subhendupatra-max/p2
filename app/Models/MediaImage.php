<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MediaImage extends Model
{
    use HasFactory;
    protected $guarded  = [];
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        $filePath = 'storage/media/' . $this->file;
        if (!$this->file || !file_exists(public_path($filePath))) {
            return asset('assets/media/images/no-image.png');
        }
        return asset($filePath);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
