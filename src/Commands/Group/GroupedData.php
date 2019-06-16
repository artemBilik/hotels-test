<?php


namespace Hotels\Commands\Group;


use Hotels\App\RowInterface;

class GroupedData implements RowInterface
{
    private $field;
    private $value;

    public function __construct(string $field, string $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function toArray(): array
    {
        return ['field' => $this->field, 'value' => $this->value];
    }
}