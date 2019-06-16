<?php


namespace Hotels\Commands\Group;


use Hotels\App\Hotel;

interface AggregatorInterface
{
    public function aggregate(Hotel $hotel): void;
    public function clone(): AggregatorInterface;
    public function getValue(): string;
}