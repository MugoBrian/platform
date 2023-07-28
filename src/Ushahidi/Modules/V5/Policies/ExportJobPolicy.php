<?php

namespace Ushahidi\Modules\V5\Policies;

use Ushahidi\Core\Entity\Permission;
use Ushahidi\Core\Concerns\OwnerAccess;
use Ushahidi\Core\Concerns\ControlAccess;
use Ushahidi\Core\Concerns\AccessPrivileges;
use Ushahidi\Core\Concerns\AdminAccess;
use Ushahidi\Core\Concerns\UserContext;
use Ushahidi\Core\Concerns\PrivateDeployment;
use Ushahidi\Authzn\GenericUser as User;
use Ushahidi\Modules\V5\Models\ExportJob;
use Ushahidi\Core\Ohanzee\Entity\ExportJob as OhanzeeExportJob;

class ExportJobPolicy
{
    // The access checks are run under the context of a specific user
    use UserContext;

    // Check that the user has the necessary permissions
    use ControlAccess;

    // It uses methods from several traits to check access:
    // - `AdminAccess` to check if the user has admin access
    use AdminAccess;

    use OwnerAccess;

    // It uses `AccessPrivileges` to provide the `getAllowedPrivs` method.
    use AccessPrivileges;

    // It uses `PrivateDeployment` to check whether a deployment is private
    use PrivateDeployment;

    protected $user;

    /**
     * @return bool
     */
    public function index()
    {
        $empty_export_job_entity = new OhanzeeExportJob();
        return $this->isAllowed($empty_export_job_entity, 'search');
    }

    public function show(User $user, ExportJob $export_job)
    {
        $export_job_entity = new OhanzeeExportJob($export_job->toArray());
        return $this->isAllowed($export_job_entity, 'read');
    }

    public function delete(User $user, ExportJob $export_job)
    {
        $export_job_entity = new OhanzeeExportJob($export_job->toArray());
        return $this->isAllowed($export_job_entity, 'delete');
    }

    public function update(User $user, ExportJob $export_job)
    {
        // we convert to a ExportJob entity to be able to continue using the old authorizers and classes.
        $export_job_entity = new OhanzeeExportJob($export_job->toArray());
        return $this->isAllowed($export_job_entity, 'update');
    }

    public function store(User $user, ExportJob $export_job)
    {
        // we convert to a export_job_entity entity to be able to continue using the old authorizers and classes.
        $export_job_entity = new OhanzeeExportJob($export_job->toArray());
        return $this->isAllowed($export_job_entity, 'create');
    }

    public function isAllowed($entity, $privilege)
    {
        $authorizer = service('authorizer.export_job');

        // These checks are run within the user context.
        $user = $authorizer->getUser();

        // Only logged in users have access if the deployment is private
        if (!$this->canAccessDeployment($user)) {
            return false;
        }

        // First check whether there is a role with the right permissions
        if ($authorizer->acl->hasPermission($user, Permission::DATA_IMPORT_EXPORT) or
            $authorizer->acl->hasPermission($user, Permission::LEGACY_DATA_IMPORT)
        ) {
            return true;
        }

        // First check whether there is a role with the right permissions
        if ($authorizer->acl->hasPermission($user, Permission::MANAGE_POSTS)) {
            return true;
        }

        // Admin is allowed access to everything
        if ($this->isUserAdmin($user)) {
            return true;
        }

        // If no other access checks succeed, we default to denying access
        return false;
    }
}
