<?php

namespace Services\User\AuthService\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function getByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function update($id, array $data)
    {
        $user = $this->model->find($id);

        if ($user) {
            $user->update($data);
            return $user;
        }

        return null;
    }

    public function updatePasswordByEmail($email, $password)
    {
        $this->model->where('email', $email)->update(['password' => Hash::make($password)]);
    }

    public function delete($id)
    {
        $user = $this->model->find($id);

        if ($user) {
            $user->delete();
            return true;
        }

        return false;
    }
}
