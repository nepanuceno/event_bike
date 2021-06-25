<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantNotifyJoinUser extends Model
{
    use HasFactory;

    protected $fillable = ['requesting_user_id', 'tenant_id', 'recipient_users'];

    public function tenants()
    {
        return $this->hasMany(Tenant::class, 'id');
    }

    public function sending_user()
    {
        return $this->belongsTo(User::class, 'requesting_user_id');
    }

    public function recipient_user()
    {
        return $this->hasMany(User::class, 'recipient_users');
    }

    public function requested_tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
