<?php

namespace RyanChandler\Notes;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use AlphaOlomi\Notes\Commands\NotesCommand;

class NotesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-notes')
            ->hasConfigFile();
    }

    public function packageBooted()
    {
        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations',
        ]);
    }
}
