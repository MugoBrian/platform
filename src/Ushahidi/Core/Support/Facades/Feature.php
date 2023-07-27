<?php

namespace Ushahidi\Core\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ushahidi\Core\Support\FeatureManager
 */
class Feature extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'feature';
    }
}
