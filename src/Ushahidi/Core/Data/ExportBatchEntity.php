<?php
namespace Ushahidi\Core\Data;

use Ushahidi\Contracts\Entity;

interface ExportBatchEntity extends Entity
{
    const STATUS_PENDING     = 'pending';

    const STATUS_COMPLETED   = 'completed';

    const STATUS_FAILED      = 'failed';
}
