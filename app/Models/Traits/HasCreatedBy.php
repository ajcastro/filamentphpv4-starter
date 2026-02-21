<?php

declare(strict_types=1);

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;

trait HasCreatedBy
{
    public static function bootHasCreatedBy()
    {
        static::creating(function ($model) {
            /** @var \App\Models\User */
            $user = Auth::user();
            if ($user && empty($model->created_by)) {
                $model->created_by = $user->getKey();
            }
        });
    }

    public function createdBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
