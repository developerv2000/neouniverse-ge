<?php

namespace App\Http\Middleware;

/**
 * @author Bobur Nuridinov <bobnuridinov@gmail.com> 
 */

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class Language
{

    public function __construct(Application $app, Request $request)
    {
        $this->app = $app;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     * change applications locale into sessions stored locale on app boot
     * set default applications locale If sessions locale is empty 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $this->app->setLocale(session('appLocale', config('app.locale')));

        return $next($request);
    }
}
