<?php

/**
 * Ushahidi Export Job Authorizer
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Application
 * @copyright  2018 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Tool\Authorizer;

use Ushahidi\Contracts\Entity;
use Ushahidi\Contracts\Authorizer;
use Ushahidi\Core\Concerns\AdminAccess;
use Ushahidi\Core\Concerns\OwnerAccess;
use Ushahidi\Core\Concerns\UserContext;
use Ushahidi\Core\Concerns\AccessPrivileges;
use Ushahidi\Core\Concerns\PrivateDeployment;
use Ushahidi\Core\Concerns\ControlAccess;

class ExternalAuthorizer implements Authorizer
{
    // The access checks are run under the context of a specific user
    use UserContext;

    // To check whether the user has admin access
    use AdminAccess;

    // To check whether user owns the webhook
    use OwnerAccess;

    // It uses `AccessPrivileges` to provide the `getAllowedPrivs` method.
    use AccessPrivileges;

    // It uses `PrivateDeployment` to check whether a deployment is private
    use PrivateDeployment;

    // Check that the user has the necessary permissions
    // if roles are available for this deployment.
    use ControlAccess;


    /* Authorizer */
    public function isAllowed(Entity $entity, $privilege)
    {
        // The CLI and external auth tools do not provide a user at present
        // auth validation is performed via the verifier tool
        // with shared secret and api key
        return true;
    }
}
