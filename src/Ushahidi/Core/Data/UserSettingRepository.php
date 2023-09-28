<?php

/**
 * Repository for User Setting
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Platform
 * @copyright  2018 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Data;

use Ushahidi\Contracts\Repository\EntityGet;
use Ushahidi\Contracts\Repository\EntityExists;

interface UserSettingRepository extends
    EntityGet,
    EntityExists
{

    /**
     * @param mixed $user_id
     *
     * @return \Ushahidi\Core\Data\UserSettingEntity[]
     */
    public function getByUser($user_id);
}
