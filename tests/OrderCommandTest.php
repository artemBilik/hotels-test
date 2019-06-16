<?php


use Hotels\App\Hotel;
use Hotels\Commands\Order\Comparators\NameComparator;
use Hotels\Commands\Order\Comparators\StarComparator;
use Hotels\Commands\Order\OrderCommand;
use PHPUnit\Framework\TestCase;

class OrderCommandTest extends TestCase
{

    public function testAskOrder()
    {
        $command = new OrderCommand(new StarComparator(), OrderCommand::ASK);
        $hotel1 = new Hotel('1', 'url', 4);
        $command->push($hotel1);
        $hotel2 = new Hotel('2', 'url', 3);
        $command->push($hotel2);
        $hotel3 = new Hotel('3', 'url', 1);
        $command->push($hotel3);
        $hotel4 = new Hotel('4', 'url', 2);
        $command->push($hotel4);

        $result = $command->process();

        $this->assertCount(4, $result, 'wrong count in ask order');

        $this->assertSame($result[0], $hotel3, 'ask order - first element number is not 3');
        $this->assertSame($result[1], $hotel4, 'ask order - second element number is not 4');
        $this->assertSame($result[2], $hotel2, 'ask order - third element number is not 2');
        $this->assertSame($result[3], $hotel1, 'ask order - fourth element number is not 1');
    }


    public function testDescOrder()
    {
        $command = new OrderCommand(new NameComparator(), OrderCommand::DESC);
        $hotel1 = new Hotel('first', 'url', 4);
        $command->push($hotel1);
        $hotel2 = new Hotel('second', 'url', 4);
        $command->push($hotel2);
        $hotel3 = new Hotel('third', 'url', 4);
        $command->push($hotel3);
        $hotel4 = new Hotel('fourth', 'url', 4);
        $command->push($hotel4);

        $result = $command->process();

        $this->assertCount(4, $result, 'wrong count in desc order');

        $this->assertSame($result[0], $hotel3, 'desc order - first element number is not 3');
        $this->assertSame($result[1], $hotel2, 'desc order - second element number is not 2');
        $this->assertSame($result[2], $hotel4, 'desc order - third element number is not 4');
        $this->assertSame($result[3], $hotel1, 'desc order - fourth element number is not 1');
    }


}