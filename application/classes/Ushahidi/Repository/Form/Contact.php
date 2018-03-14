<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Ushahidi Form Contact Repository
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Application
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

use Ushahidi\Core\Data;
use Ushahidi\Core\Entity;
use Ushahidi\Core\SearchData;
use Ushahidi\Core\Entity\FormContact;
use Ushahidi\Core\Entity\FormContactRepository;

class Ushahidi_Repository_Form_Contact extends Ushahidi_Repository implements
	FormContactRepository
{
	// Ushahidi_Repository
	protected function getTable()
	{
		return 'form_contacts';
	}

	// CreateRepository
	// ReadRepository
	public function getEntity(Array $data = null)
	{
		return new FormContact($data);
	}

	// SearchRepository
	public function getSearchFields()
	{
		return ['form_id', 'contacts'];
	}

	// Ushahidi_Repository
	protected function setSearchConditions(SearchData $search)
	{
		$query = $this->search_query;

		if ($search->form_id) {
			$query->where('form_id', '=', $search->form_id);
		}

		if ($search->contacts) {
			$query->where('contacts_id', 'in', $search->contacts);
		}
	}

	// FormContactRepository
	public function updateCollection(Array $entities)
	{
		if (empty($entities)) {
			return;
		}

		// Delete all existing form contact records
		// Assuming all entites have the same form id
		$this->deleteAllForForm(current($entities)->form_id);

		$query = DB::insert($this->getTable())
			->columns(array_keys(current($entities)->asArray()));

		foreach($entities as $entity) {
			$query->values($entity->asArray());
		}

		$query->execute($this->db);

		return $entities;
	}

	// FormContactRepository
	public function getByForm($form_id)
	{
		$query = $this->selectQuery(compact($form_id));
		$results = $query->execute($this->db);

		return $this->getCollection($results->as_array());
	}

	// ValuesForFormContactRepository
	public function deleteAllForForm($form_id)
	{
		return $this->executeDelete(compact('form_id'));
	}

	// FormContactRepository
	public function existsInFormContact($contact_id, $form_id)
	{
		return (bool) $this->selectCount(compact('contact_id', 'form_id'));
	}

}