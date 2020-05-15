<?php

namespace Sysbox\LaravelAssetManager\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelAssetManager extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravelassetmanager';
    }
}
