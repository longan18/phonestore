<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected array $guards = [];

    /**
     * @param Request  $request
     * @param Closure $next
     * @param string[] ...$guards
     *
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards): mixed
    {
        $this->guards = $guards;
        return parent::handle($request, $next, ...$guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     *
     * @return void
     * @throws AuthenticationException
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if ($this->guards[0] == GUARD_ADMIN) {
                return route('admin.page-login');
            }
        }
    }
}
