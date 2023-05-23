<?php
declare(strict_types=1);

namespace App\Schema;
use App\Traits\GetPropertySchema;
use App\Utils\AttributeCollect;
use OpenApi\Attributes\Attachable;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\XmlContent;
use OpenApi\Generator;

#[\Attribute(\Attribute::TARGET_METHOD)]
class RequestBody extends \OpenApi\Attributes\RequestBody
{
    /**
     * @param string                   $dtoClass
     * @param string|object|null       $ref
     * @param string|null              $request
     * @param string|null              $description
     * @param bool|null                $required
     * @param array<string,mixed>|null $x
     * @param Attachable[]|null        $attachables
     */
    public function __construct(
        string $dtoClass,
        string|object|null $ref = null,
        ?string $request = null,
        ?string $description = null,
        ?bool $required = null,
        // annotation
        ?array $x = null,
        ?array $attachables = null,
    ) {
        $content = new class($dtoClass) extends JsonContent {
            use GetPropertySchema;
            public function __construct(string $dtoClass)
            {
                parent::__construct(properties: AttributeCollect::make($dtoClass)->getProperties());
            }
        };
        parent::__construct(
            ref: $ref,
            request: $request,
            description: $description,
            required: $required,
            content: $content,
            x: $x,
            attachables: $attachables,);
    }
}
