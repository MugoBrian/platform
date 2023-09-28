<?php

namespace Ushahidi\Modules\V5\Policies;

use Ushahidi\Core\Support\GenericUser as User;
use Ushahidi\Core\Ohanzee\Entity\Notification as OhanzeeNotification;
use Ushahidi\Modules\V5\Models\Notification as EloquentNotification;
use Ushahidi\Contracts\Permission;
use Ushahidi\Core\Concerns\AdminAccess;
use Ushahidi\Core\Concerns\UserContext;
use Ushahidi\Core\Concerns\AccessPrivileges;
use Ushahidi\Core\Concerns\PrivateDeployment;
use Ushahidi\Core\Concerns\OwnerAccess;
use Ushahidi\Core\Concerns\ControlAccess;

class NotificationPolicy
{

    // The access checks are run under the context of a specific user
    use UserContext;

    // It uses methods from several traits to check access:
    // - `AdminAccess` to check if the user has admin access
    use AdminAccess;

    // It uses `AccessPrivileges` to provide the `getAllowedPrivs` method.
    use AccessPrivileges;

    // It uses `PrivateDeployment` to check whether a deployment is private
    use PrivateDeployment;

    // Check that the user has the necessary permissions
    use ControlAccess;

    use OwnerAccess;

    protected $user;

    public function index()
    {
        $empty_notification_entity = new OhanzeeNotification();
        return $this->isAllowed($empty_notification_entity, 'search');
    }

    public function show(User $user, EloquentNotification $notification)
    {
        $notification_entity = new OhanzeeNotification($notification->toArray());
        return $this->isAllowed($notification_entity, 'read');
    }

    public function delete(User $user, EloquentNotification $notification)
    {
        $notification_entity = new OhanzeeNotification($notification->toArray());
        return $this->isAllowed($notification_entity, 'delete');
    }

    public function update(User $user, EloquentNotification $notification)
    {
        // we convert to a Notification entity to be able to continue using the old authorizers and classes.
        $notification_entity = new OhanzeeNotification($notification->toArray());
        return $this->isAllowed($notification_entity, 'update');
    }

    public function store(User $user, EloquentNotification $notification)
    {
        // we convert to a notification_entity entity to be able to continue using the old authorizers and classes.
        $notification_entity = new OhanzeeNotification($notification->toArray());
        return $this->isAllowed($notification_entity, 'create');
    }


    /**
     * @param $entity
     * @param string $privilege
     * @return bool
     */
    public function isAllowed($entity, $privilege)
    {
        $authorizer = service('authorizer.notification');

        // These checks are run within the user context.
        $user = $authorizer->getUser();

         // Only logged in users have access if the deployment is private
        if (!$this->canAccessDeployment($user)) {
            return false;
        }

        // Admin is allowed access to everything
        if ($this->isUserAdmin($user)) {
            return true;
        }

        // Allow create, read, update and delete if owner.
        if ($this->isUserOwner($entity, $user)
            and in_array($privilege, ['create', 'read', 'update', 'delete'])) {
            return true;
        }

        // Logged in users can subscribe to and search notifications
        if ($user->getId() and in_array($privilege, ['search'])) {
            return true;
        }

        // If no other access checks succeed, we default to denying access
        return false;
    }
}
