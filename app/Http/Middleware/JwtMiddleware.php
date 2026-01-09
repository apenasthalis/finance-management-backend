<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $authorization = $request->header('Authorization');

        if (!$authorization || !str_starts_with($authorization, 'Bearer ')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = substr($authorization, 7);
        $secret = env('JWT_SECRET');

        if (!$secret) {
            return response()->json(['error' => 'JWT secret not configured'], 500);
        }

        try {
            $credentials = JWT::decode($token, new Key($secret, 'HS256'));

            $userId = $credentials->sub ?? null;

            if (!$userId) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $user = User::find($userId);

            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Define o usuário autenticado sem criar sessão
            Auth::setUser($user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}

