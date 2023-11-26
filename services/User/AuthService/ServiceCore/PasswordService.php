<?php
declare(strict_types=1);

namespace Services\User\AuthService\ServiceCore;



use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Services\User\AuthService\Contracts\PasswordServiceInterface;
use Services\User\AuthService\Http\Requests\Password\ForgetPasswordRequest;
use Services\User\AuthService\Http\Requests\Password\ResetPasswordRequest;
use Services\User\AuthService\Repositories\PasswordResetTokenRepository;
use Services\User\AuthService\Repositories\UserRepository;

class PasswordService implements PasswordServiceInterface
{
    protected $passwordResetTokenRepository;
    protected $userRepository;

    public function __construct(PasswordResetTokenRepository $passwordResetTokenRepository, UserRepository $userRepository)
    {
        $this->passwordResetTokenRepository = $passwordResetTokenRepository;
        $this->userRepository = $userRepository;
    }

    public function submitForgetPassword(ForgetPasswordRequest $request)
    {
//        dd("shit");
        $token = Str::random(64);

        $this->passwordResetTokenRepository->create([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return response()->json(array('message' => 'Password Foreget Request Sent'));
    }


    public function submitResetPassword(ResetPasswordRequest $request)
    {
        $updatePassword = $this->passwordResetTokenRepository->find($request);

        if(!$updatePassword){
            return response()->json(array('message' => 'Invalid token!'));
        }
        $this->userRepository->updatePasswordByEmail($request->email, $request->password);
        $removeToken = $this->passwordResetTokenRepository->removeToken($request->email);

        return response()->json(array('message' => 'Your password has been changed!'));
    }
}
