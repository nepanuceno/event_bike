<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model
{
    use HasFactory;


    protected $fillable = ['name','key_pagarme', 'creator_user_id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'tenant_has_user', 'tenant_id', 'user_id');
    }

    public function creator_user()
    {
        $this->belongsTo(User::class);
    }

    public function notifies()
    {
        return $this->belongsTo(TenantNotifyJoinUser::class);
    }
}
