<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;

class Store extends Model
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
    protected $appends = ['logo_path'];

      public function getLogoPathAttribute()
    {
        $filePath = "storage/store/{$this->logo}";
        if (!$this->logo || !file_exists(public_path($filePath))) {
            return asset('assets/media/avatars/blank.png');
        }
        return asset($filePath);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function  bussiness(): BelongsTo
    {
        return $this->belongsTo(UserBusiness::class,'user_business_id','id');
    }
}
