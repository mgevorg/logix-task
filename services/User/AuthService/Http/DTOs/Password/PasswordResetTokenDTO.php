<?php
declare(strict_types=1);

namespace Services\User\AuthService\Http\DTOs\Password;

use Services\User\AuthService\Http\DTOs\BaseDTO;

class PasswordResetTokenDTO extends BaseDTO
{
    public string $email;

    public function __construct(array $arguments)
    {
        foreach($arguments as $key => $value) {
            $this->$key = $value;
        }
    }
}
