<?php
declare(strict_types=1);

namespace App\Schema;

use App\Schema\Component\ClassMethod;
use App\Utils\Route;
use OpenApi\Attributes\ExternalDocumentation;
use OpenApi\Attributes\RequestBody;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Get extends \OpenApi\Attributes\Get
{
    public function __construct(ClassMethod $classMethod, ?string $operationId = null, ?string $description = null, ?string $summary = null, ?array $security = null, ?array $servers = null, ?RequestBody $requestBody = null, ?array $tags = null, ?array $parameters = null, ?array $responses = null, ?array $callbacks = null, ?ExternalDocumentation $externalDocs = null, ?bool $deprecated = null, ?array $x = null, ?array $attachables = null)
    {
        $path = Route::getRouteByControllerAndMethod($classMethod->getClassName(), $classMethod->getMethodName());
        parent::__construct($path, $operationId, $description, $summary, $security, $servers, $requestBody, $tags, $parameters, $responses, $callbacks, $externalDocs, $deprecated, $x, $attachables);
    }
}
