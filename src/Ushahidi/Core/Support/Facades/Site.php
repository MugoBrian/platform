<?php

namespace Ushahidi\Core\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ushahidi\Core\Support\SiteManager
 */
class Site extends Facade
{
    /**
     * Get the registered name of the service.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'site';
    }
}
