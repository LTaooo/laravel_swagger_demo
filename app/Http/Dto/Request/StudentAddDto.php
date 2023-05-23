<?php
declare(strict_types=1);

namespace App\Http\Dto\Request;

use App\Http\Dto\Base\BaseRequestDto;
use App\Schema\Property;
use OpenApi\Attributes\Schema;

#[Schema(title: '学生创建', description: '学生创建请求参数')]
class StudentAddDto extends BaseRequestDto
{
    #[Property(property: 'name', title: '学生名称', type: 'string', example: '张三', required: true)]
    public string $name;

    #[Property(property: 'age', title: '学生年龄', type: 'integer', example: 18, required: true)]
    public int $age;

    #[Property(property: 'class_id', title: '班级id', type: 'integer', example: 1, required: true)]
    public int $class_id;
}
