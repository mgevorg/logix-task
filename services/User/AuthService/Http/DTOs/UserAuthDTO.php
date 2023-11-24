<?php
declare(strict_types=1);

namespace Services\User\AuthService\Http\DTOs;


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
