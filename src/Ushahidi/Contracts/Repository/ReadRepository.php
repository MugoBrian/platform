<?php

/**
 * Ushahidi Platform Read Repository
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Platform
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Contracts\Repository;

use Ushahidi\Contracts\Repository\EntityExists;
use Ushahidi\Contracts\Repository\EntityGet;

interface ReadRepository extends EntityGet, EntityExists
{
}
