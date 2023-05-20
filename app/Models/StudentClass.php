<?php
declare(strict_types=1);

namespace App\Models;

use App\Http\Dto\Base\BaseResponseDto;
use App\Http\Dto\Response\ClassResponseDto;

class StudentClass extends BaseModel
{
    protected $table = 'class';

    function toDto(?string $className = null): BaseResponseDto
    {
        if (isset($className)) {
            return new $className($this);
        }
        return new ClassResponseDto($this);
    }
}
