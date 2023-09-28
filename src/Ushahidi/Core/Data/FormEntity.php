<?php
namespace Ushahidi\Core\Data;

use Ushahidi\Contracts\Entity;

interface FormEntity extends Entity
{

    const DEFAULT_TYPE = 'report';
    const DEFAULT_REQUIRE_APPROVAL = 1;
    const DEFAULT_EVERYONE_CAN_CREATE = 1;
    const DEFAULT_HIDE_AUTHOR = 0;
    const DEFAULT_HIDE_TIME = 0;
    const DEFAULT_HIDE_LOCATION = 0;
    const DEFAULT_DISABLED = 0;
    const DEFAULT_BASE_LANGUAGE = 'en-US';
}
