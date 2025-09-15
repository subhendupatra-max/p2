<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'image_path1',
        'image_path2',
        'image_path3',
        'image_path4',
        'footer_image1_path',
        'footer_image2_path'
    ];

    public function getImagePath1Attribute()
    {
        return $this->getImageUrl($this->file1);
    }

    public function getImagePath2Attribute()
    {
        return $this->getImageUrl($this->file2);
    }

    public function getImagePath3Attribute()
    {
        return $this->getImageUrl($this->file3);
    }
    public function getImagePath4Attribute()
    {
        return $this->getImageUrl($this->file4);
    }

    public function getFooterImage1PathAttribute()
    {
        return $this->getImageUrl($this->footer_file1);
    }

    public function getFooterImage2PathAttribute()
    {
        return $this->getImageUrl($this->footer_file2);
    }

    protected function getImageUrl($file)
    {
        $path = 'storage/' . $file;
        if (!$file || !file_exists(public_path($path))) {
            return asset('assets/media/images/no-image.png');
        }
        return asset($path);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
