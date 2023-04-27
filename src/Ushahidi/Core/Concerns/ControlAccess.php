<?php

/**
 * Ushahidi Acl Trait
 *
 * Gives objects a method for storing an ACL instance.
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Application
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Concerns;

use Ushahidi\Contracts\AccessControl as AccessControlInterface;

trait ControlAccess
{
    public $acl;

    public function setAcl(AccessControlInterface $acl)
    {
        $this->acl = $acl;
    }
}
