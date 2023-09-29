<?php

/**
 * Ushahidi Message
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Platform
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Ohanzee\Entity;

use Ushahidi\Core\Ohanzee\StaticEntity;
use Ushahidi\Core\Data\MessageEntity;

class Message extends StaticEntity implements MessageEntity
{
    const DEFAULT_STATUS = self::PENDING;

    protected $id;
    protected $parent_id;
    protected $contact_id;
    protected $post_id;
    protected $user_id;
    protected $data_source;
    protected $data_source_message_id;
    protected $title;
    protected $message;
    protected $datetime;
    protected $type;
    protected $status;
    protected $direction;
    protected $created;
    protected $additional_data;
    protected $notification_post_id;
    // Optionally including contact directly with message
    protected $contact;
    protected $contact_type;

    // DataTransformer
    protected function getDefinition()
    {
        return [
            'id'         => 'int',
            'parent_id'  => 'int',
            'contact_id' => 'int',
            'post_id'    => 'int',
            'user_id'    => 'int',
            'title'      => 'string',
            'message'    => 'string',
            'datetime'   => '*date',
            'type'       => 'string',
            'status'     => 'string',
            'direction'  => 'string',
            'created'    => 'int',
            // data provider relations
            'data_source'            => 'string',
            'data_source_message_id' => 'string',
            // any additional message data
            'additional_data' => '*json',
            'notification_post_id' => 'int',
            'contact' => 'string',
            'contact_type' => 'string',
        ];
    }

    protected function getDefaultData()
    {
        return [
            'status' => self::PENDING,
        ];
    }

    // Entity
    public function getResource()
    {
        return 'messages';
    }

    // StatefulData
    protected function getImmutable()
    {
        return array_merge(parent::getImmutable(), ['direction', 'parent_id']);
    }

    // StatefulData
    protected function getDerived()
    {
        return [
            'user_id' => ['user', 'user.id'], /* alias */
        ];
    }
}
