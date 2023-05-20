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

    public static function getBaseProperties(): array
    {
        return [
            new Property(property: 'page', type: 'integer', example: 1),
            new Property(property: 'limit', type: 'integer', example: 10),
        ];
    }

    /**
     * @throws ReflectionException
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
