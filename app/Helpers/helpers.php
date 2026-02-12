<?php

declare(strict_types=1);

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

if (! function_exists('tenant')) {
    function tenant(): Tenant
    {
        return Auth::user()->tenant ?? throw new RuntimeException('No authenticated user or tenant found.');
    }
}
