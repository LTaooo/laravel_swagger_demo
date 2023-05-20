<?php
declare(strict_types=1);

namespace App\Utils;

class Route
{
    public static function getRouteByControllerAndMethod(string $controllerName, string $methodName): ?string
    {
        /** @var \Illuminate\Routing\Route $route */
        foreach (\Illuminate\Support\Facades\Route::getRoutes() as $route) {
            if (str_contains($route->getActionName(), '@')) {
                list($controller, $method) = explode('@', $route->getActionName());
                if ($controller === $controllerName && $method === $methodName) {
                    return $route->uri();
                }
            }
        }
        return null;
    }
}
