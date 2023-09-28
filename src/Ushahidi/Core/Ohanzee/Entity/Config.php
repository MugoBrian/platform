<?php

/**
 * Ushahidi ConfigEntity Entity
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Platform
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Ohanzee\Entity;

use Ushahidi\Core\Ohanzee\DynamicEntity;
use Ushahidi\Core\Data\ConfigEntity;

class Config extends DynamicEntity implements ConfigEntity
{
    // DataTransformer
    protected function getDefinition()
    {
        return ['id' => 'string'];
    }

    // Entity
    public function getResource()
    {
        return 'config';
    }
}
