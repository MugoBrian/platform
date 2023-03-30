<?php

/**
 * Ushahidi Platform Static Entity
 *
 * Static entities have known properties.
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Platform
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Ohanzee;

use Ushahidi\Contracts\Entity;

abstract class StaticEntity implements Entity
{
    // Static entities are stateful.
    use StatefulData;

    /**
     * Transparent access to private entity properties.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        if (property_exists($this, $key)) {
            return $this->$key;
        }
    }

    /**
     * Transparent checking of private entity properties.
     *
     * @param  string  $key
     * @return mixed
     */
    final public function __isset($key)
    {
        return property_exists($this, $key);
    }

    // StatefulData
    final protected function setStateValue($key, $value)
    {
        if (property_exists($this, $key)) {
            $this->$key = $value;
        }
    }

    // Entity
    public function asArray()
    {
        return get_object_vars($this);
    }

    // Entity
    public function getId()
    {
        return $this->id;
    }

    // StatefulData
    protected function getImmutable()
    {
        return ['id', 'created'];
    }
}