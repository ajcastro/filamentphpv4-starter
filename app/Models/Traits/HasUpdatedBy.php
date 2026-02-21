<?php

declare(strict_types=1);

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;

trait HasUpdatedBy
{
    public static function bootHasUpdatedBy()
    {
        static::updating(function ($model) {
            /** @var \App\Models\User */
            $user = Auth::user();
            if ($user && empty($model->updated_by)) {
                $model->updated_by = $user->getKey();
            }
        });
    }

    public function updatedBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }
}
