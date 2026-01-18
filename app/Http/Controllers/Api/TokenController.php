<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    public function store(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if(!Auth::attempt($credentials)) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Invalid credentials.',
            ], 401);
        }

        $token = Auth::user()->createToken('auth', expiresAt: now()->addMonth())->plainTextToken;

        return new JsonResponse([
            'success' => true,
            'message' => 'Login successful',
            'token'   => $token,
        ], 201);
    }

    public function destroy(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete;

        return new JsonResponse([
            'success' => true,
            'message' => 'Token revoked successfully.',
        ], 200);
    }

    public function destroyAll(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return new JsonResponse([
            'success' => true,
            'message' => 'All tokens revoked successfully.',
        ], 200);
    }
}
