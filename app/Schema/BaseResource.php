<?php
declare(strict_types=1);

namespace App\Schema;

use Attribute;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;

#[Attribute(Attribute::TARGET_CLASS)]
class BaseResource extends JsonContent
{
    public function __construct(string $dtoClass)
    {
        $properties = static::getBaseProperties();
        $properties[] = new Property(
            property: 'data',
            ref: $dtoClass,
            description: '数据'
        );
        parent::__construct(properties: $properties);
    }

    public static function getBaseProperties(): array
    {
        return [
            new Property(property: 'code', description: 'code', type: 'integer', enum: [200, 400, 500], example: 200),
            new Property(property: 'message', description: 'message', type: 'string', example: '请求成功'),
        ];
    }

    public static function format(mixed $data = null): array
    {
        return [
            'code' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }
}
