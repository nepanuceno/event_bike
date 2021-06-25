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
}
