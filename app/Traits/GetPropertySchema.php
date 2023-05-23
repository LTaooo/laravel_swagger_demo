<?php
declare(strict_types=1);

namespace App\Traits;

use App\Schema\Property;
use App\Utils\AttributeCollect;
use ReflectionClass;
use ReflectionException;

trait GetPropertySchema
{
    /**
     * @throws ReflectionException
     */
    public static function getRefProperties(): array
    {
        return (new AttributeCollect(static::class))->getProperties();
    }
}
