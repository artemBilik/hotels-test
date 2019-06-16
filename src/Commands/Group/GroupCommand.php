<?php


namespace Hotels\Commands\Group;


use Hotels\App\CommandInterface;
use Hotels\App\Hotel;
use Hotels\App\RowInterface;

class GroupCommand implements CommandInterface
{
    /** @var AggregatorInterface[] */
    private $data = [];
    /** @var AggregatorInterface */
    private $aggregator;
    /** @var string */
    private $field;

    public function __construct(string $field, AggregatorInterface $aggregator)
    {
        $this->aggregator = $aggregator;
        $this->field = $field;
    }

    public function push(Hotel $hotel): void
    {
        $field = $hotel->getField($this->field);
        if (!array_key_exists($field, $this->data)) {
            $this->data[$field] = $this->aggregator->clone();
        }
        $this->data[$field]->aggregate($hotel);
    }

    /**
     * @return RowInterface[]
     */
    public function process(): array
    {
        return array_map(function(string $field, AggregatorInterface $aggregator) {
            return new GroupedData($field, $aggregator->getValue());
        }, array_keys($this->data), $this->data);
    }
}