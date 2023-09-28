<?php

/**
 * Ushahidi Notification Queue Repository
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Application
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Ohanzee\Repositories\Notification;

use Ushahidi\Contracts\Entity;
use Ushahidi\Contracts\Repository\EntityGet;
use Ushahidi\Contracts\Repository\EntityExists;
use Ushahidi\Contracts\Repository\CreateRepository;
use Ushahidi\Core\Ohanzee\Entities\NotificationQueue;
use Ushahidi\Core\Ohanzee\Repositories\OhanzeeRepository;
use Ushahidi\Core\Tool\SearchData;

class QueueRepository extends OhanzeeRepository implements EntityGet, EntityExists, CreateRepository
{
    protected function getTable()
    {
        return 'notification_queue';
    }

    // OhanzeeRepository
    public function setSearchConditions(SearchData $search)
    {
        $query = $this->search_query;

        foreach ([
            'post',
            'set',
        ] as $fk) {
            if ($search->$fk) {
                $query->where("notification_queue.{$fk}_id", '=', $search->$fk);
            }
        }
    }

    public function getEntity(array $data = null)
    {
        return new NotificationQueue($data);
    }

    // CreateRepository
    public function create(Entity $entity)
    {
        $state = [
            'created' => time(),
        ];

        return parent::create($entity->setState($state));
    }

    // NotificationQueueRepository
    public function getNotifications($limit)
    {
        $query = $this->selectQuery()
                      ->limit($limit)
                      ->order_by('created', 'ASC');

        $results = $query->execute($this->db());

        return $this->getCollection($results->as_array());
    }

    public function getSearchFields()
    {
        return [
            'post',
            'set'
        ];
    }
}
