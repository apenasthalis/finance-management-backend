<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\PersonService;
use App\Services\UserService;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        private UserService $userService,
        private PersonService $personService,
    ) {}

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->validated();

            $user = $this->userService->getByEmail($credentials['email']);

            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            $ttl = (int) env('JWT_TTL', 3600);
            $payload = [
                'sub' => $user->id,
                'person_id' => $user->person_id,
                'email' => $user->email,
                'iat' => time(),
                'exp' => time() + $ttl,
            ];

            $secret = env('JWT_SECRET');

            if (!$secret) {
                return response()->json(['error' => 'JWT secret not configured'], 500);
            }

            $token = JWT::encode($payload, $secret, 'HS256');

            return response()->json([
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => $ttl,
                'user' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $person = $this->personService->create([
                'fullname' => $data['fullname'],
            ]);
            $user = $this->userService->create([
                'person_id' => $person->id,
                'username' => $data['username'] ?? $data['email'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
            return response()->json([
                'person' => $person,
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
