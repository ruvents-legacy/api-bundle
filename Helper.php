<?php

namespace Ruvents\ApiBundle;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;

class Helper
{
    const RUVENTS_API = '_ruvents_api';

    private function __construct()
    {
    }

    public static function isApiRoute(Route $route): bool
    {
        return true === $route->getDefault(self::RUVENTS_API);
    }

    public static function isApiRequest(Request $request): bool
    {
        return $request->attributes->getBoolean(self::RUVENTS_API);
    }
}
