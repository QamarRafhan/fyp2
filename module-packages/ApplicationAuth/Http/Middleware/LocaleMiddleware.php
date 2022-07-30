<?php
namespace Modules\ApplicationAuth\Http\Middleware;


use Illuminate\Support\Arr;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Modules\ApplicationAuth\Contracts\HasLocalePreference;

class LocaleMiddleware
{
    /** @var \Illuminate\Contracts\Foundation\Application */
    private $app;

    /** @var \Illuminate\Contracts\Config\Repository */
    private $config;

    public function __construct(Application $app, Repository $config)
    {
        $this->app = $app;

        $this->config = $config;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $locales = array_unique(array_keys($this->config->get('app.global.locales', [])));
        if (empty($locales)) {
            $locales = array_unique(
                [
                    $this->config->get('app.locale'),
                    $this->config->get('app.fallback_locale'),
                ]
            );
        }

        if ($request->hasHeader('X-Locale')) {
            $locale = Arr::last((array)$request->header('X-Locale'));

            if (in_array($locale, $locales, true)) {
                $this->app->setLocale($locale);

                if (($user = $request->user()) && $user instanceof HasLocalePreference) {
                    $user->setPreferredLocale($locale);
                }
            }
        } elseif (($user = $request->user()) &&
                  $user instanceof HasLocalePreference &&
                  in_array($locale = $user->preferredLocale(), $locales, true)) {
            $this->app->setLocale($locale);
        }

        return $next($request);
    }
}
