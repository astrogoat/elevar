<?php

namespace Astrogoat\Elevar\Http\Middleware;

use Astrogoat\Elevar\Elevar;
use Closure;
use Illuminate\Http\Request;

class StoreUtmQueryParams
{
    public function handle(Request $request, Closure $next)
    {
        $elevar = app(Elevar::class);

        $elevar->put($elevar->getMatchingRequestSources($request));

        return $next($request);
    }
}
