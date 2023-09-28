<?php
namespace Ushahidi\Core\Data;

use Ushahidi\Contracts\Entity;
use Ushahidi\Contracts\OwnableEntity;
use Ushahidi\Contracts\ParentableEntity;

interface ContactEntity extends Entity, OwnableEntity, ParentableEntity
{
    // Valid contact types
    const EMAIL    = 'email';

    const PHONE    = 'phone';

    const TWITTER  = 'twitter';

    const WHATSAPP = 'whatsapp';
}
