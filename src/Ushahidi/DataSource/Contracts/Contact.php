<?php

/**
 * Ushahidi ContactEntity Types
 *
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Platform
 * @copyright  2022 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\DataSource\Contracts;

interface Contact
{
    // Valid contact types
    const EMAIL    = 'email';

    const PHONE    = 'phone';

    const TWITTER  = 'twitter';

    const WHATSAPP = 'whatsapp';
}
