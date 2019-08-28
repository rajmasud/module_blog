<?php
namespace Modules\Blog\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanReadPostsMiddleware{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
