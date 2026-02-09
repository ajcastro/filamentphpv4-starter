<?php

declare(strict_types=1);

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;

trait HasDeletedBy
{
    public static function bootHasDeletedBy()
    {
        static::deleting(function ($model) {
            /** @var \App\Models\User */
            $user = Auth::user();
            if ($user && empty($model->deleted_by)) {
                $model->deleted_by = $user->getKey();
            }
        });
    }

    public function deletedBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'deleted_by');
    }
}
