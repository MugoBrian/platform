<?php

/**
 * Ushahidi Notification
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Platform
 * @copyright  2023 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Data;

use Ushahidi\Contracts\Entity;
use Ushahidi\Contracts\OwnableEntity;

/**
 * @property int $set_id
 */
interface NotificationEntity extends Entity, OwnableEntity
{

}
