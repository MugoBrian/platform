<?php

/**
 * Ushahidi Platform Set Entity
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Platform
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Data;

use Ushahidi\Contracts\Entity;
use Ushahidi\Contracts\OwnableEntity;

/**
 * @property string $name
 * @property array $role
 */
interface SetEntity extends Entity, OwnableEntity
{
    const DEFAULT_VIEW = 'list';

    const DEFAULT_FEATURED = 0;
}
