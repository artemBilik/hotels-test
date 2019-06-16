<?php


namespace Hotels\Commands\Group\Aggregators;


use Hotels\App\Hotel;
use Hotels\Commands\Group\AggregatorInterface;

class AvgAggregator implements AggregatorInterface
{
    private $avg;

    public function aggregate(Hotel $hotel): void
    {
        if (null === $this->avg) {
            $this->avg = $hotel->getStar();
        } else {
            $this->avg = ($this->avg + $hotel->getStar()) / 2;
        }
    }

    public function clone(): AggregatorInterface
    {
        return new self();
    }

    public function getValue(): string
    {
        return (string)$this->avg;
    }
}