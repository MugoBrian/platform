<?php

namespace Ushahidi\Modules\V5\Policies;

use Ushahidi\Contracts\Entity;
use Ushahidi\Core\Data\PermissionEntity as Permission;
use Ushahidi\Core\Concerns\AccessPrivileges;
use Ushahidi\Core\Concerns\AdminAccess;
use Ushahidi\Core\Concerns\UserContext;
use Ushahidi\Core\Concerns\ControlAccess;
use Ushahidi\Core\Support\GenericUser as User;
use Ushahidi\Modules\V5\Models\Config as EloquentConfig;
use Ushahidi\Core\Ohanzee\Entity\Config as OhanzeeConfig;

class ConfigPolicy
{

    // The access checks are run under the context of a specific user
    use UserContext;

    // It uses `AdminAccess` to check if the user has admin access
    use AdminAccess;

    // It uses `AccessPrivileges` to provide the `getAllowedPrivs` method.
    use AccessPrivileges;

    // Check that the user has the necessary permissions
    // if roles are available for this deployment.
    use ControlAccess;

    protected $authorizer;

    /**
     * Public config groups
     * @var [string, ...]
     */
    protected $public_groups = ['features', 'map', 'site', 'deployment_id'];

    /**
     * Public config groups
     * @var [string, ...]
     */
    protected $readonly_groups = ['features', 'deployment_id'];

    public function __construct(AccessControl $acl, TagAuthorizer $authorizer)
    {
        $this->authorizer = $authorizer->setAcl($acl);
    }

    public function index()
    {
        $empty_config_entity = new OhanzeeConfig();
        return $this->isAllowed($empty_config_entity, 'search');
    }

    public function show(User $user, EloquentConfig $config)
    {
        $config_entity = new OhanzeeConfig($config->toArray());
        return $this->isAllowed($config_entity, 'read');
    }

    public function delete(User $user, EloquentConfig $config)
    {
        $config_entity = new OhanzeeConfig($config->toArray());
        return $this->isAllowed($config_entity, 'delete');
    }

    public function update(User $user, EloquentConfig $config)
    {
        // we convert to a ConfigEntity entity to be able to continue using the old authorizers and classes.
        $config_entity = new OhanzeeConfig($config->toArray());
        return $this->isAllowed($config_entity, 'update');
    }

    public function store(User $user, EloquentConfig $config)
    {
        // we convert to a config_entity entity to be able to continue using the old authorizers and classes.
        $config_entity = new OhanzeeConfig($config->toArray());
        return $this->isAllowed($config_entity, 'create');
    }


    /**
     * @param $entity
     * @param string $privilege
     * @return bool
     */
    public function isAllowed($entity, $privilege)
    {
        $authorizer = service('authorizer.config');

        // These checks are run within the user context.
        $user = $authorizer->getUser();

        // If a config group is read only *no one* can edit it (not even admin)
        if (in_array($privilege, ['create', 'update']) && $this->isConfigReadOnly($entity)) {
            return false;
        }

        // Allow role with the right permissions to do everything else
        if ($authorizer->acl->hasPermission($user, Permission::MANAGE_SETTINGS)) {
            return true;
        }

        // If a user has the 'admin' role, they can do pretty much everything else
        if ($this->isUserAdmin($user)) {
            return true;
        }

        // If a config group is public then *anyone* can view it.
        if (in_array($privilege, ['read', 'search']) && $this->isConfigPublic($entity)) {
            return true;
        }

        // If no other access checks succeed, we default to denying access
        return false;
    }


     /**
     * Check if a config group is public
     * @param  Entity $entity
     * @return boolean
     */
    protected function isConfigPublic(Entity $entity)
    {
        // ConfigEntity that is unloaded is treated as public.
        if (!$entity->getId()) {
            return true;
        }

        if (in_array($entity->getId(), $this->public_groups)) {
            return true;
        }

        return false;
    }

    /**
     * Check if a config group is read only
     * @param  Entity  $entity
     * @return boolean
     */
    protected function isConfigReadOnly(Entity $entity)
    {
        // ConfigEntity that is unloaded is treated as writable.
        if (!$entity->getId()) {
            return false;
        }

        if (in_array($entity->getId(), $this->readonly_groups)) {
            return true;
        }

        return false;
    }
}
