<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Webpatser\Uuid\Uuid;
use Laravel\Passport\HasApiTokens;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
    protected $appends = ['image_path'];
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function getImagePathAttribute()
    {
        $filePath = 'storage/profile/' . $this->profile_image;
        if (!$this->profile_image || !file_exists(public_path($filePath))) {
            return asset('assets/media/avatars/blank.png');
        }
        return asset($filePath);
    }
    public function businesses(): HasMany
    {
        return $this->hasMany(UserBusiness::class);
    }
    public function stores(): HasMany
    {
        return $this->hasMany(Store::class);
    }
    public function role()
    {
        $this->roles()->first();
    }

    // public function passwordList(){
    //     return $this->hasMany(UserPasswordList::class,'user_id');
    // }

    // public function last3password(){
    //     return $this->hasMany(UserPasswordList::class,'user_id')->latest()->limit(3);
    // }

    public function newPasswordCheckUniqueFromLast3($password){
        $result = $this->hasMany(UserPasswordList::class,'user_id')->latest()->take(3);
        foreach ($result as $value) {
            if(Hash::check($value->password, $password)){
                return true;
            }
        }
        return false;

    }
    public function getDesignation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

}
