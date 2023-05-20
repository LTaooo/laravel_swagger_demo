<?php
declare(strict_types=1);

namespace App\Schema;
use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Property extends \OpenApi\Attributes\Property
{
    public array $rules = [];

    public function __construct(string $property, string $title,?string $type = null,  mixed $example = null, ?string $description = null, ?bool $required = null, array $rules = [])
    {
        $rules[] = $type;
        if ($required) {
            $rules[] = 'required';
        }
        $this->rules = $rules;
        parent::__construct(property: $property, title: $title, description: $description, type: $type, example: $example);
    }
}
