<?php
declare(strict_types=1);

namespace Services\User\AuthService\Http\DTOs\User;


use Services\User\AuthService\Http\DTOs\BaseDTO;

class UserAuthDTO extends BaseDTO
{
    public string $email;
    public string $password;

    public function __construct(array $arguments)
    {
        foreach($arguments as $key => $value) {
            $this->$key = $value;
        }
    }
}
