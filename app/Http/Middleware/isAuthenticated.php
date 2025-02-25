<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class isAuthenticated
{
    /**
     * The authentication factory instance.
     *
     * @var Auth
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param Auth $auth
     *
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param         $request
     * @param Closure $next
     * @param         $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard)
    {
        $this->auth->shouldUse($guard);

        return $next($request);
    }
}
