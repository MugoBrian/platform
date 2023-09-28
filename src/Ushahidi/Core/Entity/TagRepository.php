<?php

/**
 * Repository for Tags
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Application
 * @copyright  2022 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Entity;

use Ushahidi\Contracts\Repository\EntityCreate;
use Ushahidi\Contracts\Repository\EntityCreateMany;
use Ushahidi\Contracts\Repository\EntityGet;
use Ushahidi\Contracts\Repository\EntityExists;

interface TagRepository extends
    EntityGet,
    EntityCreate,
    EntityCreateMany,
    EntityExists
{
    public function doesTagExist($value);
}
