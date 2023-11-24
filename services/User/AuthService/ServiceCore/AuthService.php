<?php
declare(strict_types=1);

namespace Services\User\AuthService\ServiceCore;

use Illuminate\Support\Facades\Config;
use Services\User\AuthService\Contracts\AuthServiceInterface;
use Services\User\AuthService\Http\DTOs\UserAuthDTO;

class AuthService implements AuthServiceInterface
{
    public function login(UserAuthDTO $userAuthDto)
    {
        if(!$token = auth('api')->attempt($userAuthDto->toArray())){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function user()
    {
        return response()->json(auth('api')->user());
    }
    public function logout()
    {
        return response()->json(auth('api')->logout());
    }
    public function refresh()
    {
//        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'type' => 'bearer',
            'expires_in' => Config::get('jwt.ttl') * 6000
        ], 401);
    }
}
