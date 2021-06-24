<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model
{
    use HasFactory;


    protected $fillable = ['name','key_pagarme'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'tenant_has_user', 'tenant_id', 'user_id');
    }
}
