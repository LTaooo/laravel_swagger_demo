<?php
declare(strict_types=1);

namespace App\Http\Schema;

use Attribute;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

#[Attribute(Attribute::TARGET_CLASS)]
class PageRequest extends JsonContent
{
    /**
     * @template T of object
     * @param class-string<T>|object|null $ref
     * @throws ReflectionException
     */
    public function __construct(string|object|null $ref = null)
    {
        $properties = static::getBaseProperties();
        if (!empty($ref)) {
            $refProperties = $this->getRefProperties($ref);
            $properties = array_merge($properties, $refProperties);
        }
        parent::__construct(properties: $properties);
    }

    /**
     * @return Property[]
     */
    public static function getBaseProperties(): array
    {
        return [
            new Property(property: 'page', title: '页码', type: 'integer', example: 1),
            new Property(property: 'limit', title: '每页数量', type: 'integer', example: 10),
        ];
    }

    /**
     * @template T of object
     * @param class-string<T>|object $ref
     * @throws ReflectionException
     * @return Property[]
     */
    private function getRefProperties(string|object $ref): array
    {
        $properties = [];
        $reflection = new ReflectionClass($ref);
        foreach ($reflection->getProperties() as $property) {
            $reflectionAttributes = $property->getAttributes(Property::class);
            foreach ($reflectionAttributes as $attribute) {
                $arguments = $attribute->getArguments();
                $arguments['property'] = $property->getName();
                $properties[] = new Property(...$arguments);
            }
        }
        return $properties;
    }
}
