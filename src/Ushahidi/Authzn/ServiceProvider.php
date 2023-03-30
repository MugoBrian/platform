<?php

namespace Ushahidi\Authzn;

use Ushahidi\Contracts\AccessControl as AccessControlContract;
use Ushahidi\Contracts\Repository\Entity\RoleRepository;
use Ushahidi\Core\Tool\AccessControl;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AccessControlContract::class, AccessControl::class);

        $this->app->extend(AccessController::class, function (AccessControl $acl) {
            return $acl->setRoleRepo($this->app[RoleRepository::class]);
        });

        // $this->app->singleton(Session::class, function ($app) {
        //     return new Session();
        // });
    }
}
