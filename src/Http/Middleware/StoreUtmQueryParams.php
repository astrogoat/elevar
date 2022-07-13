<?php

namespace Astrogoat\Elevar\Http\Middleware;

use Astrogoat\Elevar\Elevar;
use Closure;
use Illuminate\Http\Request;

class StoreUtmQueryParams
{
    protected Utm $utm;

    public function handle(Request $request, Closure $next)
    {
        $this->elevar = app(Elevar::class);

        $this->elevar->put($this->elevar->getMatchingRequestSources($request));

        return $next($request);
    }
}
