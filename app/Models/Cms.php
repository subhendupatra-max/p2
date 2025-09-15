<?php

namespace App\Models;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cms extends Model
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
        $filePath = 'storage/cms/' . $this->file;
        if (!$this->file || !file_exists(public_path($filePath))) {
            return asset('assets/media/images/no-image.png');
        }
        return asset($filePath);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }
    public function menu(){
        return $this->belongsTo(Menu::class);
    }
    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function en_contant_writter(){
        return $this->belongsTo(User::class);
    }
    public function hi_contant_writter(){
        return $this->belongsTo(User::class);
    }

    public function english_contant_reviewer(){
        return $this->belongsTo(User::class,'contant_reviewer_id');
    }
    public function english_contant_approver(){
        return $this->belongsTo(User::class,'contant_approver_id');
    }
    public function hindi_contant_reviewer(){
        return $this->belongsTo(User::class,'hindi_reviewer_id');
    }
    public function hindi_contant_approver(){
        return $this->belongsTo(User::class,'hindi_approver_id');
    }
    public function href(){
      return $this->redirect_to == 1 ? $this->link : ($this->redirect_to == 2 ? localized_route('details',[$this->uuid]) : ($this->redirect_to == 3 ? url('details/'.$this->uuid) : '#'));
    }
}
