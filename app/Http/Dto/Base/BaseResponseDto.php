<?php
declare(strict_types=1);

namespace App\Http\Dto\Base;

use App\Models\BaseModel;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;
use ReflectionClass;

class BaseResponseDto extends JsonResource
{
    /**
     * @param Request $request
     * @return array<string, mixed>|JsonSerializable|Arrayable<string, mixed>
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        if (is_null($this->resource)) {
            return [];
        }
        return $this->toArrayFromProperty($request);
    }

    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    private function toArrayFromProperty(Request $request): array
    {
        $class = new ReflectionClass($this);
        $properties = $class->getProperties();
        $result = [];
        foreach ($properties as $property) {
            $attributes = $property->getAttributes();
            if (count($attributes) <= 0) {
                continue;
            }
            $value = $this->resource[$property->name];
            if ($value instanceof BaseModel) {
                $value = $value->toDto()->toArray($request);
            } elseif ($value instanceof Arrayable) {
                $value = $value->toArray();
            }
            $result[$property->name] = $value;
        }

        return $result;
    }

    // private function toArrayFromClassProperty($request): array
    // {
    //     $class = new ReflectionClass($this);
    //     $attributes = $class->getAttributes(Schema::class);
    //     $result = [];
    //     foreach ($attributes as $attribute) {
    //         /** @var Property $property */
    //         foreach ( $attribute->getArguments()['properties'] ?? [] as $property) {
    //             $value = $this->resource->{$property->property};
    //             if ($value instanceof BaseModel) {
    //                 $value = $value->toDto()->toArray($request);
    //             } elseif ($value instanceof Arrayable) {
    //                 $value = $value->toArray();
    //             }
    //             $result[$property->property] = $value;
    //         }
    //     }
    //     return $result;
    // }
}
