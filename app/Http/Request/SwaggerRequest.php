<?php
declare(strict_types=1);

namespace App\Http\Request;

use App\Http\Dto\Base\BaseRequestDto;
use Illuminate\Foundation\Http\FormRequest;

class SwaggerRequest extends FormRequest
{
    /**
     * @return array<string, array<string>|mixed>
     */
    public function rules(): array
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
        $instance = new $class();
        $instance->fill($this);
        return $instance;
    }
}
