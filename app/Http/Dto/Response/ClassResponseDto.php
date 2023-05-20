<?php
declare(strict_types=1);

namespace App\Http\Dto\Response;

use App\Http\Dto\Base\BaseResponseDto;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(title: '班级信息', description: '班级信息')]
class ClassResponseDto extends BaseResponseDto
{
    #[Property(property: 'id', description: '班级id', type: 'integer', example: 1)]
    public int $id;

    #[Property(property: 'name', description: '班级名字', type: 'string', example: '一班')]
    public string $name;

    #[Property(property: 'created_at', description: '创建时间', type: 'integer', example: 1629782400)]
    public int $created_at;
}
