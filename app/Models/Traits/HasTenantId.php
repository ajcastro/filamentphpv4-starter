<?php

declare(strict_types=1);

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;

trait HasTenantId
{
    public static function bootHasTenantId()
    {
        static::creating(function ($model) {
            /** @var \App\Models\User */
            $user = Auth::user();
            if ($user && empty($model->tenant_id)) {
                $model->tenant_id = $user->tenant_id;
            }
        });
    }
}
