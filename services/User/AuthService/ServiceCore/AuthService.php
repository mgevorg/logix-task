<?php
declare(strict_types=1);

namespace Services\User\AuthService\ServiceCore;

use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Password;
use Services\User\AuthService\Contracts\AuthServiceInterface;
use Services\User\AuthService\Http\DTOs\User\UserAuthDTO;
use Services\User\AuthService\Repositories\UserRepository;

class AuthService implements AuthServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(UserAuthDTO $userAuthDto)
    {
        $status = Password::sendResetLink(['email' => $userAuthDto->email]);
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

    public function register($requestDto) :  User
    {
        $newUser = $this->userRepository->create(['name' => $requestDto->name, 'last_name' => $requestDto->last_name, 'email' => $requestDto->email, 'password' => $requestDto->password]);
        return $newUser;
    }
}
