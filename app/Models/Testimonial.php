<?php

namespace App\Models;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes,LogsActivity;

    protected static $logName = 'testimonials';

    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'content'])
            ->logOnlyDirty()
            ->useLogName('testimonials');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Testimonial has been {$eventName}";
    }


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
        $filePath = 'storage/testimonial/' . $this->file;
        if (!$this->file || !file_exists(public_path($filePath))) {
            return asset('assets/media/images/no-image.png');
        }
        return asset($filePath);
    }
}
