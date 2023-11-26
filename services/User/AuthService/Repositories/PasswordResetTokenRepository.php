<?php

namespace Services\User\AuthService\Repositories;

use Illuminate\Support\Facades\DB;

class PasswordResetTokenRepository
{
    protected $model;


    public function create(array $data)
    {
       return DB::table('password_reset_tokens')->insert($data);
    }

    public function find($request)
    {
        return DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();
    }

    public function getByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function removeToken($email)
    {
        dd(DB::table('password_reset_tokens')->where(['email'=> $email])->delete());
    }
}
