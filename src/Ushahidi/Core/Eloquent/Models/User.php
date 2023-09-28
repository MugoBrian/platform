<?php
namespace Ushahidi\Core\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Ushahidi\Core\Data\UserEntity;
use Ushahidi\Core\Eloquent\Concerns\HasState;

class User extends Model implements UserEntity
{
    use HasState;

    public function getId()
    {
        return $this->getAttributeFromArray($this->getKeyName());
    }

    public function getResource()
    {
        return 'users';
    }

    public function asArray()
    {
        return $this->toArray();
    }
}
