<?php

namespace Subsystem\SPA\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApplicationDataScope
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($this->applyDataScopePipeline($request));
    }

    protected function applyDataScopePipeline(Request $request)
    {
        return app(\Illuminate\Pipeline\Pipeline::class) 
        ->send($request) 
        ->through($this->getDataScopes())
        ->then(function($request){ return $request;});
    }

    protected function getDataScopes() : array
    {
        return create_array(app()->make(\Subsystem\SPA\Contracts\DataScope::class));
    }

}
