<?php
declare(strict_types=1);

namespace App\Http\Dto\Base;

use App\Contract\RequestValidateInterface;
use App\Schema\Property;
use App\Traits\GetPropertySchema;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes\JsonContent;
use OpenApi\Generator;
use ReflectionClass;
use RuntimeException;
use Throwable;

class BaseRequestDto extends JsonContent implements RequestValidateInterface
{
    use GetPropertySchema;

    public function fill(FormRequest $request): void
    {
        try {
            $result = $request->validate($this->rules(), $this->messages());
        } catch (Throwable $e) {
            throw new RuntimeException($e->getMessage());
        }
        $class = new ReflectionClass($this);
        $properties = $class->getProperties();
        foreach ($properties as $property) {
            $property->setValue($this, $result[$property->getName()] ?? null);
        }
    }

    public function rules(): array
    {
        $refProperties = static::getRefProperties();
        if ($refProperties) {
            $rules = [];
            foreach ($refProperties as $refProperty) {
                if ($refProperty instanceof Property) {
                    $rules[$refProperty->property] = $refProperty->rules;
                }
            }
            return $rules;
        }
        return [];
    }

    public function messages(): array
    {
        return [];
    }
}
