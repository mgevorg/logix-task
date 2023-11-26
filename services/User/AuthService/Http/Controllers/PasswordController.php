<?php

namespace Services\User\AuthService\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Services\User\AuthService\Http\Requests\Password\ForgetPasswordRequest;
use Services\User\AuthService\Http\Requests\Password\ResetPasswordRequest;

class PasswordController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/forget-password/",
     *     summary="Forget password.",
     *     tags={"ForgetPassword"},
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *               allOf={
     *                    @OA\Schema(
     *                         @OA\Property(property="email", type="string", example="user@user.user"),
     *                    ),
     *               },
     *          ),
     *     ),
     *
     *     @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(
     *               @OA\Property(property="access_token", type="string", example="Password Reset Token Sent"),
     *          ),
     *     ),
     * ),
     */
    public function submitForgetPassword(ForgetPasswordRequest $request)
    {
        $passwordService = app('services.user.password-service');
        return $passwordService->submitForgetPassword($request);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/reset-password/",
     *     summary="Submit new password.",
     *     tags={"ForgetPassword"},
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *               allOf={
     *                    @OA\Schema(
     *                         @OA\Property(property="email", type="string", example="user@user.user"),
     *                         @OA\Property(property="password", type="string", example="password11$$"),
     *                         @OA\Property(property="password_confirmation", type="string", example="password11$$"),
     *                         @OA\Property(property="token", type="string", example="example_token"),
     *                    ),
     *               },
     *          ),
     *     ),
     *
     *     @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(
     *               @OA\Property(property="access_token", type="string", example="Password Reset Token Sent"),
     *          ),
     *     ),
     * ),
     */
    public function submitResetPassword(ResetPasswordRequest $request)
    {
        $passwordService = app('services.user.password-service');
        return $passwordService->submitResetPassword($request);
    }
}
