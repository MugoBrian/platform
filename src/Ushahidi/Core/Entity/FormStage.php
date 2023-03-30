<?php
namespace Ushahidi\Core\Entity;

use Ushahidi\Contracts\Entity;

interface FormStage extends Entity
{
    const DEFAULT_TYPE = 'task';

    const DEFAULT_PRIORITY = 99;

    const DEFAULT_REQUIRED = 0;

    const DEFAULT_SHOW_WHEN_PUBLISHED = 1;

    const DEFAULT_TASK_IS_INTERNAL_ONLY = 1;
}
