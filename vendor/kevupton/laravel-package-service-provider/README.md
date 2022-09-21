# laravel-package-service-provider

Improved service provider functions for handling cross application code.

### Src

```php

<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 3/12/2017
 * Time: 6:11 PM
 */
namespace Kevupton\LaravelPackageServiceProvider;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Registers a configuration
     *
     * @param string $path
     * @param string $name
     */
    protected function registerConfig ($path, $name)
    {
        $this->publishes([__DIR__ . $path => config_path($name)]);
    }

    /**
     * Determines whether this application is an instance of Lumen
     *
     * @return bool
     */
    protected function isLumen ()
    {
        return is_a($this->app, 'Laravel\Lumen\Application');
    }

    /**
     * Determines whether this application is an instance of Laravel
     *
     * @return bool
     */
    protected function isLaravel ()
    {
        return is_a($this->app, 'Illuminate\Foundation\Application');
    }

    /**
     * Register Alias function to register an alias based upon
     * whether they are using lumen or laravel
     *
     * @param string $class
     * @param string $name
     */
    protected function registerAlias ($class, $name)
    {
        if ($this->isLaravel()) {
            AliasLoader::getInstance()->alias($name, $class);
        } elseif ($this->isLumen()) {
            if (!class_exists($name)) {
                class_alias($class, $name);
            }
        }
    }
}

```