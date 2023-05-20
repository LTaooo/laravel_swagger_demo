<?php
declare(strict_types=1);

namespace App\Http\Dto\Response;

use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(title: '学生信息', description: '学生信息,包含班级信息')]
class StudentWithClassResponseDto extends StudentResponseDto
{
    #[Property(property: 'class', ref: ClassResponseDto::class, title: '班级信息')]
    public ClassResponseDto $class;
}
