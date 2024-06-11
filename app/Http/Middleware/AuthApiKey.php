<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Retrieve the Api key from the request
        $apiKey = $request->header('api_key');

        if (!$apiKey || $apiKey !== env('API_KEY'))
        {
            return response()->json([ 'error' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
