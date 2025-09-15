<?php

namespace App\Models;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
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

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function  bussiness(): BelongsTo
    {
        return $this->belongsTo(UserBusiness::class,'user_business_id','id');
    }

    public function  store(): BelongsTo
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }

   
}
