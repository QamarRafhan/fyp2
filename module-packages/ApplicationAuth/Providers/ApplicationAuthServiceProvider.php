<?php

namespace Modules\ApplicationAuth\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\ApplicationAuth\Entities\ApplicationUser;
use Modules\ApplicationAuth\Observers\ApplicationUserObserver;

class ApplicationAuthServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected string $moduleName = 'ApplicationAuth';

    /**
     * @var string $moduleNameLower
     */
    protected string $moduleNameLower = 'application-auth';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        /** @var \Modules\ApplicationAuth\Entities\ApplicationUser $model */
        $model = $this->app['config']['application-auth.models.user'] ?: ApplicationUser::class;
        $model::observe(ApplicationUserObserver::class);

        $this->registerTranslations();

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(module_path($this->moduleName, 'Database'));
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();

        $this->registerViews();

        $this->configureGuard();

        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
                ],
                'config'
            );
        }

        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'),
            $this->moduleNameLower
        );
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        if ($this->app->runningInConsole()) {
            $this->publishes(
                [$sourcePath => $viewPath],
                ['views', $this->moduleNameLower . '-module-views']
            );
        }

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    protected function configureGuard(): void
    {
        $guardName = $this->app['config']['application-auth.auth.guard'] ?? 'application';
        $providerName = $this->app['config']['application-auth.auth.provider'] ?? 'application_users';

        $this->app['config']['auth.guards.' . $guardName] = [
            'driver' => 'jwt',
            'provider' => $providerName,
        ];

        $this->app['config']['auth.providers.' . $providerName] = [
            'driver' => 'eloquent',
            'model' => $this->app['config']['application-auth.models.user'] ?: ApplicationUser::class,
        ];
    }

    /**
     * @return array
     */
    private function getPublishableViewPaths(): array
    {
        $paths = [];

        foreach ($this->app['config']['view.paths'] as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }

        return $paths;
    }
}
