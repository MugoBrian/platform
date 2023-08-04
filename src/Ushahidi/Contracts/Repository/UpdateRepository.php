<?php

/**
 * Ushahidi Platform Update Repository
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Platform
 * @copyright  2022 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Contracts\Repository;

use Ushahidi\Contracts\Entity;

interface UpdateRepository
{
    /**
     * @param array|\Ushahidi\Contracts\Entity $entity
     *
     * @return void
     */
    public function update(Entity $entity);

    /**
     * @param Ushahidi\Contracts\Entity[]|\Illuminate\Support\Collection<\Ushahidi\Contracts\Entity> $entities
     *
     * @return void
     */
    // public function updateCollection($entities);
}
