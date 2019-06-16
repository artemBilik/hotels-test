<?php


namespace Hotels\Commands\Group\Aggregators;


use Hotels\App\Hotel;
use Hotels\Commands\Group\AggregatorInterface;

class SumAggregator implements AggregatorInterface
{
    private $sum = 0;

    public function aggregate(Hotel $hotel): void
    {
        $this->sum += $hotel->getStar();
    }

    public function clone(): AggregatorInterface
    {
        return new self();
    }

    public function getValue(): string
    {
        return (string)$this->sum;
    }
}