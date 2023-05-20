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
    public function __construct(string $itemSchema, bool $isArray)
    {
        $properties = static::getBaseProperties();
        $properties[] = $isArray ?
            new Property(
                property: 'data',
                description: '数据',
                type: 'array',
                items: new Items(ref: $itemSchema)
            ) :
            new Property(
                property: 'data',
                ref: $itemSchema,
                description: '数据'
            );
        parent::__construct(properties: $properties);
    }

    public static function getBaseProperties(): array
    {
        return [
            new Property(property: 'code', description: 'code', type: 'integer', enum: [200, 400, 500]),
            new Property(property: 'message', description: 'message', type: 'string'),
        ];
    }

    public static function format(mixed $data): array
    {
        return [
            'code' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }
}
