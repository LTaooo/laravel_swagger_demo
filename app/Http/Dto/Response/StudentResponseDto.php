<?php
declare(strict_types=1);

namespace App\Http\Dto\Response;

use App\Http\Dto\Base\BaseResponseDto;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(title: '学生信息', description: '学生信息')]
class StudentResponseDto extends BaseResponseDto
{
    #[Property(property: 'id', title: '学生id', type: 'integer', example: 1)]
    public int $id;

    #[Property(property: 'name', title: '学生名称', type: 'string', example: '张三')]
    public string $name;

    #[Property(property: 'age', title: '学生年龄', type: 'integer', example: 18)]
    public int $age;

    #[Property(property: 'class_id', title: '班级id', type: 'integer', example: 1)]
    public int $class_id;

    #[Property(property: 'created_at', title: '学生创建时间', type: 'integer', example: 1629782400)]
    public int $created_at;
}
