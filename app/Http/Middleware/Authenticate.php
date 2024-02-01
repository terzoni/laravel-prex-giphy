<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return null;
//        return $request->expectsJson() ? null : route('login');
//        return response()->json(['data' => false, 'error' => 'ACCESS TOKEN EXPIRES'], 403);
//        return response()->json(['data' => false, 'error' => 'ACCESS TOKEN EXPIRES', 'e' => $e->getMessage()], 403);
    }
}
