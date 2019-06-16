<?php


use Hotels\App\Hotel;
use Hotels\Commands\Group\AggregatorInterface;
use Hotels\Commands\Group\GroupCommand;
use Hotels\Commands\Group\GroupedData;
use PHPUnit\Framework\TestCase;

class GroupCommandTest extends TestCase
{

    public function testGrouping()
    {
        $command = new GroupCommand('name', new class implements AggregatorInterface {
            private $cnt = 0;
            public function aggregate(Hotel $hotel): void
            {
                $this->cnt++;
            }
            public function clone(): AggregatorInterface
            {
                $clone = clone $this;
                $clone->cnt = 0;
                return $clone;
            }
            public function getValue(): string
            {
                return (string)$this->cnt;
            }
        });

        $command->push(new Hotel('group1', '', 1));
        $command->push(new Hotel('group3', '', 1));
        $command->push(new Hotel('group2', '', 1));
        $command->push(new Hotel('group1', '', 1));
        $command->push(new Hotel('group1', '', 1));
        $command->push(new Hotel('group2', '', 1));

        $result = $command->process();

        $this->assertCount(3, $result, 'wrong count in grouped data');
        $this->assertEquals(new GroupedData('group1', '3'), $result[0], 'wrong first row in group');
        $this->assertEquals(new GroupedData('group3', '1'), $result[1], 'wrong second row in group');
        $this->assertEquals(new GroupedData('group2', '2'), $result[2], 'wrong third row in group');
    }

}