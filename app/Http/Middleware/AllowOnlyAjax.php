<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AllowOnlyAjax
{
    /**
     * Miidleware, которы пропускает только ajax запросы
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->ajax()){
            return new HttpException(403);
        }
        return $next($request);
    }
}
