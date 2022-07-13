<?php

namespace Astrogoat\Elevar;

use Astrogoat\Elevar\Settings\ElevarSettings;
use Astrogoat\Elevar\Http\Middleware\StoreUtmQueryParams;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Event;
use Stancl\Tenancy\Events\TenancyBootstrapped;

class ElevarRouteServiceProvider extends RouteServiceProvider
{
    public function boot()
    {
        Event::listen(TenancyBootstrapped::class, function () {
            if (! app()->runningInConsole() && app(ElevarSettings::class)->isEnabled()) {
                $this->pushMiddlewareToGroup('web', StoreUtmQueryParams::class);
            }
        });
    }
}
