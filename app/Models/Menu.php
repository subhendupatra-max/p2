<?php

namespace App\Models;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
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
    protected $appends = ['image_path', 'menu_path'];

    public function getImagePathAttribute()
    {
        $filePath = 'storage/menu/' . $this->file;
        if (!$this->file || !file_exists(public_path($filePath))) {
            return asset('assets/media/images/no-image.png');
        }
        return asset($filePath);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function getMenuPathAttribute()
    {
        $path = collect();
        $menu = $this;

        while ($menu) {
            $path->prepend($menu->title_en); // assuming `name` holds menu title
            $menu = $menu->parent;
        }

        return $path->implode(' - ');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function extendMenu()
    {
        return $this->belongsTo(Templete::class, 'extend_to');
    }

    public function section(){
           return $this->hasMany(Section::class, 'menu_id');
    }

}
