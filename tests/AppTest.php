<?php


use Hotels\App\App;
use Hotels\App\CommandInterface;
use Hotels\App\Hotel;
use Hotels\App\ReaderInterface;
use Hotels\App\RowInterface;
use Hotels\App\WriterInterface;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{

    public function testApp()
    {
        $hotels = [
            new Hotel('second', 's.com', 3),
            new Hotel('third', 's.com', 3),
            new Hotel('first', 's.com', 3)
        ];
        $reader = new class($hotels) implements ReaderInterface
        {
            private $hotels, $position = 0;
            public function __construct(array $hotels)
            {
                $this->hotels = $hotels;
            }
            public function isEnd(): bool
            {
                return $this->position >= count($this->hotels);
            }
            public function read(): Hotel
            {
                return $this->hotels[$this->position++];
            }
        };
        $command = new class implements CommandInterface
        {
            private $data = [];
            public function push(Hotel $hotel): void
            {
                $this->data[] = $hotel;
            }
            public function process(): array
            {
                return[$this->data[2], $this->data[0], $this->data[1]];
            }
        };
        $writer= new class implements WriterInterface
        {
            public $data = [];
            public $isFlushed = false;
            public function persist(RowInterface $row): void
            {
                $this->data[] = $row;
            }
            public function flush(): void
            {
                $this->isFlushed = true;
            }
        };

        $app = new App($reader, $command, $writer);
        $app->run();
        if ($writer->isFlushed !== true) {
            $this->fail('writer was not flushed');
        }

        $this->assertCount(3, $writer->data, 'writer data is not 3 cnt');
        $this->assertSame($hotels[2], $writer->data[0], 'writer 0 row is not hotel3');
        $this->assertSame($hotels[0], $writer->data[1], 'writer 1 row is not hotel2');
        $this->assertSame($hotels[1], $writer->data[2], 'writer 2 row is not hotel1');
    }

}