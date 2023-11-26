<?php

namespace Services\User\AuthService\Contracts;

use Services\User\AuthService\Http\Requests\Password\ForgetPasswordRequest;
use Services\User\AuthService\Http\Requests\Password\ResetPasswordRequest;

interface PasswordServiceInterface
{
    public function submitForgetPassword(ForgetPasswordRequest $request);
    public function submitResetPassword(ResetPasswordRequest $request);
}
