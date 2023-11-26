<?php
declare(strict_types=1);

namespace Services\User\PostService\Http\DTOs\Comments;

use Services\User\PostService\Http\DTOs\BaseDTO;

class CreateCommentDTO extends BaseDTO
{
    public function __construct(array $arguments)
    {
        foreach($arguments as $key => $value) {
            $this->$key = $value;
        }
    }
}
