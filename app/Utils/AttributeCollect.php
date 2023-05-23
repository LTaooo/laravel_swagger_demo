<?php
declare(strict_types=1);

namespace App\Utils;

use App\Schema\Property;
use ReflectionClass;
use ReflectionException;

class AttributeCollect
{
    /**
     * @var class-string $class
     */
    private string $class;

    /**
     * @param string $class
     */
    public function __construct(string $class)
    {
        $this->class = $class;
    }

    public static function make(string $class): static
    {
        return new static($class);
    }

    /**
     * @throws ReflectionException
     */
    public function getProperties(): array
    {
        $properties = [];
        $reflection = new ReflectionClass($this->class);
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
