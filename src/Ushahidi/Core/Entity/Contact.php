<?php
namespace Ushahidi\Core\Entity;

use Ushahidi\Contracts\Entity;
use Ushahidi\Contracts\OwnableEntity;
use Ushahidi\Contracts\ParentableEntity;

interface Contact extends Entity, OwnableEntity, ParentableEntity
{
    // Valid contact types
    const EMAIL    = 'email';

    const PHONE    = 'phone';

    const TWITTER  = 'twitter';

    const WHATSAPP = 'whatsapp';
}
