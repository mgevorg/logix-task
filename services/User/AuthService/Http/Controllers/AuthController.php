<?php

namespace Services\User\AuthService\Http\Controllers;

use App\Http\Controllers\Controller;
use Services\User\AuthService\Contracts\AuthServiceInterface;
use Services\User\AuthService\Http\DTOs\UserRegisterDTO;
use Services\User\AuthService\Http\Requests\UserAuthRequest;
use Services\User\AuthService\Http\DTOs\UserAuthDTO;
use Services\User\AuthService\Http\Requests\UserRegisterRequest;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('login', 'register');
    }

    /**
     * @OA\Post(
     *     path="/api/auth/login/",
     *     summary="User login and get token.",
     *     tags={"Authorization"},
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *               allOf={
     *                    @OA\Schema(
     *                         @OA\Property(property="email", type="string", example="user@user.user"),
     *                         @OA\Property(property="password", type="string", example="password"),
     *                    ),
     *               },
     *          ),
     *     ),
     *
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(
     *               @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9hdXRoL2xvZ2luIiwiaWF0IjoxNjk5OTY1OTc5LCJleHAiOjE2OTk5Njk1NzksIm5iZiI6MTY5OTk2NTk3OSwianRpIjoiMWpVeVpGVWYzdlpZRnJDcyIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.dlAUe2hCZSviHBlkUlTw_R8YGyhUUZx-cSyyfNey2Mc"),
     *               @OA\Property(property="type", type="string", example="Bearer"),
     *               @OA\Property(property="expires_in", type="integer", example=3600),
     *          ),
     *     ),
     * ),
     */
    public function login(UserAuthRequest $request)
    {
        $userAuthDto = new UserAuthDTO($request->validated());
        $userAuthService = app('services.user.auth-service');
        return $userAuthService->login($userAuthDto);
    }

    /**
     * Process registration of the user.
     *
     * @param  UserRegisterRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */


    /**
     * @OA\Post(
     *     path="/api/auth/register/",
     *     summary="User register.",
     *     tags={"Authorization"},
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *               allOf={
     *                    @OA\Schema(
     *                         @OA\Property(property="name", type="string", example="Name"),
     *                         @OA\Property(property="last_name", type="string", example="LastName"),
     *                         @OA\Property(property="email", type="string", example="user@gmail.com"),
     *                         @OA\Property(property="password", type="string", example="password123$"),
     *                         @OA\Property(property="password_confirmation", type="string", example="password123$"),
     *                    ),
     *               },
     *          ),
     *     ),
     *
     *     @OA\Response(
     *          response=201,
     *          description="Created",
     *          @OA\JsonContent(
     *               @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9hdXRoL2xvZ2luIiwiaWF0IjoxNjk5OTY1OTc5LCJleHAiOjE2OTk5Njk1NzksIm5iZiI6MTY5OTk2NTk3OSwianRpIjoiMWpVeVpGVWYzdlpZRnJDcyIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.dlAUe2hCZSviHBlkUlTw_R8YGyhUUZx-cSyyfNey2Mc"),
     *               @OA\Property(property="type", type="string", example="Bearer"),
     *               @OA\Property(property="expires_in", type="integer", example=3600),
     *          ),
     *     ),
     * ),
     */
    public function register(UserRegisterRequest $request)
    {
        $userRegistertDto = new UserRegisterDTO($request->validated());
        $newUser = app('services.user.auth-service')->register($userRegistertDto);
        return response()->json($newUser, "201");
    }
}
