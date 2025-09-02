<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiKey;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->apikey != null) {

            // Ellis: change from db to .env
            // $apikey = ApiKey::where('api_key' , $request->apikey)->get()->first();
            $apikey = env('APIKEY_HASH');

            if(!$apikey) return response()->json([
                'message' => 'Unknown Authorization',
                'error'   => true,
                'code'    => 401,
            ], 401);

            return $next($request);

        } else {

            return response()->json([
                'message' => 'Apikey is required',
                'error'   => true,
                'code'    => 401,
            ], 401);
        }
    }
}
