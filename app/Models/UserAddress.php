<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','zip_code', 'address', 'neighborhood', 'number', 'city', 'state', 'country'];

    public function user()
    {
        $this->hasOne(User::class);
    }
}
