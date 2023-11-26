<?php
declare(strict_types=1);

namespace Services\User\AuthService\Http\DTOs\User;


use Services\User\AuthService\Http\DTOs\BaseDTO;

class UserRegisterDTO extends BaseDTO
{
    public readonly string $name;
    public readonly string $last_name;
    public readonly string $email;
    public readonly string $password;

    public function __construct(array $arguments)
    {
        foreach($arguments as $key => $value) {
            $this->$key = $value;
        }
    }
}
