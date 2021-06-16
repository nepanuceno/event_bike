<?php

namespace App\Models;

use App\Models\Profile;
use App\Models\UserAddress;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adminlte_profile_url()
    {
        return '/user/profile';
    }

    public function adminlte_image()
    {
        if(isset($this->profile->photo))
            return "/storage/photos/".$this->profile->photo;
        else {
            return "/storage/photos/sem-foto.jpg";
        }
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

}
