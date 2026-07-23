<?php

namespace Misakstvanu\SubdirectoryMigrations;

use Illuminate\Support\ServiceProvider;

class SubdirectoryMigrationsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->extend('migrator', function ($migrator, $app) {
            return new SubdirectoryMigrator(
                $app['migration.repository'],
                $app['db'],
                $app['files'],
                $app['events']
            );
        });
    }
}
