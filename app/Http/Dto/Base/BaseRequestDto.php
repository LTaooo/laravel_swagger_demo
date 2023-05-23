<?php
declare(strict_types=1);

namespace App\Http\Dto\Base;

use App\Contract\RequestValidateInterface;
use App\Schema\Property;
use App\Traits\GetPropertySchema;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Foundation\Http\FormRequest;
use ReflectionClass;
use ReflectionException;
use RuntimeException;
use Throwable;

class BaseRequestDto implements RequestValidateInterface, Arrayable
{
    use GetPropertySchema;

    private array $properties = [];

    public function __construct(FormRequest $request)
    {
        $this->fill($request);
    }

    protected function fill(FormRequest $request): void
    {
        try {
            $params = $request->validate($this->rules(), $this->messages());
        } catch (Throwable $e) {
            throw new RuntimeException($e->getMessage());
        }
        $class = new ReflectionClass($this);
        $properties = $class->getProperties();
        foreach ($properties as $property) {
            $property->setValue($this, $params[$property->getName()] ?? null);
            $this->properties[] = $property->getName();
        }
    }

    /**
     * @throws ReflectionException
     */
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

    public function toArray(): array
    {
        $data = [];
        foreach ($this->properties as $property) {
            $data[$property] = $this->{$property};
        }
        return $data;
    }
}
