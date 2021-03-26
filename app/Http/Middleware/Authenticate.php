<?php

namespace App\Http\Middleware;

use App\Exceptions\UnableToFoundTokenException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Contracts\Auth\Factory as Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\JWT;

class Authenticate extends Middleware
{
    private $jwt;

    private $whitelistedUris = [
        'api/v1/ping',
        'api/v1/login',
        'api/v1/refresh',
    ];

    public function __construct(Auth $auth, JWT $jwt)
    {
        parent::__construct($auth);
        $this->jwt = $jwt;
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param \Illuminate\Http\Request $request
     * @param array $guards
     * @return \Illuminate\Http\Request
     *
     * @throws UnableToFoundTokenException
     */
    protected function authenticate($request, array $guards)
    {
        if (in_array($request->path(), $this->whitelistedUris)) {
            return $request;
        }
        try {
            if (!$this->jwt->parseToken()->check()) {
                throw new UnauthorizedHttpException('jwt-auth', 'User not found');
            }
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            throw new UnableToFoundTokenException($e->getMessage());
        }
    }
}
