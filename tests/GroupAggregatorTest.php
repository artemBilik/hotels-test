<?php


use Hotels\App\Hotel;
use Hotels\Commands\Group\Aggregators\AvgAggregator;
use Hotels\Commands\Group\Aggregators\CntAggregator;
use Hotels\Commands\Group\Aggregators\SumAggregator;
use PHPUnit\Framework\TestCase;

class GroupAggregatorTest extends TestCase
{

    public function testSum()
    {
        $aggregator = new SumAggregator();
        $clone = $aggregator->clone();
        $clone->aggregate(new Hotel('', '', 1));
        $clone->aggregate(new Hotel('', '', 2));
        $clone->aggregate(new Hotel('', '', 2));
        $this->assertSame('5', $clone->getValue(), 'wrong sum in aggregator');
    }

    public function testCnt()
    {
        $aggregator = new CntAggregator();
        $clone = $aggregator->clone();
        $clone->aggregate(new Hotel('', '', 1));
        $clone->aggregate(new Hotel('', '', 2));
        $clone->aggregate(new Hotel('', '', 2));
        $this->assertSame('3', $clone->getValue(), 'wrong cnt in aggregator');
    }

    public function testAvg()
    {
        $aggregator = new AvgAggregator();
        $clone = $aggregator->clone();
        $clone->aggregate(new Hotel('', '', 1));
        $clone->aggregate(new Hotel('', '', 2));
        $clone->aggregate(new Hotel('', '', 2));
        $this->assertSame('1.75', $clone->getValue(), 'wrong avg in aggregator');
    }



}