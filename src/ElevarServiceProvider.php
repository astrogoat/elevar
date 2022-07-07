<?php

namespace Astrogoat\Elevar;

use Helix\Lego\Apps\App;
use Helix\Lego\LegoManager;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Astrogoat\Elevar\Settings\ElevarSettings;

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
            ]);
    }

    public function registeringPackage()
    {
        $this->callAfterResolving('lego', function (LegoManager $lego) {
            $lego->registerApp(fn (App $app) => $this->registerApp($app));
        });
    }

    public function configurePackage(Package $package): void
    {
        $package->name('elevar')->hasViews();
    }
}
