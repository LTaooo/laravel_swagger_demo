<?php
declare(strict_types=1);

namespace App\Http\Request;

use App\Http\Dto\Base\BaseRequestDto;
use App\Schema\RequestBody;
use Illuminate\Foundation\Http\FormRequest;
use ReflectionClass;
use ReflectionException;

class SwaggerRequest extends FormRequest
{
    /**
     * @return empty[]
     */
    final public function rules(): array
    {
        return [];
    }

    /**
     * @template T of BaseRequestDto
     * @param class-string<T> $class
     * @return T
     */
    public function toDto(string $class)
    {
        return new $class($this);
    }

    /**
     * @throws ReflectionException
     */
    public function autoToDto() :BaseRequestDto|null
    {
        $reflectionAttributes = (new ReflectionClass($this->route()->getControllerClass()))->getMethod($this->route()->getActionMethod())->getAttributes();
        foreach ($reflectionAttributes as $attribute) {
            if ($attribute->getName() === RequestBody::class) {
                $arguments = $attribute->getArguments();
                return $this->toDto($arguments['dtoClass']);
            }
        }
        return null;
    }
}
