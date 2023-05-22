<?php
declare(strict_types=1);

namespace App\Schema;

use Attribute;
use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;

#[Attribute(Attribute::TARGET_CLASS)]
class PageResource extends JsonContent
{
    public function __construct(string $itemSchema)
    {
        $properties = BaseResource::getBaseProperties();
        $properties[] = new Property(property: 'data', properties: [
            new Property(property: 'list', ref: $itemSchema, title: '列表'),
            new Property(property: 'total', description: '总数量', type: 'integer'),
        ], type: 'object');
        parent::__construct(properties: $properties);
    }

    /**
     * @param ResourceCollection $data
     * @return array<string, mixed>
     */
    public static function format(ResourceCollection $data): array
    {
        return [
            'code' => 0,
            'message' => 'success',
            'data' => [
                'list' => $data,
                'total' => $data->resource->total()
            ],
        ];
    }
}
