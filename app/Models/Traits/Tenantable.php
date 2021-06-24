<?php
namespace App\Models\Traits;

use App\Models\Tenant;
use App\Scopes\TenantScope;

trait Tenantable
{
    protected static function bootTenantable()
    {
        static::addGlobalScope(new TenantScope);
        // if(session()->has('tenant_id') && !is_null(session()->get('tenant_id'))) {
        //     static::creating(function($model) {
        //         $model->categories()->sync(session()->get('tenant_id'));
        //     });
        // }
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
