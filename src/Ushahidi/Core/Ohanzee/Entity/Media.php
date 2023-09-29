<?php

/**
 * Ushahidi Media Entity
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Platform
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Ohanzee\Entity;

use Ushahidi\Core\Ohanzee\StaticEntity;
use Ushahidi\Core\Data\MediaEntity;

class Media extends StaticEntity implements MediaEntity
{
    protected $id;
    protected $user_id;
    protected $caption;
    protected $created;
    protected $updated;
    protected $mime;
    protected $o_filename;
    protected $o_size;
    protected $o_width;
    protected $o_height;

    // DataTransformer
    protected function getDefinition()
    {
        return [
            'id'         => 'int',
            'user_id'    => 'int',
            'caption'    => 'string',
            'created'    => 'int',
            'updated'    => 'int',
            'mime'       => 'string',
            'o_filename' => 'string',
            'o_size'     => 'int',
            'o_width'    => 'int',
            'o_height'   => 'int',
        ];
    }

    // Entity
    public function getResource()
    {
        return 'media';
    }

    // StatefulData
    protected function getDefaultData()
    {
        return [
            'mime' => 'text/plain',
            'o_size' => 0,
            'o_width' => null,
            'o_height' => null,
        ];
    }
}
