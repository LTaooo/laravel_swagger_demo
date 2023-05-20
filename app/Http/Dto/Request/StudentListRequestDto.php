<?php
declare(strict_types=1);

namespace App\Http\Dto\Request;

use App\Http\Dto\Base\BaseRequestDto;
use App\Schema\Property;
use OpenApi\Attributes\Schema;

#[Schema(title: '学生列表请求', description: '列表请求参数')]
class StudentListRequestDto extends BaseRequestDto
{
    #[Property(property: 'page', title: '页码', type: 'integer', example: 10, required: true)]
    public int $page;

    #[Property(property: 'limit', title: '每页数量', type: 'integer', example: 10, required: true)]
    public int $limit;

    #[Property(property: 'class_id', title: '班级id', type: 'integer', example: 1, rules: ['min:1', 'filled'])]
    public ?int $class_id = null;

    #[Property(property: 'name', title: '学生名字', type: 'string', example: '张三', rules: ['filled'])]
    public ?string $name = null;

    public function __construct()
    {
        parent::__construct(properties: static::getRefProperties());
    }
}
