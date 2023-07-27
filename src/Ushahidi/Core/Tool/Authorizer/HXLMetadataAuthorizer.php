<?php

/**
 * Ushahidi HXLMetadataAuthorizer Authorizer
 *
 * @author    Ushahidi Team <team@ushahidi.com>
 * @package   Ushahidi\Application
 * @copyright 2014 Ushahidi
 * @license   https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Tool\Authorizer;

use Ushahidi\Contracts\Entity;
use Ushahidi\Core\Concerns\AdminAccess;
use Ushahidi\Core\Concerns\OwnerAccess;
use Ushahidi\Core\Concerns\UserContext;
use Ushahidi\Core\Concerns\AccessPrivileges;
use Ushahidi\Core\Concerns\ControlAccess;

// The `HXLMetadataAuthorizer` class is responsible for access checks on `HXLMetadata` Entity
class HXLMetadataAuthorizer extends HXLAuthorizer
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

    use OwnerAccess;


    /* Authorizer */
    public function isAllowed(Entity $entity, $privilege)
    {
        if (parent::isAllowed($entity, $privilege)) {
            $user = $this->getUser();
            return $this->isUserOwner($entity, $user);
        }
        // If no other access checks succeed, we default to denying access
        return false;
    }
}
