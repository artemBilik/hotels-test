<?php


namespace Hotels\Commands\Group\Aggregators;


use Hotels\App\Hotel;
use Hotels\Commands\Group\AggregatorInterface;

class CntAggregator implements AggregatorInterface
{
    private $cnt = 0;

    public function aggregate(Hotel $hotel): void
    {
        $this->cnt++;
    }

    public function clone(): AggregatorInterface
    {
        return new self();
    }

    public function getValue(): string
    {
        return (string)$this->cnt;
    }
}