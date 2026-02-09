<?php

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

declare(strict_types=1);

if (! function_exists('tenant')) {
    function tenant(): Tenant
    {
        return Auth::user()->tenant ?? throw new RuntimeException('No authenticated user or tenant found.');
    }
}
