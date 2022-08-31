<?php

namespace Astrogoat\Elevar;

use Astrogoat\Elevar\Settings\ElevarSettings;
use Helix\Lego\Apps\App;
use Helix\Lego\LegoManager;
use Helix\Lego\Apps\Services\IncludeFrontendViews;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ElevarServiceProvider extends PackageServiceProvider
{
    public function registerApp(App $app)
    {
        return $app
            ->name('elevar')
            ->settings(ElevarSettings::class)
            ->migrations([
                __DIR__ . '/../database/migrations',
                __DIR__ . '/../database/migrations/settings',
            ])->includeFrontendViews(function (IncludeFrontendViews $views) {
                return $views->addToHead(['elevar::script']);
            });
    }

    public function registeringPackage()
    {
        $this->app->register(ElevarRouteServiceProvider::class);

        $this->callAfterResolving('lego', function (LegoManager $lego) {
            $lego->registerApp(fn (App $app) => $this->registerApp($app));
        });
    }

    public function configurePackage(Package $package): void
    {
        $package->name('elevar')->hasViews()->hasConfigFile();
    }
}
