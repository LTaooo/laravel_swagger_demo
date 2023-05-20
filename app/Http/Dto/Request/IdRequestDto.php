<?php
declare(strict_types=1);

namespace App\Http\Dto\Request;

use App\Http\Dto\Base\BaseRequestDto;
use App\Schema\Property;
use OpenApi\Attributes\Schema;

#[Schema(title: 'id参数', description: 'id参数')]
class IdRequestDto extends BaseRequestDto
{
    #[Property(property: 'id', title: '数据id', type: 'integer', example: 1, required: true)]
    public int $id;

    public function __construct()
    {
        parent::__construct(properties: static::getRefProperties());
    }
}
