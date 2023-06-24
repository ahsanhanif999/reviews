<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->admin && $request->user()->admin->is_verified) {
            return $next($request);
        }

        throw new HttpResponseException(
            response()->json([
                'message' => 'admin validation failed'
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
