<?php

/**
 * Repository for Form Entity
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Platform
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Data;

use Ushahidi\Contracts\Repository\EntityCreate;
use Ushahidi\Contracts\Repository\EntityCreateMany;
use Ushahidi\Contracts\Repository\EntityGet;
use Ushahidi\Contracts\Repository\EntityExists;

interface FormRepository extends
    EntityGet,
    EntityExists,
    EntityCreate,
    EntityCreateMany
{
    public function isTypeHidden($form_id, $type);

    /**
     * Get all form attributes and stages for the forms matching the given ids.
     *
     * @param array $form_ids The array of form ids to filter by
     */
    public function getAllFormStagesAttributes(array $form_ids = []): \Illuminate\Support\Collection;

    public function getRolesThatCanCreatePosts($form_id);
}
