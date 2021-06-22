<?php

namespace App\Models;

use App\Models\Tenant;
use App\Models\Profile;
use App\Models\UserAddress;
use App\Models\Traits\Tenantable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, Tenantable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'tenant_id',
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
            return "/system_images/photo-less.jpg";
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

    public function tenants()
    {
        return $this->belongsToMany(Tenant::class);
    }
}
