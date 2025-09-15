<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory;
    protected $guarded  = [];
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        $filePath = 'storage/product/' . $this->image;
        if (!$this->image || !file_exists(public_path($filePath))) {
            return asset('assets/media/images/no-image.png');
        }
        return asset($filePath);
    }
}
