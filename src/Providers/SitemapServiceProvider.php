<?php


namespace Curlychoi\LaravelSitemap\Providers;


use Curlychoi\LaravelSitemap\Repositories\SitemapRepository;
use Curlychoi\LaravelSitemap\Repositories\SitemapRepositoryInterface;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SitemapServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerResources();
        $this->registerRoutes();

        if ($this->app->runningInConsole()) {
            $this->registerPublishingMigrations();
        }
    }

    public function register()
    {
        $this->app->bind(SitemapRepositoryInterface::class, SitemapRepository::class);
        $this->app->bind('sitemap', SitemapRepositoryInterface::class);
    }

    private function registerResources()
    {
        if ($this->app->runningUnitTests()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        }
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'sitemap');
    }

    private function registerRoutes()
    {
        Route::group($this->routeConfigurations(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        });
    }

    protected function routeConfigurations()
    {
        return [
            'namespace' => 'curlychoi\LarvalSitemap\Http\Controller',
        ];
    }

    private function registerPublishingMigrations()
    {
        $this->publishes([
            __DIR__ . '/../../database/migrations/' => database_path('migrations')
        ], 'migrations');
    }
}