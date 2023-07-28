<?php

namespace Ushahidi\Tests\Unit\Core\Ohanzee\Entity;

class MockData
{
    use \Ushahidi\Core\Concerns\TransformData;

    protected function getDefinition()
    {
        return [
            'date' => '*date',
        ];
    }

    public function pTransform($data)
    {
        return $this->transform($data);
    }
}
