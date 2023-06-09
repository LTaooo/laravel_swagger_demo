<?php
declare(strict_types=1);

namespace App\Http\Dto\Base;

use App\Schema\Property;
use OpenApi\Attributes\Schema;

#[Schema(title: 'id参数', description: 'id参数')]
class IdRequestDto extends BaseRequestDto
{
    #[Property(property: 'id', title: '数据id', type: 'integer', example: 1, required: true)]
    public int $id;
}
