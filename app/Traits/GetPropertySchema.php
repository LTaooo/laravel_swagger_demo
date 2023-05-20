<?php
declare(strict_types=1);

namespace App\Traits;

use App\Schema\Property;
use ReflectionClass;

trait GetPropertySchema
{
    public static function getRefProperties(): array
    {
        $properties = [];
        $reflection = new ReflectionClass(static::class);
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
