<?php

declare(strict_types=1);

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\Concerns\Has;

trait HasCreatedUpdatedDeletedBy
{
    use HasCreatedBy, HasUpdatedBy, HasDeletedBy;
}
